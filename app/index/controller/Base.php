<?php
// +----------------------------------------------------------------------
// | 验证
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
class Base
{
	public $uid;	// 用户id

	public function __construct()
	{
		// 判断账号是否登录
		if (!empty(cookie('permit'))) {
			// 已登录
			$permit = cookie('permit');
			$info = removeBase64($permit);
			$this->uid = $info['id'];
		}
	}

	// 账号登录状态
	public function isLogin()
	{
		if (!empty($this->uid)) {
			return true;
		} else {
			return false;
		}
	}
}
