<?php
/**
 * Func : 权限
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 21:57
 */

namespace app\admin\controller\sys;


use support\Request;

class Permission
{
    public function index(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function showEdit(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function edit(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function store(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function showStore(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }
}