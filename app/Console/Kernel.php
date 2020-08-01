<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\WebhookServer\WebhookCall;

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
        $file = 'C:\wamp64\www\bpjs__bot\output.log';
        // $schedule->command('inspire')->hourly();
        $schedule->call(function ()
        {

            WebhookCall::create()
                ->url('https://discordapp.com/api/webhooks/739056585430532126/-WfR0ieITYeJ5zbF2Wo_LdTpDYiieWYMOiGg-jCa56MT0zcnJXvl17qg9TXjbWQN78QL')
                ->payload(['content' => 'HELLO TEMPEST DISCORD!'])
                ->dispatch();

        })->everyMinute()->sendOutputTo($file);
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
