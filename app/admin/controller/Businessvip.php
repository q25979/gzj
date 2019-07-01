<?php
// +----------------------------------------------------------------------
// | 商家会员管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\Svip as svipModel;//用户模型
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Businessvip extends Permissions
{
    /**
     *  商家会员列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化商家会员模型
        $model = new svipModel();

        $post = $this->request->param();

        if (isset($post['keywords']) and !empty($post['keywords'])) {
            $where['gu.nickname'] = ['like', '%' . $post['keywords'] . '%'];
        }
        if (isset($post['tetle']) and !empty($post['tetle'])) {
            $where['gu.login_user'] = ['like', '%' . $post['tetle'] . '%'];
        }
 
        $where['gu.identity'] = 1;
        $date = $model->alias('gv')->join('gzj_user gu','gv.user_id = gu.id')->where($where)->order('gu.id desc')->field('gv.id,gv.expiration_time,gu.*')->paginate(20,false,['query'=>$this->request->param()]);

        $personaluser =$this->changstatus($date);
        
        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 用户状态修改（冻结，正常）
     * @return [type] [description]
     */
    public function publish()
    {
    	//获取用户id
    	$id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;

    	$model = new svipModel();

    	if($id > 0) {
    		//是修改操作
    		if($this->request->isPost()) {
    			//是提交操作
    			$post = $this->request->post();

                $post['update_time'] = time();
	            if(false == $model->allowField(true)->save($post,['id'=>$id])) {
	            	return $this->error('修改失败');
	            } else {
                   
	            	return $this->success('修改信息成功','admin/user/index');
	            }
    		} else {
    			//非提交操作
    			$info['user'] = $model->where('id',$id)->find();
                $info['status'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
    			$this->assign('info',$info);
    			return $this->fetch();
    		}
    	} 
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
