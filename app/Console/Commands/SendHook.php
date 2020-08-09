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

        $_ev_5 = Event::where('time', 'like', '%'.Carbon::now('Asia/Jakarta')->addMinutes(5)->format('H:i').'%')->get();

        if(!empty($_ev_5)){
            $this->info('Found ' . $_ev_5->count()  . ' entries matching ' . Carbon::now('Asia/Jakarta')->addMinutes(5)->format('H:i'));
            foreach ($_ev_5 as $list){
                if($list->remind_five_minutes_before == 1){
                    $this->info('Sending 5 minutes before webhook for ' . $list->event_title);
                    $this->dispatchWebhook($list);
                }
            }
        }

        if (!empty($_ev)){
            $this->info('Found ' . $_ev->count()  . ' matching ' . Carbon::now('Asia/Jakarta')->format('H:i'));

            foreach($_ev as $list)
            {
                $this->info('Sending webhook for' . $list->event_title);
                $this->dispatchWebhook($list);
            }
        }
    return $_ev ? 1 : 0;
    }

    private function dispatchWebhook($list){
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

        WebhookCall::create()
            ->url(Config::get('discord.discord_webhook_url'))
            ->payload($payload)
            ->useSecret('helloSecret')
            ->dispatch();

    }
}
