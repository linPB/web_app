<?php
/**
 * Func : 权限
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 21:57
 */

namespace app\admin\controller\sys;

use app\admin\model\sys\AdminPermission;
use app\lib\assist\CacheFun;
use support\Request;

class Permission
{
    use CacheFun;

    public function index()
    {
        return view('sys/permission/index');
    }

    public function show(Request $request)
    {
        $params = $where = [];
        $params['page_size']    = $request->input('page_size', 10);
        $params['page_num']     = $request->input('page_num',  1);
        $params['name']         = $request->input('name', '');
        $params['type']         = $request->input('type', '');

        if($params['name'])    $where[] = ['name', 'like', "%{$params['name']}%"];
        if($params['type'])    $where[] = ['type', $params['type']];

        $list = AdminPermission::where($where)
            ->orderBy($request->input('sort', 'id'), $request->input('sort_order', 'desc'))
            ->skip(($params['page_num'] - 1) * $params['page_size'])
            ->take($params['page_size'])
            ->get();

        return json(['code' => 0, 'msg' => 'ok', 'data' => [
            'page_num' => $params['page_num'],
            'page_size' => $params['page_size'],
            'total' => AdminPermission::where($where)->count(),
            'list' => $list,
        ]]);
    }

    public function edit(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            $name = $request->input('name', '');
            $path = $request->input('path', '');
            $type = $request->input('type', 1);
            if(empty($name)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            if(AdminPermission::where('id', $id)->update(['name' => $name, 'path' => $path, 'type' => $type])) {
                $this->delAdminPermissions('admin_permission:*');
                return json(['code' => 0, 'msg' => '修改成功']);
            } else {
                return json(['code' => 1, 'msg' => '修改失败']);
            }
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['name', 'path', 'type']);
            if(empty($data['name'])) return json(['code' => 1, 'msg' => '添加失败，请完整信息']);
            if(AdminPermission::create($data)) {
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
            $ids = $request->input('ids', '');
            if(empty($ids)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            if(AdminPermission::whereIn('id', explode(',', $ids))->delete()) {
                $this->delAdminPermissions('admin_permission:*');
                return response(json_encode(['code' => 0, 'msg' => '删除成功']));
            } else {
                return response(json_encode(['code' => 1, 'msg' => '删除失败']));
            }
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }
}