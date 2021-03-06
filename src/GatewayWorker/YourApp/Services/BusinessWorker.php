<?php
/**
 * Created by PhpStorm.
 * User: Hans
 * Email: hans01@foxmail.com
 * Date: 2018/12/4
 * Time: 11:25
 */

namespace bvtvd\GatewayWorker\GatewayWorker\YourApp\Services;


use bvtvd\GatewayWorker\Contracts\Service;

class BusinessWorker extends Service
{
    public function load()
    {
        // bussinessWorker 进程
        $worker = new \GatewayWorker\BusinessWorker();

        // worker名称
//        $worker->name = 'message-bussiness-worker';

        // bussinessWorker进程数量
        $worker->count = config('gatewayworker.YourApp.process_count');
        // 服务注册地址
        $worker->registerAddress = '127.0.0.1:' . config('gatewayworker.YourApp.register_port');

        /*
         * 设置处理业务的类为MyEvent。
         * 如果类带有命名空间，则需要把命名空间加上，
         * 类似$worker->eventHandler='\my\namespace\MyEvent';
         */
        $worker->eventHandler = 'bvtvd\GatewayWorker\GatewayWorker\YourApp\Events';
    }
}
