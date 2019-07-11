<?php
// +----------------------------------------------------------------------
// | 用户api
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
class Usersystem extends Base
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

	// 用户设置/修改密码
	public function userSetPassword() {
		if (!request()->isPost()) {
            return json(request());
        }
		$post = request()->post();
		$result = ['code' => 0, 'msg' => '密码设置失败'];

		// 验证信息
		if (empty($post['login_pass']) ||
			strlen($post['login_pass']) < 6) {
			$result['msg'] = '密码不能少于6位数';
			return json($result);
		}
		if (empty($post['confirm_pass']) ||
			$post['confirm_pass'] != $post['login_pass']) {
			$result['msg'] = '两次密码输入不一致';
			return json($result);
		}

		// 更新密码
		$createTime = User::getFieldById($this->uid, 'create_time');
		$user = User::get($this->uid);
		$user->login_pass = md5($post['login_pass'].$createTime);
		$info = $user->save();
		$result = $info > 0
			? ['code' => 200, 'msg' => '密码设置成功']
			: ['code' => 0, 'msg' => '密码设置失败'];

		return json($result);
	}
}
