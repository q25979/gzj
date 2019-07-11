<?php
// +----------------------------------------------------------------------
// | 首页
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
use think\View;
class Index extends Base
{
	public function index()
	{
		$view = new View();
		if (request()->isPost()) {
			// 测试，$this->loginInfo() 判断登录信息，前端每次发送都需要header code
			$info = $this->loginInfo();
			// $info['uid'] = $this->uid;
			return json($info);
		}
		$view->id = $this->uid;
		return $view->fetch();
	}

	public function test()
	{
		$user = User::all();
	}
}
