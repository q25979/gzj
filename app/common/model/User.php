<?php
// +----------------------------------------------------------------------
// | 工作家
// 
//+----------------------------------------------------------------------
// | 用户表
// 
//+----------------------------------------------------------------------
// | Author: 671 <277161542@qq.com>
// +----------------------------------------------------------------------


namespace app\common\model;

use \think\Model;
use traits\model\SoftDelete;
class User extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';

    // 关联vip
    public function svip()
    {
        return $this->hasOne('Svip');
    }

    
}
