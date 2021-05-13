<?php
/**
 * Func : 角色权限关系
 * Create By Lpb
 * Date: 2021/5/10 0010
 * Time: 15:40
 */

namespace app\admin\model\sys;


use support\Model;

class AdminRP extends Model
{
    protected $table = 'admin_r_p';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['role_id', 'permission_id'];
}