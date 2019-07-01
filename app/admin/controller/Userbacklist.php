<?php
// +----------------------------------------------------------------------
// | 黑名单管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\UserBacklist as userbackModel;//模型
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Userbacklist extends Permissions
{
    /**
     * 用户黑名单列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化模型
        $model = new userbackModel();

        $post = $this->request->param();

        $where['gub.identify'] = 0 ;
        
        $date = $model->alias('gub')
                    ->join('gzj_user gu','gub.a_user_id = gu.id')
                    ->join('gzj_user gus','gub.b_user_id = gus.id','LEFT')
                    ->where($where)
                    ->field('gub.id,gu.login_user a_login_user,gu.nickname a_nickname,gu.wx_appid a_wx_appid,gus.login_user b_login_user,gus.nickname b_nickname,gus.wx_appid b_wx_appid')
                    ->order('gub.create_time desc')
                    ->paginate(20,false,['query'=>$this->request->param()]);

        $personaluser =$date;

        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }

    /**
     * 商家黑名单列表
     * @return [type] [description]
     */
    public function businessback()
    {
        //实例化模型
        $model = new userbackModel();

        $post = $this->request->param();

        $where['gub.identify'] = 1 ;
        
        $date = $model->alias('gub')
                    ->join('gzj_user gu','gub.a_user_id = gu.id')
                    ->join('gzj_user gus','gub.b_user_id = gus.id','LEFT')
                    ->where($where)
                    ->field('gub.id,gu.login_user a_login_user,gu.nickname a_nickname,gu.wx_appid a_wx_appid,gus.login_user b_login_user,gus.nickname b_nickname,gus.wx_appid b_wx_appid')
                    ->order('gub.create_time desc')
                    ->paginate(20,false,['query'=>$this->request->param()]);

        $personaluser =$date;

        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
        
        $this->assign('info',$info);
        return $this->fetch();
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

   
}
