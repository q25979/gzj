<?php
// +----------------------------------------------------------------------
// | 工作家
// +----------------------------------------------------------------------
// | 商家认证表
// +----------------------------------------------------------------------
// | Author: 671 <277161542@qq.com>
// +----------------------------------------------------------------------


namespace app\common\model;

use \think\Model;
use traits\model\SoftDelete;
class UserAuthentication extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
}
