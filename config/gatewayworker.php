<?php

return [
    'YourApp' => [
        /**
         * websocket 监听端口
         */
        'websocket_port' => 11200,

        /**
         * 内部通信起始端口
         */
        'start_port' => 11400,

        /**
         * 服务注册ip
         */
        'register_ip' => '127.0.0.1',

        /**
         * 服务注册端口
         */
        'register_port' => 11238,

        /**
         * 进程数
         */
        'process_count' => 4,

        /**
         * 心跳间隔
         */
        'ping_interval' => 10,

        /**
         * 本机ip, 分布式部署时使用内网ip
         */
        'lan_ip' => '127.0.0.1',
    ]
];
