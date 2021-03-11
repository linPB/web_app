<?php
/**
 * Func : 跨域请求中间件
 * Create By Lpb
 * Date: 2021/1/29 0029
 * Time: 11:59
 */

namespace app\middleware;


use Webman\MiddlewareInterface;
use Webman\Http\Request;
use Webman\Http\Response;

class AccessControl implements MiddlewareInterface
{
    public function process(Request $request, callable $next) : Response
    {
        $response = $request->method() == 'OPTIONS' ? response('') : $next($request);
        $response->withHeaders([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET,POST,PUT,DELETE,OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type,Authorization,X-Requested-With,Accept,Origin'
        ]);

        return $response;
    }
}