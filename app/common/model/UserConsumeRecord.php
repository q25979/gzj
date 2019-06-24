<?php
// +----------------------------------------------------------------------
// | 工作家
// +----------------------------------------------------------------------
// | 消费记录表
// +----------------------------------------------------------------------
// | Author: 671 <277161542@qq.com>
// +----------------------------------------------------------------------


namespace app\common\model;

use \think\Model;
use traits\model\SoftDelete;
class UserConsumeRecord extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
}
