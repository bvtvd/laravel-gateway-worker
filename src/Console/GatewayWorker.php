<?php

namespace bvtvd\GatewayWorker\Console;

use App\GatewayWorker\Register;
use Illuminate\Console\Command;
use Workerman\Worker;

class GatewayWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gatewayworker {action} {--daemon}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start [-daemon] | stop | restart | reload | status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('display_errors', 'on');

        // 改变参数以便Worker 使用
        global $argv;
        array_shift($argv);

        // 守护进程处理
        $daemon = $this->option('daemon');
        $daemon && $argv[2] = '-d';


        if(strpos(strtolower(PHP_OS), 'win') === 0)
        {
            exit("start.php not support windows, please use start_for_win.bat\n");
        }

        // 检查扩展
        if(!extension_loaded('pcntl'))
        {
            exit("Please install pcntl extension. See http://doc3.workerman.net/appendices/install-extension.html\n");
        }

        if(!extension_loaded('posix'))
        {
            exit("Please install posix extension. See http://doc3.workerman.net/appendices/install-extension.html\n");
        }

        // 标记是全局启动
        define('GLOBAL_START', 1);

        Worker::$pidFile = storage_path('/gatewayworker/gatewayworker.pid');

        Worker::$stdoutFile = '/tmp/stdout.log';

        Worker::$logFile = storage_path('/gatewayworker/logs/gatewayworker.log');

        // 加载相关服务, 以便启动所有服务
        $this->loadServices();

        Worker::runAll();
    }


    public function loadServices()
    {
        $registerServices = new Register();

        foreach (array_collapse($registerServices->services) as $service){
            $obj = new $service;
            $obj->run();
        }
    }

    /**
     * Get stub contents.
     *
     * @param $name
     *
     * @return string
     */
    protected function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__."/stubs/$name.stub");
    }
}
