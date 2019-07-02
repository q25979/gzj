<?php
// +----------------------------------------------------------------------
// | 求职信息管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\JobWanted as jobwantModel;//求职信息模型
use app\common\model\WorkPass as workpassModel;
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Jobwant extends Permissions
{
    /**
     * 求职信息列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化求职信息
        $model = new jobwantModel();
        $post = $this->request->param();
        $where = array();
        if (isset($post['keywords']) and !empty($post['keywords'])) {
            $where['gjw.post'] = ['like', '%' . $post['keywords'] . '%'];
        }
        if (isset($post['tele']) and !empty($post['tele'])) {
            $where['gjw.tele'] = ['like', '%' . $post['tele'] . '%'];
        }
        if (isset($post['want_work_addr']) and !empty($post['want_work_addr'])) {
            $where['gjw.want_work_addr'] = ['like', '%' . $post['want_work_addr'] . '%'];
        }
        if (isset($post['fullname']) and !empty($post['fullname'])) {
            $where['gjw.fullname'] = ['like', '%' . $post['fullname'] . '%'];
        }
        
        $data = $model->alias('gjw')
                    ->where($where)
                    ->join('gzj_user gu','gjw.user_id = gu.id')
                    ->join('gzj_attached ga','gu.id = ga.user_id','LEFT')
                    ->field('gjw.*,gu.login_user,gu.nickname,gu.status,ga.filename,ga.filepath')
                    ->order('gjw.id desc')
                    ->paginate(20,false,['query'=>$this->request->param()]);
        
        $personaluser = $this->changstatus($data);

        $this->assign('personaluser',$personaluser);

        $info['cate'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 工作经历
     * @return [type] [description]
     */
    public function publish()
    {   
        
    	//获取id
    	$post = $this->request->param();

        foreach ($post as $key => $value) {
            $id = $value;
        }
        $model = new workpassModel();
        $data = $model->where('id','in',$id)
                    ->order('id')
                    ->paginate(20,false,['query'=>$this->request->param()]);
       
        $this->assign('data',$data);
        return $this->fetch();
    }

    //导出数据
    public function excelexport(){
        
        $data = Db::name('job_wanted')
                    ->alias('gjw')
                    ->join('gzj_user gu','gjw.user_id = gu.id')
                    ->field('gjw.id,gu.nickname,gjw.fullname,gjw.sex,gjw.post,gjw.tele,gjw.email,gjw.want_work_addr,gjw.want_salary,gjw.self_comment,gjw.work_pass_id,gjw.create_time')
                    ->select();
        
        // $wpid =explode(",",Db::name('job_wanted')->value('work_pass_id')) ;
        // $data['work_pass'] = Db::name('work_pass')
        //                         ->where('id','in',$wpid)
        //                         ->field('id,working_time,corporate_name,working_content')
        //                         ->select();
       
        $excelName = '求职者信息';
        $Header = array('id','用户昵称','求职者姓名','性别','求职岗位','电话号码','邮箱','期望工作地点','期望薪资','自我评价','工作经历','创建时间');
        exportexcel($data,$Header,$excelName);
    }

    /**
     * 删除
     * @return [type] [description]
     */
    public function delete()
    {
    	if($this->request->isAjax()) {
            $model = new userModel();
    		$id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;

    		if(false == $model->where('id',$id)->update(['delete_time'=>time()])) {
    			return $this->error('删除失败');
    		} else {
    			return $this->success('删除成功','admin/user/index');
    		}
    	}
    }

    //状态更改
    private function changstatus($date)
    {
        foreach ($date as  $value) 
        {
            if ($value['status'] == 0) 
            {
                $value['status_name'] = '正常';
            }
            else{
                 $value['status_name'] = '冻结';
            }

            if ($value['sex'] == 0) 
            {
                $value['sex_name'] = '女';
            }
            else{
                 $value['sex_name'] = '男';
            }
           
        }
        return $date;
    }
   
}
