<?php
/**
 * Func : 角色
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 21:57
 */

namespace app\admin\controller\sys;

use app\admin\model\sys\AdminRole;
use app\admin\model\sys\AdminPermission;
use app\lib\assist\CacheFun;
use support\DB;
use support\Request;

class Role
{
    use CacheFun;

    public function index()
    {
        return view('sys/role/index');
    }

    public function show(Request $request)
    {
        try {
            $params = $where = [];
            $params['role_name']    = $request->input('role_name', '');

            if($params['role_name'])    $where[] = ['role_name', 'like', "%{$params['role_name']}%"];
            $list = AdminRole::where($where)->orderBy($request->input('sort', 'id'), $request->input('sort_order', 'desc'))->get();
            foreach ($list as $v) $v->permissions = AdminRole::find($v->id)->permissions()->get();
            return json(['code' => 0, 'msg' => 'ok', 'data' => ['list' => $list,]]);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => $e->getMessage()]);
        }
    }

    public function editShow(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            if(empty($id)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            $data = AdminRole::find('id');
            $permissions = AdminPermission::all();
            $role_permisssions = AdminRole::find($id)->permissions()->get();
            foreach ($permissions as $permission) {
                $permission->selected = 0;
                foreach ($role_permisssions as $role_permisssion){
                    if($permission->id == $role_permisssion->id) {
                        $permission->selected = 1;
                    }
                }
            }

            return json(['code' => 0, 'msg' => 'success', 'data' => ['data' => $data, 'permissions' => $permissions]]);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function edit(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            $role_name = $request->input('role_name', '');
            $permission_id = $request->input('permission_id', []);
            if(empty($id) || empty($role_name)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);

            $insert_data = [];
            if($permission_id) {
                foreach ($permission_id as $p_id) {
                    $insert_data[] = ['role_id' => $id, 'permission_id' => $p_id];
                }
            }

            DB::beginTransaction();
            try{
                DB::table('admin_role')->where('id', $id)->update(['role_name' => $role_name]);
                DB::table('admin_r_p')->where('role_id', $id)->delete();
                DB::table('admin_r_p')->insert($insert_data);
                DB::commit();//提交至数据库
            }catch(\Exception $e){
                DB::rollback();//数据库回滚
                return json(['code' => 1, 'msg' => '修改失败']);
            }
            $this->delAdminPermissions('admin_permission:*');
            return json(['code' => 0, 'msg' => '修改成功']);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function storeShow()
    {
        try {
            return json(['code' => 0, 'msg' => 'success', 'data' => ['permissions' => AdminPermission::all()]]);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function store(Request $request)
    {
        try {
            $role_name = $request->input('role_name', '');
            $permission_id = $request->input('permission_id', []);
            if(empty($role_name)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);

            DB::beginTransaction();
            try{
                $role_id = DB::table('admin_role')->insertGetId(['role_name' => $role_name]);
                $insert_data = [];
                if($permission_id) {
                    foreach ($permission_id as $p_id) {
                        $insert_data[] = ['role_id' => $role_id, 'permission_id' => $p_id];
                    }
                }
                DB::table('admin_r_p')->insert($insert_data);
                DB::commit();//提交至数据库
            }catch(\Exception $e){
                DB::rollback();//数据库回滚
                return json(['code' => 1, 'msg' => '添加失败']);
            }
            return json(['code' => 0, 'msg' => '添加成功']);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function del(Request $request)
    {
        try {
            $ids = $request->input('ids', '');
            if(empty($ids)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);

            DB::beginTransaction();
            try{
                DB::table('admin_role')->whereIn('id', explode(',', $ids))->delete();
                DB::table('admin_r_p')->whereIn('role_id', explode(',', $ids))->delete();
                DB::commit();//提交至数据库
            }catch(\Exception $e){
                DB::rollback();//数据库回滚
                return response(json_encode(['code' => 1, 'msg' => '删除失败']));
            }
            $this->delAdminPermissions('admin_permission:*');
            return response(json_encode(['code' => 0, 'msg' => '删除成功']));
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }
}