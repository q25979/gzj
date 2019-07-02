<?php
// +----------------------------------------------------------------------
// | 消费管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\UserConsumeRecord as consumeModel;//消费管理
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Consume extends Permissions
{
    /**
     * 消费列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化管理员模型
        $model = new consumeModel();

        $post = $this->request->param();
        $where = array();
        if (isset($post['keywords']) and !empty($post['keywords'])) {
            $where['gu.nickname'] = ['like', '%' . $post['keywords'] . '%'];
        }
        if (isset($post['type'])) {
            $where['gcr.type'] = $post['type'];
        }
        $date = $model->alias('gcr')
                    ->where($where)
                    ->join('gzj_user gu','gcr.user_id = gu.id')
                    ->field('gcr.*,gu.login_user,gu.nickname,gu.status')
                    ->order('gcr.id desc')->paginate(20,false,['query'=>$this->request->param()]);
        $personaluser =$this->changstatus($date);

        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['type'=>0,'type_name'=>'升级vip'],['type'=>1,'type_name'=>'普通消费']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }

    //excel导出
    public function excelexport(){
        
        $data = Db::name('user_consume_record')
                    ->alias('guc')
                    ->join('gzj_user gu','guc.user_id = gu.id')
                    ->field('guc.id,gu.nickname,guc.money,guc.type,guc.content,guc.create_time')
                    ->select();

        $excelName = '消费记录';
        $Header = array('id','用户昵称','消费金额','消费类型','消费详情','创建时间');
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
            if($value['type'] == 0){
                $value['type_name'] = '升级vip';
            }
            if($value['type'] == 1){
                $value['type_name'] = '普通消费';
            }
        }
        return $date;
    }
   
}
