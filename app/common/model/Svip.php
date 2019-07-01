<?php
// +----------------------------------------------------------------------
// | 工作家
// +----------------------------------------------------------------------
// | 超级会员表
// +----------------------------------------------------------------------



namespace app\common\model;

use \think\Model;
use traits\model\SoftDelete;
class Svip extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';
}