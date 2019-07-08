<?php
// +----------------------------------------------------------------------
// | 首页
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
class Index extends Base
{
	public function __construct()
	{
		// 判断登录状态，需要判断的方法都需要添加上，如果全部控制器需要就在构造函数加上
		parent::__construct();
		if (!$this->isLogin()) {
			json(noLogin())->send();
			exit();
		}
	}

	public function index()
	{
		echo 1;
	}

	public function test()
	{
		$user = User::all();
	}
}
