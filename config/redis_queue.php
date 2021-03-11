<?php
return [
    'default' => [
        'host' => 'redis://192.168.33.12:6379',
        'options' => [
            'auth'          => '123456',     // 密码，可选参数
            'db'            => 2,      // 数据库
            'max_attempts'  => 5, // 消费失败后，重试次数
            'retry_seconds' => 5, // 重试间隔，单位秒
        ]
    ],
];