<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

return [

    'type'    => 'redis', // file or redis or redis_cluster

    //'handler' => Webman\FileSessionHandler::class,              //type 为file
    'handler' => Webman\RedisSessionHandler::class,             //type redis
    //'handler' => Webman\RedisClusterSessionHandler::class,      //type redis集群

    'config' => [
        'file' => [
            'save_path' => runtime_path() . '/sessions',
        ],
        'redis' => [
            'host'      => env('REDIS_HOST', '127.0.0.1'),
            'port'      => env('REDIS_PORT', 6379),
            'auth'      => env('REDIS_PASSWORD', 123456),
            'timeout'   => 2,
            'database'  => 2,
            'prefix'    => 'redis_session_',
        ],
        'redis_cluster' => [
            'host'    => ['127.0.0.1:7000', '127.0.0.1:7001', '127.0.0.1:7001'],
            'timeout' => 2,
            'auth'    => '',
            'prefix'  => 'redis_session_',
        ]
    ],

    'session_name' => 'PHPSID',
];
