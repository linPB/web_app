<?php
/**
 * Func : 后台角色
 * Create By Lpb
 * Date: 2021/3/12 0012
 * Time: 16:20
 */

namespace app\admin\model\sys;


use support\Model;

class AdminRole extends Model
{
    protected $table = 'admin_role';
    protected $primaryKey = 'id';
    public $timestamps = false;
}