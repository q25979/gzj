<?php
// +----------------------------------------------------------------------
// | Tplay [ WE ONLY DO WHAT IS NECESSARY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://tplay.pengyichen.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 听雨 < 389625819@qq.com >
// +----------------------------------------------------------------------
use think\Route;

//url美化 例：Route::rule('blog/:id','index/blog/read');
$url = \think\Db::name("urlconfig")->where(['status' => 1])->column('aliases,url');
foreach ($url as $k => $val) {
	\think\Route::rule($k,$val);
}

// api路由定义
// 登录
Route::alias('is_authorization_login', 'Index/Login/isAuthorizationLogin');	// 授权登录
Route::alias('is_user_login', 'Index/Login/isUserLogin'); 	// 账号登录
Route::alias('register', 'Index/Login/register'); 			// 账号注册
Route::alias('code', 'Index/Login/code'); 	// 发送验证码

// 用户
Route::alias('set_password', 'Index/Usersystem/userSetPassword');	// 设置密码