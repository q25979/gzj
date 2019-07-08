<?php
// +----------------------------------------------------------------------
// | 登录控制器
// +----------------------------------------------------------------------
namespace app\index\controller;

use app\common\model\User;
class Login
{
    // 微信授权登录
    public function isAuthorizationLogin()
    {
    	$post = request()->post();
        $result = [
            'code'  => -1,
            'msg'   => '登录失败'
        ];

    	// 判断授权登录是否存在
        if (!$uinfo = User::getByWxAppid($post['wx_appid'])) {
            // 不存在保存数据
            $uinfo = User::create($post);
            if (!$uinfo) {
                $result['error_msg'] = '数据保存数据库失败';
                return json($result);
            }
            if ($post['identity'] == 0) {
                // 普通用户
                $result = [
                    'code' => 200,
                    'msg'  => '登录成功',
                    'data' => '普通用户身份登录'
                ];
            } elseif ($post['identity'] == 1) {
                // 未认证商家用户登录
                $result = [
                    'code'  => 0,
                    'msg'   => '登录成功',
                    'data'  => '未认证商家用户登录'
                ];
            }
        } else {
            // 数据已存在判断账号的身份
            if ($post['identity'] == 0) {
                // 普通用户
                $result = [
                    'code' => 200,
                    'msg'  => '登录成功',
                    'data' => '普通用户身份登录'
                ];
            } elseif ($post['identity'] == 1) {
                // 商家身份
                if ($uinfo['identity'] == 0) {
                    // 未认证商家用户登录
                    $result = [
                        'code'  => 0,
                        'msg'   => '登录成功',
                        'data'  => '未认证商家用户登录'
                    ];
                } elseif ($uinfo['identity'] == 1) {
                    // 已认证商家用户登录
                    $result = [
                        'code'  => 200,
                        'msg'   => '登录成功',
                        'data'  => '已认证商家用户登录'
                    ];
                }
            }
        }
        if ($uinfo['status'] != 0) {
            $result = [
                'code'  => -1,
                'msg'   => '账号已被冻结,登录失败!',
            ];
        } else {
            // 设置cookie
            $data['id'] = $uinfo['id'];
            cookie('permit', addBase64($data));
        }

    	return json($result);
    }

    // 账号登录
    public function isUserLogin()
    {
        $post = request()->get();

        return json($post);
    }
}
