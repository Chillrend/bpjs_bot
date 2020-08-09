<?php

namespace App\Console\Commands;

use App\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Spatie\WebhookServer\WebhookCall;
use Illuminate\Support\Facades\Log;

class SendHook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpjs:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim webhook lur';

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
     * @return int
     */
    public function handle()
    {
        $_ev = Event::where('time', 'like', '%'.Carbon::now('Asia/Jakarta')->format('H:i').'%')->get();

 	Log::error('initiating job at ' . Carbon::now('Asia/Jakarta'));
	Log::error('found '. count($_ev) .' object matching the time '. Carbon::now('Asia/Jakarta')->format('H:i'));


        if (!empty($_ev)){
            foreach($_ev as $list)
            {
                $payload = [
                    'content' => empty($list->mentions) ? '' : $list->mentions,
                    'embeds' => [
                        [
                            'title' => $list->event_title . ' @' . $list->time, 
                            'description' => $list->event_description,
                            'color' => 23334,
                            'timestamp' => Carbon::now(),
                            'image' => ['url' => empty($list->event_image_url) ? '' : $list->event_image_url]
                        ]
                    ]
                ];
                Log::error('Sending a webhook for .' . $list->event_title);

                WebhookCall::create()
                ->url(Config::get('discord.discord_webhook_url'))
                ->payload($payload)
                ->useSecret('helloSecret')
                ->dispatch();

            }
        }
    return $_ev ? 1 : 0;
    }
}
