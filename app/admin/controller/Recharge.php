<?php
// +----------------------------------------------------------------------
// | 充值记录管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\UserRechargeRecord as rechargeModel;//用户模型
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Recharge extends Permissions
{
    /**
     * 充值记录列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化模型
        $model = new rechargeModel();

        $post = $this->request->param();
        $where = array();
        if (isset($post['keywords']) and !empty($post['keywords'])) {
            $where['gu.nickname'] = ['like', '%' . $post['keywords'] . '%'];
        }
        if (isset($post['type'])) {
            $where['gr.type'] = $post['type'];
        }
        $date = $model->alias('gr')
                    ->where($where)
                    ->join('gzj_user gu','gr.user_id = gu.id')
                    ->field('gr.*,gu.login_user,gu.nickname,gu.status,gu.balance')
                    ->order('gr.id desc')->paginate(20,false,['query'=>$this->request->param()]);
        $personaluser =$this->changstatus($date);

        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['type'=>0,'type_name'=>'微信'],['type'=>1,'type_name'=>'支付宝'],['type'=>2,'type_name'=>'银行卡'],['type'=>2,'type_name'=>'线下']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }

    //excel导出
    public function excelexport(){
        
        $data = Db::name('user_recharge_record')
                    ->alias('gur')
                    ->join('gzj_user gu','gur.user_id = gu.id')
                    ->field('gur.id,gu.nickname,gur.money,gur.status,gur.type,gur.create_time')
                    ->select();

        $excelName = '充值记录';
        $Header = array('id','用户昵称','充值金额','充值状态','充值类型','创建时间');
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
            }
            if ($value['status'] == 1) {
                 $value['status_name'] = '冻结';
            }

            if($value['type'] == 0){
                $value['type_name'] = '微信';
            }
            if($value['type'] == 1){
                $value['type_name'] = '支付宝';
            }
           
            if($value['type'] == 2){
                $value['type_name'] = '银行卡';
            }
            if($value['type'] == 3){
                $value['type_name'] = '线下';
            }
        }
        return $date;
    }
   
}
