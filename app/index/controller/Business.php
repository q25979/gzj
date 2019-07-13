<?php
// +----------------------------------------------------------------------
// | 用户api
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
use app\common\model\UserAuthentication;
use \think\Validate;
class Business extends Base
{
	public function __construct()
	{
		// 验证登录信息
		parent::__construct();
		$info = $this->loginInfo();
		if ($info['code'] != 200) {
			json($info)->send();
			exit();
		}
	}

	// 完善商家信息
	public function perfectBuinessInfo()
	{
		if (!request()->isPost()) {
            return json(request());
        }
        $post = request()->post();
        $result = ['code' => 0, 'msg' => '验证信息错误'];
        $rule = [
    		['corporate_name', 'require', '公司名称不能为空'],
    		['longitude', 'require', '地理位置不能为空'],
    		['latitude', 'require', '地理位置不能为空'],
    		['addr', 'require', '详细地址不能为空'],
    		['contacts', 'require', '联系人名称不能为空'],
    		['tele', 'require', '手机号码不能为空'],
    		['tele', 'number|between:13000000000,18999999999', '手机号码格式错误|手机号码格式错误']
    	];
    	if ($post['type'] == 1) {
    		// 二手车交易
    		$rule[1] = ['longitude', 'require', '请选择店铺或城市区域'];
    		$rule[2] = ['latitude', 'require', '请选择店铺或城市区域'];
    		if (!isset($post['used_car_type'])) {
    			return json([
    				'code' => -1,
    				'msg'  => '提交信息错误,请联系管理员',
    				'error_msg' => 'used_car_type参数未上传'
    			]);
    		}
    		if ($post['used_car_type'] == 1) {
    			$rule = [
    				['contacts', 'require', '联系人名称不能为空'],
    				['tele', 'require', '手机号码不能为空'],
    				['tele', 'number|between:13000000000,18999999999', '手机号码格式错误|手机号码格式错误']
    			];
    		} elseif ($post['used_car_type'] == 0) {
    			array_push($rule, ['working_time', 'require', '请输入营业时间']);
    			array_push($rule, ['photos', 'require', '请上传店铺照片']);
    		}
    	} elseif ($post['type'] == 0) {
    		// 店铺交易
    		$rule[1] = ['longitude', 'require', '请选择店铺或城市区域'];
    		$rule[2] = ['latitude', 'require', '请选择店铺或城市区域'];
    		array_push($rule, ['photos', 'require', '请上传店铺照片']);
    	}
        $validate = new Validate($rule);
        if (!$validate->check($post)) {
        	$result['msg'] = $validate->getError();
        	return json($result);
        }

        // 插入数据库
        $ua = new UserAuthentication;
        $post['user_id'] = $this->uid;
        $ua->data($post);
        $info = $ua->save();
        if ($info <= 0) {
        	return json([
        		'code'	=> -1,
        		'msg'	=> '提交审核失败,请联系管理员',
        		'error_msg' => '插入数据库失败'
        	]);
        } else {
        	$result = [
        		'code'	=> 200,
        		'msg'	=> '提交审核成功,请耐心等待'
        	];
        }

        return json($result);
	}
}
