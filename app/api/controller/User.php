<?php
/**
 * Func :
 * Create By Lpb
 * Date: 2021/1/28 0028
 * Time: 21:14
 */

namespace app\api\controller;

use support\Request;
use support\Db;
use app\api\model\User as DbUser;
use support\bootstrap\Log;
use support\bootstrap\Redis;
use Webman\RedisQueue\Client;
use Respect\Validation\Validator as v;
use Webman\Stomp\Client as SClient;
use JasonGrimes\Paginator;
use Intervention\Image\ImageManagerStatic;
use Gregwar\Captcha\CaptchaBuilder;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        Log::channel('api')->info('log test',['a'=>1,'b'=>2]);
        return 222;
    }

    public function db(Request $request)
    {
        $id = $request->get('uid', 1);
        $name = Db::table('users')->where('id', $id)->value('user_name');
        return response("hello $name");
    }

    public function user(Request $request)
    {
        $users = DbUser::all();
        return json($users);
    }

    public function testRedis()
    {
        $key = 'test_key';
        Redis::connection('cache')->set($key, rand());
        return response(Redis::connection('cache')->get($key));
    }

    public function testRedisQueue()
    {
        // 队列名
        $queue = 'send_mail';
        // 数据，可以直接传数组，无需序列化
        $data = ['to' => 'tom@gmail.com', 'content' => 'hello'];
        // 投递消息
        Client::send($queue, $data);
        // 投递延迟消息，消息会在60秒后处理
        Client::send($queue, $data, 60);
        return 'RedisQueue';
    }

    public function testStompQueue()
    {
        // 队列
        $queue = 'examples';
        // 数据（传递数组时需要自行序列化，比如使用json_encode，serialize等）
        $data = json_encode(['to' => 'tom@gmail.com', 'content' => 'hello']);
        // 执行投递
        SClient::send($queue, $data);
        return 'StompQueue';
    }

    public function validateValue(Request $request)
    {
        $data = v::input($request->post(), [
            'nike_name' => v::length(1, 64)->setName('昵称'),
            'user_name' => v::alnum()->length(5, 64)->setName('用户名'),
            'phone' => v::min(11)->max(11)->setName('密码')
        ]);
        Db::table('users')->insert($data);
        return json(['code' => 0, 'msg' => 'ok']);
    }

    public function testPage(Request $request)
    {
        $total_items = 1000;
        $items_perPage = 50;
        $current_page = (int)$request->get('page', 1);
        $url_pattern = '/api/user/testPage?page=(:num)';
        $paginator = new Paginator($total_items, $items_perPage, $current_page, $url_pattern);
        return view('get', ['paginator' => $paginator]);
    }

    public function testTrans(Request $request)
    {
        $hello = trans('apple_count', ['%count%' => 100]);
        return response($hello);
    }

    public function imgForm()
    {
        return view('image');
    }

    public function img(Request $request)
    {
        $file = $request->file('file');
        if ($file && $file->isValid()) {
            $image = ImageManagerStatic::make($file)->resize(100, 100);
            return response($image->encode('png'), 200, ['Content-Type' => 'image/png']);
        }
        return response('file not found');
    }

    /**
     * 测试页面
     */
    public function login(Request $request)
    {
        return view('login');
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

    /**
     * 检查验证码
     */
    public function check(Request $request)
    {
        // 获取post请求中的captcha字段
        $captcha = $request->post('captcha');
        // 对比session中的captcha值
        if (strtolower($captcha) !== $request->session()->get('captcha')) {
            return json(['code' => 400, 'msg' => '输入的验证码不正确']);
        }
        return json(['code' => 0, 'msg' => 'ok']);
    }

    public function export($request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $file_path = public_path().'/hello_world.xlsx';
        // 保存文件到 public 下
        $writer->save($file_path);
        // 下载文件
        return response()->download($file_path, '文件名.xlsx');
    }
}