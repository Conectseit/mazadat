<?php

namespace App\Console;

use App\Console\Commands\MakeActivationCodeExpire;
use App\Console\Commands\UpdateAuctionSatusDone;
use App\Console\Commands\UpdateAuctionsStatusOnProgress;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\App;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('auction:update_status_on_progress');
        $schedule->command('auction:update_status_done');
//        $schedule->command('auction:update_status_done')->everyMinute();
        $schedule->command('user:make-activation_code-expired');

    }

    protected $commands = [
        //
        UpdateAuctionsStatusOnProgress::class ,
        UpdateAuctionSatusDone::class ,
        MakeActivationCodeExpire::class ,
    ];
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');

    }


}
