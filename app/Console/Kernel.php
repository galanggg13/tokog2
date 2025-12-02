<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // AKTIFKAN SUPPORT MIGRATION COMMANDS DI LUMEN
        \Illuminate\Database\Console\Migrations\MigrateCommand::class,
        \Illuminate\Database\Console\Migrations\RollbackCommand::class,
        \Illuminate\Database\Console\Migrations\RefreshCommand::class,
        \Illuminate\Database\Console\Migrations\ResetCommand::class,
        \Illuminate\Database\Console\Migrations\InstallCommand::class,
        \Illuminate\Database\Console\Migrations\StatusCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
