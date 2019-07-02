<?php
// +----------------------------------------------------------------------
// | 招聘管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\MsgRecruit as recruitModel;
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Recruit extends Permissions
{
    /**
     * 招聘列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化管理员模型
        $model = new recruitModel();

        $post = $this->request->param();
        $where = array();
        if (isset($post['contacts']) and !empty($post['contacts'])) {
            $where['gmr.contacts'] = ['like', '%' . $post['contacts'] . '%'];
        }
        if (isset($post['tele']) and !empty($post['tele'])) {
            $where['gmr.tele'] = ['like', '%' . $post['tele'] . '%'];
        }
        if (isset($post['corporate_name']) and !empty($post['corporate_name'])) {
            $where['gmr.corporate_name'] = ['like', '%' . $post['corporate_name'] . '%'];
        }
        
        $date = $model->alias('gmr')
                    ->where($where)
                    ->join('gzj_user gu','gmr.user_id = gu.id')
                    ->field('gmr.*,gu.login_user,gu.nickname,gu.status')
                    ->order('gmr.id desc')
                    ->paginate(20,false,['query'=>$this->request->param()]);
        $personaluser =$this->changstatus($date);

        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }


    public function excelexport(){
        
        $data = Db::name('msg_recruit')
                    ->alias('gmr')
                    ->join('gzj_user gu','gmr.user_id = gu.id')
                    ->field('gmr.id,gu.nickname,gmr.corporate_name,gmr.working_time,gmr.need_people,gmr.longitude,gmr.latitude,gmr.addr,gmr.salary_range,gmr.settlement_method,gmr.working_content,gmr.contacts,gmr.tele,gmr.create_time')
                    ->select();
       
        $excelName = '招聘信息';
        $Header = array('id','商家昵称','公司名称','工作时间','招聘人数','经度','纬度','详细地址','工资范围','工资结算','工作内容','联系人','联系电话','创建时间');
        exportexcel($data,$Header,$excelName);
    }

    /**
     * 用户删除删除
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
            if ($value['status'] == 0) {
                $value['status_name'] = '正常';
            }else{
                 $value['status_name'] = '冻结';
            }
            
        }
        return $date;
    }
   
}
