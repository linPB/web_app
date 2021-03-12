<?php
/**
 * Func : 后台用户
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 11:58
 */

namespace app\admin\model\sys;

use support\Model;

class AdminUser extends Model
{
    protected $table = 'admin_user';
    protected $primaryKey = 'id';
    public $timestamps = true;
}