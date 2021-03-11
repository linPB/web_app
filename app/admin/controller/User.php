<?php
/**
 * Func : 用户
 * Create By Lpb
 * Date: 2021/1/28 0028
 * Time: 21:14
 */

namespace app\admin\controller;

use support\Request;
use support\bootstrap\Log;

class User
{
    public function index(Request $request)
    {
        return $request->controller.'->'.$request->action;
    }

    public function get($request, $id)
    {
        return response('接收到参数'.$id);
    }

    public function hello(Request $request)
    {
        return 'hello';
    }

    public function login(Request $request)
    {
        return 'login';
    }
}