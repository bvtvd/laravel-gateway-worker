<?php
/**
 * Created by PhpStorm.
 * User: Hans
 * Email: hans01@foxmail.com
 * Date: 2018/12/4
 * Time: 11:26
 */

namespace bvtvd\GatewayWorker\GatewayWorker\YourApp\Services;


use bvtvd\GatewayWorker\Contracts\Service;

class Gateway extends Service
{
    public function load()
    {
        // gateway 进程，这里使用Text协议，可以用telnet测试
        $gateway = new \GatewayWorker\Gateway("Websocket://0.0.0.0:" . config('gatewayworker.YourApp.websocket_port'));

        // gateway名称，status方便查看
        $gateway->name = 'message-gateway';
        // gateway进程数
        $gateway->count = config('gatewayworker.YourApp.process_count');
        // 本机ip，分布式部署时使用内网ip
        //$gateway->lanIp = '127.0.0.1';
        $gateway->lanIp = config('gatewayworker.YourApp.lan_ip');
        // 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
        // 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
        $gateway->startPort = config('gatewayworker.YourApp.start_port');
        // 服务注册地址
        //$gateway->registerAddress = '127.0.0.1:'.getenv('REGISTER_PORT');
        $gateway->registerAddress = config('gatewayworker.YourApp.register_ip') . ':' . config('gatewayworker.YourApp.register_port');

        // 心跳间隔 秒
        $gateway->pingInterval = config('gatewayworker.YourApp.ping_interval');
        // 心跳数据
        $gateway->pingData = '{"type":"ping"}';
    }

}
