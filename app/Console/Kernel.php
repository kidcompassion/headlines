<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call('\App\Http\Controllers\EJController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\SunController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\MetroController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\CtvController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\CbcController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\AptnController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\GlobalController@insert')->hourly();
        $schedule->call('\App\Http\Controllers\EJController@clear')->weekly()->tuesdays()->at('11:00');
        $schedule->call('\App\Http\Controllers\SunController@clear')->weekly()->tuesdays()->at('11:00');
        $schedule->call('\App\Http\Controllers\MetroController@clear')->weekly()->tuesdays()->at('11:00');
        $schedule->call('\App\Http\Controllers\CtvController@clear')->weekly()->tuesdays()->at('11:00');
        $schedule->call('\App\Http\Controllers\CbcController@clear')->weekly()->tuesdays()->at('11:00');
        $schedule->call('\App\Http\Controllers\AptnController@clear')->weekly()->tuesdays()->at('11:00');
        $schedule->call('\App\Http\Controllers\GlobalController@clear')->weekly()->tuesdays()->at('11:00');


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
