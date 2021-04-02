<?php
/**
 * Func :
 * Create By Lpb
 * Date: 2021/1/30 0030
 * Time: 20:10
 */

namespace app\queue\redis;

use Webman\RedisQueue\Consumer;

class MyMailSend implements Consumer
{
    // 要消费的队列名
    public $queue = 'send_mail';

    // 连接名，对应 config/redis_queue.php 里的连接`
    public $connection = 'default';

    // 消费
    public function consume($data)
    {
        // 无需反序列化
        var_export($data); // 输出 ['to' => 'tom@gmail.com', 'content' => 'hello']
    }
}