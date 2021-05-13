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

    protected $fillable = ['user_name', 'password', 'phone', 'email', 'avatar_url', 'login_num', 'last_login_ip', 'last_login_at'];

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'admin_u_r', 'user_id', 'role_id');
    }
}