<?php
// +----------------------------------------------------------------------
// | 店铺管理
// +----------------------------------------------------------------------


namespace app\admin\controller;

use \think\Db;
use \think\Cookie;
use \think\Session;
use app\common\model\MsgUsedCar as usercatModel;//用户模型
use app\admin\model\AdminMenu;
use app\admin\controller\Permissions;
class Usercat extends Permissions
{
    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index()
    {
        //实例化管理员模型
        $model = new usercatModel();

        $post = $this->request->param();

        if (isset($post['corporate_name']) and !empty($post['corporate_name'])) {
            $where['guc.corporate_name'] = ['like', '%' . $post['corporate_name'] . '%'];
        }
        if (isset($post['contacts']) and !empty($post['contacts'])) {
            $where['guc.contacts'] = ['like', '%' . $post['contacts'] . '%'];
        }
        if (isset($post['tele']) and !empty($post['tele'])) {
            $where['guc.tele'] = ['like', '%' . $post['tele'] . '%'];
        }
        $where = array();
        $date = $model->alias('guc')
                    ->where($where)
                    ->join('gzj_user gu','guc.user_id = gu.id')
                    ->join('gzj_attached ga','guc.attached_id = ga.id and guc.car_attached_id = ga.id','LEFT')
                    ->field('guc.*,gu.login_user,gu.nickname,gu.status,ga.filename,ga.filepath')
                    ->order('guc.id desc')->paginate(20,false,['query'=>$this->request->param()]);
        $personaluser =$this->changstatus($date);

        $this->assign('personaluser',$personaluser);
        $info['cate'] = array(['status'=>0,'status_name'=>'正常'],['status'=>1,'status_name'=>'冻结']);
        
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function excelexport(){
        
        $data = Db::name('msg_used_car')
                    ->alias('guc')
                    ->join('gzj_user gu','guc.user_id = gu.id')
                    ->field('guc.id,gu.nickname,guc.corporate_name,guc.contacts,guc.tele,guc.banking_hours,guc.attached_id,guc.longitude,guc.latitude,guc.addr,guc.car_brand,guc.car_type,guc.age_limit,guc.kilometres,guc.is_automatic,guc.car_color,guc.price,guc.car_attached_id,guc.create_time')
                    ->select();
       
        $excelName = '二手车信息';
        $Header = array('id','商家昵称','公司名称','联系人','联系电话','工作时间','附件信息','经度','纬度','详细地址','汽车品牌','汽车类型','使用年限','使用公里数','是否自动','车身颜色','价格','汽车图片附件','创建时间');
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
            if ($value['is_automatic'] == 0) {
                $value['is_automatic_name'] = '自动';
            }else{
                 $value['is_automatics_name'] = '手动';
            }
            if ($value['status'] == 0) {
                $value['status_name'] = '正常';
            }else{
                 $value['status_name'] = '冻结';
            }
            if($value['car_type'] == 0){
                $value['type_name'] = '跑车';
            }elseif($value['type'] == 1){
                $value['type_name'] = 'SUV';
            }else{
                $value['type_name'] = '商务车';
            }
        }
        return $date;
    }
   
}
