<?php

namespace App\Console;


use App\Console\Commands\sendCheckOutReminderEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
date_default_timezone_set("Asia/Kuala_Lumpur");
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
       Commands\DeletePromotion::class,
       Commands\cronEmail::class,
       Commands\updateCart::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('Promotion:delete')
                 ->dailyAt('00:00')
                 ->timezone('Asia/Kuala_Lumpur');

         $schedule->command('Checkout:email')
                 ->everyMinute();

        $schedule->command('cart:update')
                ->everyMinute();
                // ->dailyAt('00:00')
                // ->timezone('Asia/Kuala_Lumpur');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
