<?php
/**
 * Func : 菜单
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 21:56
 */

namespace app\admin\controller\sys;

use app\admin\model\sys\AdminMenu;
use app\admin\model\sys\AdminPermission;
use app\lib\assist\CacheFun;
use support\Request;

class Menu
{
    use CacheFun;

    public function index()
    {
        $list = AdminMenu::with(array('permission'=>function($query){
            $query->select('id','name','path');
        }))->get()->toArray();
        $menus = AdminMenu::getMenus($list);
        return view('sys/menu/index', compact('menus'));
    }

    public function show(Request $request)
    {
        try {
            $pid = $request->input('pid', 0);
            if($pid == 0) {
                $where[] = ['path', ''];
            } else {
                $where[] = ['path', '!=', ''];
            }
            return json(['code' => 0, 'msg' => 'success', 'data' => AdminPermission::where($where)->get()]);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function edit(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            $pid = $request->input('pid', 0);
            $permission_id = $request->input('permission_id', 0);
            $sort = $request->input('sort', 0);
            var_dump($id,$pid,$permission_id,$sort);
            if(empty($id) || empty($permission_id) || empty($sort)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            if(AdminMenu::where('id', $id)->update(['pid' => $pid, 'permission_id' => $permission_id, 'sort' => $sort])) {
                $this->delAdminMenus();
                return json(['code' => 0, 'msg' => '修改成功']);
            } else {
                return json(['code' => 1, 'msg' => '修改失败']);
            }
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员'.$e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['pid', 'permission_id', 'sort']);
            if(empty($data['permission_id']) || empty($data['sort'])) return json(['code' => 1, 'msg' => '添加失败，请完整信息']);
            if(AdminMenu::create($data)) {
                return json(['code' => 0, 'msg' => '添加成功']);
            } else {
                return json(['code' => 1, 'msg' => '添加失败，请联系管理员']);
            }
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function del(Request $request)
    {
        try {
            $id = $request->input('id', '');
            $pid = $request->input('pid', '');
            if(empty($id)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            if( AdminMenu::where([['id', $id], ['pid', $pid]])->first() ) {
                if($pid == 0) {
                    AdminMenu::where('id', $id)->delete();
                    AdminMenu::where('pid', $id)->delete();
                } else {
                    AdminMenu::where([['id', $id], ['pid', $pid]])->delete();
                }
                $this->delAdminMenus();
                return response(json_encode(['code' => 0, 'msg' => '删除成功']));
            }
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员'.$e->getMessage()]);
        }
    }
}