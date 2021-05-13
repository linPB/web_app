<?php
/**
 * Func : 助手 缓存相关
 * Create By Lpb
 * Date: 2021/3/12 0012
 * Time: 16:13
 */

namespace app\lib\assist;

use app\admin\model\sys\AdminMenu;
use support\DB;
use support\bootstrap\Redis;

trait CacheFun
{
    /**
     * 根据uid 获取用户拥有的所有缓存权限
     * @param $uid
     * @return array
     */
    public function getAdminPermissions($uid) :array
    {
        $re = Redis::connection('session')->get( $this->adminPermissionKey($uid) );
        if(!$re) {
            $data = DB::table('admin_u_r')
                ->select('admin_permission.id', 'admin_permission.name', 'admin_permission.path', 'admin_permission.type')
                ->leftJoin('admin_r_p', 'admin_u_r.role_id', '=', 'admin_r_p.role_id')
                ->leftJoin('admin_permission', 'admin_r_p.permission_id', '=', 'admin_permission.id')
                ->where('admin_u_r.user_id', $uid)
                ->get()
                ->map(function ($value) {return (array)$value;})
                ->toArray();

            if($data) {
                Redis::connection('session')->setex($this->adminPermissionKey($uid), 24 * 60 * 60, json_encode($data));
                return $data;
            } else {
                return [];
            }
        }
        return json_decode($re, true);
    }

    /**
     * 根据uid 生成缓存的权限键名
     * @param $uid
     * @return string
     */
    public function adminPermissionKey($uid) :string
    {
        return "admin_permission:$uid";
    }

    /**
     * 根据传入字符串匹配条件  删除所有用户的权限
     * @param $pre_str
     */
    public function delAdminPermissions($pre_str) :void
    {
        $keys = Redis::connection('session')->keys($pre_str);
        foreach ($keys as $key) {
            if($key) Redis::connection('session')->del($key);
        }
    }

    /**
     * 获取所有菜单缓存
     * @return array|mixed
     */
    public function getAdminMenus()
    {
        $re = Redis::connection('session')->get( 'admin_menus' );
        if(!$re) {
            $list = AdminMenu::with(array('permission'=>function($query){
                $query->select('id','name','path');
            }))->get()->toArray();
            $menus = AdminMenu::getMenus($list);

            $final = [];
            foreach ($menus as $menu) {
                $temp = [
                    'id'    => $menu['permission']['id'],
                    'name'  => $menu['permission']['name'],
                    'path'  => $menu['permission']['path'],
                    'child' => []
                ];
                if(isset($menu['child']) && count($menu['child']) > 0) {
                    foreach ($menu['child'] as $child) {
                        $temp['child'][] = [
                            'id'    => $child['permission']['id'],
                            'name'  => $child['permission']['name'],
                            'path'  => $child['permission']['path'],
                        ];
                    }
                }
                $final[] = $temp;
            }
            Redis::connection('session')->setex( 'admin_menus' , 24 * 60 * 60, json_encode($final));
            return $final;
        }
        return json_decode($re, true);
    }

    /**
     * 清除菜单缓存
     * @param $pre_str
     */
    public function delAdminMenus() :void
    {
        Redis::connection('session')->del( 'admin_menus' );
    }

    public function getFilterAdminMenus($uid)
    {
        $permissions = $this->getAdminPermissions($uid);
        $menus = $this->getAdminMenus();

        $permission_ids = array_column($permissions, 'id');
        $final = [];
        foreach ($menus as $m_k => $menu) {
            $temp = [];
            if( in_array($menu['id'], $permission_ids) ) {
                $temp['id'] = $menu['id'];
                $temp['name'] = $menu['name'];
                $temp['path'] = $menu['path'];
                $temp['child'] = [];

                if($menu['child']) {
                    foreach ($menu['child'] as $child_k => $child) {
                        if( in_array($child['id'], $permission_ids) ) {
                            $temp['child'][$child_k] = [
                                'id' => $child['id'],
                                'name' => $child['name'],
                                'path' => $child['path'],
                            ];
                        }
                    }
                }

                $final[] = $temp;
            }
        }
        return $final;
    }
}