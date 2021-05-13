<?php
/**
 * Func : 后台权限
 * Create By Lpb
 * Date: 2021/3/12 0012
 * Time: 16:19
 */

namespace app\admin\model\sys;


use support\Model;

class AdminPermission extends Model
{
    protected $table = 'admin_permission';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['name', 'path', 'type'];
}