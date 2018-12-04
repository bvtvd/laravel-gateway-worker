<?php
/**
 * Created by PhpStorm.
 * User: Hans
 * Email: hans01@foxmail.com
 * Date: 2018/12/4
 * Time: 11:18
 */

namespace bvtvd\GatewayWorker\GatewayWorker;



class Register
{
    public $services = [
        'YourApp' => [
            YourApp\Services\BusinessWorker::class,
            YourApp\Services\Gateway::class,
            YourApp\Services\Register::class,
        ]
    ];
}
