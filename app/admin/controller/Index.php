<?php
/**
 * Func : 登入初始化页面布局
 * Create By Lpb
 * Date: 2021/2/3 0003
 * Time: 21:12
 */

namespace app\admin\controller;


class Index
{
    public function dashboard()
    {
        return view('auth/index/base');
    }

    public function home()
    {
        return view('auth/index/home');
    }
}