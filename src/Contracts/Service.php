<?php
/**
 * Created by PhpStorm.
 * User: Hans
 * Email: hans01@foxmail.com
 * Date: 2018/12/4
 * Time: 11:44
 */

namespace bvtvd\GatewayWorker\Contracts;


use Workerman\Worker;

abstract class Service
{
    public function run()
    {
        $this->load();

        // 如果不是在根目录启动，则运行runAll方法
        if(!defined('GLOBAL_START')) {
            Worker::runAll();
        }
    }

     public function load(){}
}
