<?php
/**
 * Func : 登陆、登出
 * Create By Lpb
 * Date: 2021/2/1 0001
 * Time: 21:08
 */

namespace app\admin\controller\auth;


use support\Request;
use app\admin\model\sys\AdminUser;
use support\bootstrap\Redis;
use Gregwar\Captcha\CaptchaBuilder;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\ValidationException;

class Login
{
    public function index()
    {
        return view('auth/login/index');
    }

    public function doLogin(Request $request)
    {
        try {
            $params =Validator::input($request->post(), [
                'remember' => Validator::alwaysValid()->setName('记住状态'),
                'email' => Validator::Email()->setName('用户名'),
                'password' => Validator::StringType()->length(6, 18)->setName('密码'),
                'captcha' => Validator::StringType()->length(4, 6)->setName('验证码')
            ]);
        } catch (ValidationException $e) {
            return view('auth/login/index', ['errors' => [$e->getMessage()]]);
        }

        // 对比session中的captcha值
        if (strtolower($params['captcha']) !== $request->session()->get('captcha')) return view('auth/login/index', ['errors' => ['输入的验证码不正确']]);

        $user = AdminUser::where('email', $params['email'])->first();
        if (empty($user)){
            return view('auth/login/index', ['errors' => ['用户不存在']]);
        } else {
            if (password_verify($params['password'], $user->password)) {
                $user->login_num = (int)$user->login_num + 1;
                $user->last_login_at = date('Y-m-d H:i:s');
                $user->last_login_ip = $request->getRealIp($safe_mode=true);
                $user->save();
                /**
                 * workerman或者webman里 session过期时间受到 php.ini中 session.cookie_lifetime 和 session.gc_maxlifetime 控制，
                 * 如果你想要长时间不过期，可以将这2个值调大一些
                 * session.cookie_lifetime 以秒数指定了发送到浏览器的 cookie 的生命周期。值为 0 表示“直到关闭浏览器”。默认为 0
                 * 如果设置cookie_lifetime为7200,则表示存活2个小时,此时就算关闭浏览器也不会删除session,再次打开浏览器依然保持登录状态
                 * session.gc.maxlifetime指设置session最大的过期时间，指php按照一定的几率 执行它的垃圾回收机制，
                 * 这个机制指判断当前时间减去session文件最后修改时间是否大于session.gc.maxlifetime，是则删除session文件；
                 * 默认时间1440 24分钟
                 *
                 * 将php.ini中 session.cookie_lifetime 和 session.gc_maxlifetime置为7天，记住我时就用7天
                 * 使用redis在套一层壳，判断是否要提前登出
                 */
                $life_time = 2 * 3600;
                if ($params['remember'] == true) $life_time = 7 * 24 * 3600;
                Redis::connection('session')->set('user_id:'.$user->id ,$user->user_name ,'EX',$life_time);
                session($user->toArray());
                return redirect('/admin/auth/index/home');
            } else {
                return view('auth/login/index', ['errors' => ['密码错误']]);
            }
        }
    }

    public function logout(Request $request)
    {
        Redis::connection('session')->del('user_id:'.session('id'));
        $request->session()->flush();
        return redirect('/admin/auth/login/index');
    }

    /**
     * 输出验证码图像
     */
    public function captcha(Request $request)
    {
        // 初始化验证码类
        $builder = new CaptchaBuilder;
        // 生成验证码
        $builder->build();
        // 将验证码的值存储到session中
        $request->session()->set('captcha', strtolower($builder->getPhrase()));
        // 获得验证码图片二进制数据
        $img_content = $builder->get();
        // 输出验证码二进制数据
        return response($img_content, 200, ['Content-Type' => 'image/jpeg']);
    }
}