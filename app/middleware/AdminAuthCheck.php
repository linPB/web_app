<?php
/**
 * Func : 用户身份验证中间件
 * Create By Lpb
 * Date: 2021/1/29 0029
 * Time: 11:55
 */

namespace app\middleware;

use app\lib\assist\CacheFun;
use Webman\MiddlewareInterface;
use Webman\Http\Request;
use Webman\Http\Response;
use support\bootstrap\Redis;

class AdminAuthCheck implements MiddlewareInterface
{
    use CacheFun;

    public function process(Request $request, callable $next) : Response
    {
        if (empty(session('id')) ) {
            if(strcmp($request->controller,'app\admin\controller\auth\Login' )==0) {
                if (strcmp($request->action,'logout' )==0) {
                    return redirect('/admin/auth/login/index');
                } else {
                    return $next($request);
                }
            } else {
                return redirect('/admin/auth/login/index');
            }
        } else {
            if(Redis::connection('session')->get('user_id:'.session('id'))) {
                if(strcmp($request->controller,'app\admin\controller\auth\Login' )==0 && strcmp($request->action,'index' )==0) {
                    return redirect('/admin/auth/index/home');
                } else {
                    if($request->isAjax() && !$this->hasAdminPermission($request->path(), session('id'))) {
                        return json(['code' => 1, 'msg' => 'sorry,您无此权限~']);
                    }
                    return $next($request);
                }
            } else {
                $request->session()->flush();
                return redirect('/admin/auth/login/index');
            }
        }
    }
}