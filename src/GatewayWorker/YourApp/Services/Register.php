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

class Register extends Service
{
    public function load()
    {
        // register 服务必须是text协议
        $register = new \GatewayWorker\Register('text://0.0.0.0:'. config('gatewayworker.YourApp.register_port'));

        $register->name = 'message-register';
    }
}
