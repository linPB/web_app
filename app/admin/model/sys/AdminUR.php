<?php
/**
 * Func : 用户角色关系
 * Create By Lpb
 * Date: 2021/5/10 0010
 * Time: 21:45
 */

namespace app\admin\model\sys;


use support\Model;

class AdminUR extends Model
{
    protected $table = 'admin_u_r';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['user_id', 'role_id'];
}