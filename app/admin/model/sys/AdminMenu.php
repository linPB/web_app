<?php
/**
 * Func : 后台菜单
 * Create By Lpb
 * Date: 2021/3/12 0012
 * Time: 16:20
 */

namespace app\admin\model\sys;


use support\Model;

class AdminMenu extends Model
{
    protected $table = 'amdin_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;
}