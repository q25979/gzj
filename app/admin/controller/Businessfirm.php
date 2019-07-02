<?php
// +----------------------------------------------------------------------
// | 商家认证管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\UserAuthentication as businessfirmModel;//商家认证
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Businessfirm extends Permissions
{
    /**
     * 商家认证列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化模型
        $model = new businessfirmModel();

        $post = $this->request->param();

        if (isset($post['keywords']) and !empty($post['keywords'])) {
            $where['gua.corporate_name'] = ['like', '%' . $post['keywords'] . '%'];
        }
        if (isset($post['type'])) {
            $where['gua.type'] = $post['type'];
        }
        if (isset($post['contacts']) and !empty($post['contacts'])) {
            $where['gua.contacts'] = ['like', '%' . $post['contacts'] . '%'];
        }
        if (isset($post['tele']) and !empty($post['tele'])) {
            $where['gua.tele'] =$post['tele'];
        }
 
        $where['gu.identity']=1;
        
        $date = $model->where($where)
                    ->alias('gua')
                    ->join('gzj_user gu','gua.user_id = gu.id')
                    ->join('gzj_attached ga','gua.attached_id = ga.id','LEFT')
                    ->field('gua.*,gu.login_user,gu.nickname,gu.headimg,ga.filepath')
                    ->order('gua.id desc')->paginate(20,false,['query'=>$this->request->param()]);
        $personaluser =$this->changstatus($date);
        
        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['type'=>0,'type_name'=>'店铺商家'],['type'=>1,'type_name'=>'二手车商家'],['type'=>2,'type_name'=>'招聘商家']);
        
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

    	$model = new userModel();

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

    public function excelexport(){
        
        
        $where['used_car_type']=0;
        
        $data = Db::name('user_authentication')
                    ->where($where)
                    ->order('id')
                    ->select();
       
        $excelName = '商家认证信息';
        $Header = array('id','商家id','联系人','联系电话','经度','纬度','类型','是否个人二手车','营业执照','详细地址','公司名称','附件表id','创建时间','更新时间','删除时间');
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
            if ($value['type'] == 0) {
                $value['type_name'] = '店铺商家';
            }elseif($value['type'] == 1){
                 $value['status_name'] = '二手车商家';
            }else{
                $value['status_name'] = '招聘商家';
            }
        }
        return $date;
    }
   
}
