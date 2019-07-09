<?php
// +----------------------------------------------------------------------
// | 验证
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
class Base
{
	public $uid;	// 用户id
	public $header;	// 头部信息

	public function __construct()
	{
		$this->header = request()->header();
	}

	// 账号登录状态
	public function loginInfo()
	{
		$result = [
			'code'	=> -1,
			'msg'	=> '登录状态错误',
			'error_msg'	=> '获取的token为空'
		];

		if (empty($this->header['token'])) {
			return $result;
		} else {
			$data = removeBase64($this->header['token']);
			if (!empty($data['code']) && $data['code'] == -1) {
				$result['error_msg'] = '获取的token信息错误';
				return $result;
			}
			$this->uid = $data['id'];

			if (empty($this->uid)) {
				$result['error_msg'] = 'token信息解密错误';
				return $result;
			}
			return [
				'code'	=> 200,
				'msg'	=> '用户信息正确,登录成功'
			];
		}
	}
}
