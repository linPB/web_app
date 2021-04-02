<?php
/**
 * Func : 用户
 * Create By Lpb
 * Date: 2021/1/28 0028
 * Time: 21:14
 */

namespace app\admin\controller\sys;

use app\admin\model\sys\AdminUser;
use app\lib\assist\StrFun;
use support\Request;
use JasonGrimes\Paginator;

class User
{
    use StrFun;

    public function index(Request $request)
    {
        $params = $where = [];
        $params['page_size']    = $request->input('page_size', 5);
        $params['page_num']     = $request->input('page_num',  1);
        $params['user_name']    = $request->input('user_name', '');
        $params['email']        = $request->input('email', '');
        $params['phone']        = $request->input('phone', '');

        if($params['user_name'])    $where[] = ['user_name', 'like', "%{$params['user_name']}%"];
        if($params['email'])        $where[] = ['email', $params['email']];
        if($params['phone'])        $where[] = ['phone', $params['phone']];
        session(['url.params'=> $params,'url.path'=>$request->path()]);

        $rets = AdminUser::where($where)->skip(($params['page_num'] - 1) * $params['page_size'])->take($params['page_size'])->get();
        $paginator = new Paginator(AdminUser::where($where)->count(), $params['page_size'], $params['page_num'], session('url.path').$this->getUrlPattern());
        return view('sys/user/index', compact('rets', 'paginator'));
    }

    public function showEdit(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function edit(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function showStore(Request $request)
    {
        return view('sys/user/store');
    }

    public function store(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function del(Request $request)
    {
        if(AdminUser::find($request->input('id', 0))->delete()) {
            return response(json_encode(['code' => 0, 'msg' => '删除成功']));
        }
        return response(json_encode(['code' => 1, 'msg' => '删除失败']));
    }
}