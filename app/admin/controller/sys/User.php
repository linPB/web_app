<?php
/**
 * Func : 用户
 * Create By Lpb
 * Date: 2021/1/28 0028
 * Time: 21:14
 */

namespace app\admin\controller\sys;

use support\Request;
use support\bootstrap\Log;

class User
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