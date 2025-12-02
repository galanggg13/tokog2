<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();
$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
*/
$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Database & Migration Providers
|--------------------------------------------------------------------------
| WAJIB supaya migration jalan di Railway (Lumen default tidak aktif)
*/
$app->register(Illuminate\Database\DatabaseServiceProvider::class);
$app->register(Illuminate\Database\MigrationServiceProvider::class);

/*
|--------------------------------------------------------------------------
| MANUAL BINDING untuk Migration Repository & Migrator
| (Lumen butuh ini untuk bisa jalanin "php artisan migrate")
|--------------------------------------------------------------------------
*/
$app->singleton('migration.repository', function ($app) {
    return new Illuminate\Database\Migrations\DatabaseMigrationRepository(
        $app['db'], 'migrations'
    );
});

$app->singleton('migrator', function ($app) {
    return new Illuminate\Database\Migrations\Migrator(
        $app['migration.repository'],
        $app['db'],
        $app['files']
    );
});

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/
$app->routeMiddleware([
    'auth' => App\Http\Middleware\AuthMiddleware::class,
    'admin' => App\Http\Middleware\AdminMiddleware::class,
]);

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
*/
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
*/
$app->register(App\Providers\AuthServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load Routes
|--------------------------------------------------------------------------
*/
$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
