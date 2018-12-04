## Laravel GatewayWorker

#### About
This package is based on GatewayWorker which is used for socket application.

#### Quick Start 

```
composer require bvtvd/laravel-gateway-worker
```

```
php artisan vendor:publish --provider="bvtvd\GatewayWorker\GatewayWorkerServiceProvider"
```

```
php artisan gatewayworker:install
```

run application
```
php artisan gatewayworker start
```

run application in daemon
```
php artisan gatewayworker start --daemon
```

other command
```
php artisan gatewayworker [stop | restart | reload | status]
```

#### develop

- you can see GatewayWorker docs [here](http://doc2.workerman.net/)
- app/GatewayWorker is the main directory for develop. YourApp is an Example for reference.

