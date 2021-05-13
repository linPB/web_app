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

    protected $fillable = ['pid', 'permission_id', 'sort'];

    public function permission()
    {
        return $this->belongsTo(AdminPermission::class, 'permission_id', 'id');
    }

    public static function getMenus($menus)
    {
        foreach($menus as $key=>$value) {
            $menus[$key] = (array)$value;
        }
        $menus = self::getChild($menus);

        $cmf_arr = array_column($menus,'sort');
        array_multisort($cmf_arr, SORT_ASC, $menus);

        return $menus;
    }

    public static function getChild($data, $id = 0)
    {
        $child = [];
        foreach ($data as $key => $datum) {
            if ($datum['pid'] == $id) {
                $child[$datum['id']] = $datum;
                unset($data[$key]);
                $child[$datum['id']]['child'] = self::getChild($data, $datum['id']);
            }
        }
        return $child;
    }
}