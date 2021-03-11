<?php
/**
 * Func :
 * Create By Lpb
 * Date: 2021/1/28 0028
 * Time: 21:42
 */

namespace app\api\controller;

use support\Request;

class Foo
{
    /**
     * 该方法会在请求前调用
     */
    public function beforeAction(Request $request)
    {
        echo 'beforeAction';
        // 若果想终止执行Action就直接返回Response对象，不想终止则无需return
        // return response('终止执行Action');
    }

    /**
     * 该方法会在请求后调用
     */
    public function afterAction(Request $request, $response)
    {
        echo 'afterAction';
        // 如果想串改请求结果，可以直接返回一个新的Response对象
        // return response('afterAction');
    }

    public function index(Request $request)
    {
        return response('hello index');
    }

    public function hello(Request $request)
    {
        return response('hello webman');
    }
}