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
        if (!request()->isPost()) {
            return json(notPostMsg());
        }
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
                        'code'  => 201,
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
                'code'  => 0,
                'msg'   => '账号已被冻结,登录失败!',
            ];
        } else {
            // 设置cookie
            $data['id'] = $uinfo['id'];
            $result['token'] = addBase64($data);
        }

    	return json($result);
    }

    // 账号登录
    public function isUserLogin()
    {
        if (!request()->isPost()) {
            return json(notPostMsg());
        }
        $post = request()->post();
        $result = [
            'code'  => 0,
            'msg'   => '登录失败'
        ];

        // 验证信息
        if (!isMobile($post['login_user'])) {
            $result['msg'] = '账号格式错误';
            return json($result);
        }
        if (empty($post['login_pass']) || strlen($post['login_pass']) < 6) {
            $result['msg'] = '密码格式错误';
            return json($result);
        }
        if ($post['identity'] != 0 && $post['identity'] != 1) {
            $result['code'] = -1;
            $result['msg'] = '登录失败';
            $result['error_msg'] = '用户登录身份错误必须为0或1';
            return json($result);
        }

        $map['login_user'] = $post['login_user'];
        $createTime = User::getFieldByLoginUser($map['login_user'], 'create_time');
        $map['login_pass'] = md5($post['login_pass'].$createTime);
        $uinfo = User::where($map)->find();
        if (empty($uinfo)) {
            $result = [
                'code'  => 0,
                'msg'   => '账号或密码错误'
            ];
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
                        'code'  => 201,
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
                'code'  => 0,
                'msg'   => '账号已被冻结,登录失败!',
            ];
        } else {
            // 设置token
            $data['id'] = $uinfo['id'];
            $result['token'] = addBase64($data);
        }

        return json($result);
    }

    // 手机注册
    public function register()
    {
        if (!request()->isPost()) {
            return json(notPostMsg());
        }
        $post = request()->post();
        $result = [
            'code'  => 0,
            'msg'   => '注册失败'
        ];

        // 验证信息
        if (!isMobile($post['login_user'])) {
            $result['msg'] = '注册账号格式错误';
            return json($result);
        }

        $regmap['login_user'] = $post['login_user'];
        $regcount = User::where($regmap)->count();
        if ($regcount > 0) {
            $result['msg'] = '该账号已经被注册过了,请直接登录';
            return json($result);
        }

        // 保存数据库
        $info = User::create($post);
        if (empty($info)) {
            $result['error_msg'] = '保存数据库失败';
            return $result;
        } else {
            // 设置token
            $data['id'] = $info['id'];
            $result['token'] = addBase64($data);
            $result['msg'] = '注册成功';
            $result['code'] = 200;
        }

        return json($result);
    }

    // 发送验证码
    public function code()
    {
        if (!request()->isPost()) {
            return json(notPostMsg());
        }
        $post = request()->post();
        $result = ['code' => 0, 'msg' => '获取验证码失败'];

        if (!isMobile($post['login_user'])) {
            $result['msg'] = '手机号码格式错误';
            return json($result);
        }

        $code = rand(1000, 9999);
        $result['code'] = 200;
        $result['msg']  = '获取验证码成功';
        $result['data'] = $code;
        return json($result);
    }
}
