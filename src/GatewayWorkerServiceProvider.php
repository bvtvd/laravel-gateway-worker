<?php

namespace bvtvd\GatewayWorker;

use Illuminate\Support\ServiceProvider;

class GatewayWorkerServiceProvider extends ServiceProvider
{
    protected $commands = [
        Console\GatewayWorker::class,
        Console\Install::class
    ];

    public function boot()
    {
        if($this->app->runningInConsole()){
            $this->publishes([
                __DIR__ . '/../config/gatewayworker.php' => config_path('gatewayworker.php')
            ]);
        }
    }

    public function register()
    {
        $this->commands($this->commands);
    }
}
