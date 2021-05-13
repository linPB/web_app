<?php
/**
 * Func : 用户
 * Create By Lpb
 * Date: 2021/1/28 0028
 * Time: 21:14
 */

namespace app\admin\controller\sys;

use app\admin\model\sys\AdminUser;
use app\admin\model\sys\AdminRole;
use support\DB;
use app\lib\assist\StrFun;
use support\bootstrap\Redis;
use support\Request;

class User
{
    use StrFun;

    public function index()
    {
        return view('sys/user/index');
    }

    public function show(Request $request)
    {
        $params = $where = [];
        $params['page_size']    = $request->input('page_size', 10);
        $params['page_num']     = $request->input('page_num',  1);
        $params['user_name']    = $request->input('user_name', '');
        $params['email']        = $request->input('email', '');
        $params['phone']        = $request->input('phone', '');

        if($params['user_name'])    $where[] = ['user_name', 'like', "%{$params['user_name']}%"];
        if($params['email'])        $where[] = ['email', $params['email']];
        if($params['phone'])        $where[] = ['phone', $params['phone']];
        $list = AdminUser::where($where)
            ->orderBy($request->input('sort', 'id'), $request->input('sort_order', 'desc'))
            ->skip(($params['page_num'] - 1) * $params['page_size'])
            ->take($params['page_size'])
            ->get();
        foreach ($list as $v) $v->roles = AdminUser::find($v->id)->roles()->get()->toArray();

        return json(['code' => 0, 'msg' => 'ok', 'data' => [
            'page_num' => $params['page_num'],
            'page_size' => $params['page_size'],
            'total' => AdminUser::where($where)->count(),
            'list' => $list,
        ]]);
    }

    public function editShow(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            if(empty($id)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            $roles = AdminRole::all();
            $user_roles = AdminUser::find($id)->roles()->get();
            foreach ($roles as $role) {
                $role->selected = 0;
                foreach ($user_roles as $user_role){
                    if($user_role->id == $role->id) {
                        $role->selected = 1;
                    }
                }
            }

            return json(['code' => 0, 'msg' => 'success', 'data' => ['roles' => $roles]]);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function edit(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            $user_name = $request->input('user_name', '');
            $phone = $request->input('phone', '');
            $role = $request->input('role', '');

            DB::beginTransaction();
            try{
                DB::table('admin_user')
                    ->where('id', $id)
                    ->update([
                        'user_name' => $user_name,
                        'phone'     => $phone,
                        'created_at'=> date('y-m-d H:i:s', time()),
                        'updated_at'=> date('y-m-d H:i:s', time()),
                ]);
                if(!empty($role)) {
                    DB::table('admin_u_r')->where('user_id', $id)->delete();
                    DB::table('admin_u_r')->insert(['user_id' => $id    , 'role_id' => $role]);
                }
                DB::commit();//提交至数据库
            }catch(\Exception $e){
                DB::rollback();//数据库回滚
                return json(['code' => 1, 'msg' => '修改失败']);
            }

            Redis::connection('session')->del('user_id:'.$id);
            Redis::connection('session')->del('admin_permission:'.$id);
            return json(['code' => 0, 'msg' => '修改成功']);

        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function storeShow()
    {
        try {
            return json(['code' => 0, 'msg' => 'success', 'data' => ['roles' => AdminRole::all()]]);
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->only(['user_name', 'password', 'phone', 'email', 'role']);
            if(empty($data['user_name']) || empty($data['password']) || empty($data['phone']) || empty($data['email'])) return json(['code' => 1, 'msg' => '添加失败，请完整信息']);
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            DB::beginTransaction();
            try{
                $user_id = DB::table('admin_user')->insertGetId([
                    'user_name' => $data['user_name'],
                    'password'  => $data['password'],
                    'phone'     => $data['phone'],
                    'email'     => $data['email'],
                    'avatar_url'=> '/adminlte/dist/img/avatar.png',
                    'created_at'=> date('y-m-d H:i:s', time()),
                    'updated_at'=> date('y-m-d H:i:s', time()),
                ]);
                if(!empty($data['role']))  DB::table('admin_u_r')->insert(['user_id' => $user_id, 'role_id' => $data['role']]);
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
                DB::table('admin_user')->whereIn('id', explode(',', $ids))->delete();
                DB::table('admin_u_r')->whereIn('user_id', explode(',', $ids))->delete();
                DB::commit();//提交至数据库
            }catch(\Exception $e){
                DB::rollback();//数据库回滚
                return response(json_encode(['code' => 1, 'msg' => '删除失败']));
            }
            $ids = explode(',', $ids);
            foreach ($ids as $id) {
                Redis::connection('session')->del('user_id:'.$id);
                Redis::connection('session')->del('admin_permission:'.$id);
            }
            return response(json_encode(['code' => 0, 'msg' => '删除成功']));
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员'.$e->getMessage()]);
        }
    }

    public function resetPd(Request $request)
    {
        try {
            $id = $request->input('id', 0);
            $new_pd = $request->input('new_pd', '');
            $new_pd_confirm = $request->input('new_pd_confirm', '');
            if(empty($id)) return json(['code' => 1, 'msg' => '系统参数异常，请联系管理员']);
            if(empty($new_pd) || empty($new_pd_confirm)) return json(['code' => 1, 'msg' => '密码不允许留空']);
            if($new_pd != $new_pd_confirm) return json(['code' => 1, 'msg' => '密码不一致，再次请确认两次输入的密码']);

            if(AdminUser::where('id', $id)->update(['password' => password_hash($new_pd, PASSWORD_DEFAULT)])) {
                Redis::connection('session')->del('user_id:'.$id);
                return json(['code' => 0, 'msg' => '重置成功']);
            } else {
                return json(['code' => 1, 'msg' => '重置失败']);
            }
        } catch (\Exception $e) {
            return json(['code' => 1, 'msg' => '系统异常，请联系管理员']);
        }
    }
}