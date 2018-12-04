<?php

namespace bvtvd\GatewayWorker\Console;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gatewayworker:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install gatewayworker service';

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
        $directory = app_path('GatewayWorker');
        $yourAppDirectory = app_path('GatewayWorker/YourApp');
        $servicesDirestory = app_path('GatewayWorker/YourApp/Services');

        if(is_dir($directory)){
            $this->error($directory .' directory already exists!');
            return;
        }

        if(is_dir($yourAppDirectory)){
            $this->error($yourAppDirectory .' directory already exists!');
            return;
        }

        if(is_dir($servicesDirestory)){
            $this->error($servicesDirestory .' directory already exists!');
            return;
        }

        $this->makeDir($directory);
        $this->makeDir($yourAppDirectory);
        $this->makeDir($servicesDirestory);

        $this->createRegisterFile();
        $this->createEventsFile();
        $this->createServicesFiles('BusinessWorker');
        $this->createServicesFiles('Gateway');
        $this->createServicesFiles('Register');
    }


    /**
     * Make new directory.
     *
     * @param string $path
     */
    protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory($path, 0777, true, true);
        $this->info($path .' directory was created>');
    }

    protected function createRegisterFile()
    {
        $file = app_path('GatewayWorker/Register.php');

        $contents = $this->getStub('GatewayWorker/Register');
        $this->laravel['files']->put($file, $contents);

        $this->line('<info>Register file was created:</info> ' . $file);
    }

    protected function createEventsFile()
    {
        $file = app_path('GatewayWorker/YourApp/Events.php');

        $contents = $this->getStub('GatewayWorker/YourApp/Events');
        $this->laravel['files']->put($file, $contents);

        $this->line('<info>Events file was created:</info> ' . $file);
    }

    protected function createServicesFiles($name)
    {
        $file = app_path('GatewayWorker/YourApp/Services/' . $name . '.php');
        $contents = $this->getStub('GatewayWorker/YourApp/Services/'.$name);
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Services file was created:</info> ' . $file);
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
