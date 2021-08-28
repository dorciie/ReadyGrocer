<?php

namespace App\Console;

// use App\Console\Commands\DeletePromotion;
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
        //
        Commands\DeletePromotion::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    $schedule->command('Promotion:delete')
                 ->dailyAt('00:00')
                // ->everyMinute()
                 ->timezone('Asia/Kuala_Lumpur');
                //  ->withoutOverlapping()
                //  ->runInBackground();
    // $schedule->command('Promotion:delete')
    //              ->everyMinute()
    //              ->timezone("Asia/Kuala_Lumpur");
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
