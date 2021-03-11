<?php
/**
 * Func :
 * Create By Lpb
 * Date: 2021/2/1 0001
 * Time: 16:23
 */

namespace process;

use Workerman\Crontab\Crontab;

class Task
{
    public function onWorkerStart()
    {
        // 每天的7点50执行，注意这里省略了秒位.
        new Crontab('50 7 * * *', function(){
            echo date('Y-m-d H:i:s')."\n";
        });
    }
}