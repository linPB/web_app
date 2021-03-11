<?php
/**
 * Func :
 * Create By Lpb
 * Date: 2021/1/30 0030
 * Time: 20:26
 */

namespace app\queue\stomp;

use Workerman\Stomp\AckResolver;
use Webman\Stomp\Consumer;

class MyMailSend implements Consumer
{
    // 队列名
    public $queue = 'examples';

    // 连接名，对应 config/stomp.php 里的连接`
    public $connection = 'default';

    // 值为 client 时需要调用$ack_resolver->ack()告诉服务端已经成功消费
    // 值为 auto   时无需调用$ack_resolver->ack()
    public $ack = 'auto';

    // 消费
    public function consume($data, AckResolver $ack_resolver = null)
    {
        // 如果是数据是数组，需要自行反序列化
        var_export(json_decode($data, true)); // 输出 ['to' => 'tom@gmail.com', 'content' => 'hello']
        // 告诉服务端，已经成功消费
        $ack_resolver->ack(); // ack为 auto时可以省略此调用
    }
}