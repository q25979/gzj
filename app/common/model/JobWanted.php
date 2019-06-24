<?php
// +----------------------------------------------------------------------
// | 工作家
// +----------------------------------------------------------------------
// | 求职表
// +----------------------------------------------------------------------
// | Author: 671 <277161542@qq.com>
// +----------------------------------------------------------------------


namespace app\common\model;

use \think\Model;
use traits\model\SoftDelete;
class JobWanted extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';

    // 关联工作经历表
    public function workPass()
    {
    	return $this->hasMany('WorkPass');
    }
}
