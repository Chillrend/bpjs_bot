<?php

namespace App\Http\Controllers;

use App\Colosseum;
use App\Http\Requests\ColosseumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Spatie\WebhookServer\WebhookCall;
use Symfony\Component\Console\Output\ConsoleOutput;

class ColosseumController extends Controller
{

    public function index(){
        $colosseum = Colosseum::paginate(15);
        $time = Carbon::now('Asia/Jakarta');
        return view('colosseum.index', compact(['colosseum', 'time']));
    }

    public function show($colo_id){
        $event = Event::findOrFail($colo_id);

        return view('event.show', compact('event'));
    }

    public function create(){
        return view('colosseum.create');
    }

    public function store(ColosseumRequest $request){

        // WebhookCall::create()
        //         ->url(Config::get('discord.discord_webhook_url'))
        //         ->payload(['content' => 'HELLO TEMPEST DISCORD!'])
        //         ->useSecret('helloSecret')
        //         ->dispatch();

        $data = $request->validated();

        $colosseum = new Colosseum($data);
        $colosseum->save();

        $this->dispatchWebhook($colosseum);

        return redirect('/colosseum');
    }

    private function dispatchWebhook($colosseum){

        $output = new ConsoleOutput();

        $rival_w = Colosseum::where('rival', $colosseum->rival)->where('outcome', 'Victory')->get();
        $rival_l = Colosseum::where('rival', $colosseum->rival)->where('outcome', 'Defeat')->get();

        if($rival_w->count() == 0 && $rival_l->count() == 0){
            $rival_wr = 'No matches recorded';
        }else{
            $rival_wr = '*' . $rival_w->count() . 'W' . $rival_l->count() . 'L*';
        }

        $past_5_days = Colosseum::where('colosseum_date', '<=', date('Y-m-d'))->orderBy('colosseum_date', 'DESC')->limit(5)->get();

        $past_5_result = array();

        foreach ($past_5_days as $result) {
            $output->writeln('i get in for');
            if($result->outcome == 'Victory'){
                array_push($past_5_result, 'W');
                $output->writeln('i get in if W');
            }elseif ($result->outcome == 'Defeat'){
                array_push($past_5_result, 'L');
                $output->writeln('i get in if L');
            }
        }

        if(count($past_5_result) != 5){
            $minus = 5 - count($past_5_result);

            for ($i = 0; $i<$minus; $i++){
                array_unshift($past_5_result, '-');
                $output->writeln(implode($past_5_result));
            }
        }

        $past_result = implode($past_5_result);

        $payload = [
            'content' => "This day colosseum results : ",
            'embeds' => [
                [
                    'title' => $colosseum->colosseum_type . ' ' . $colosseum->colosseum_date . ' VS. ' . $colosseum->rival,
                    'fields' => [
                        [
                            'name' => 'Outcome',
                            'value' => $colosseum->outcome == 'Defeat' ? ':flag_white: ' . $colosseum->outcome . ' :flag_white:' : ':crossed_swords: ' . $colosseum->outcome . ' :crossed_swords:'
                        ],
                        [
                            'name' => 'Lifeforce',
                            'value' => $colosseum->lifeforce_our . ' vs. ' . $colosseum->lifeforce_theirs
                        ],
                        [
                            'name' => 'Match History vs. ' . $colosseum->rival,
                            'value' => $rival_wr
                        ],
                        [
                            'name' => 'Past 5 Days Colosseum Result',
                            'value' => '*' . $past_result . '*'
                        ]
                    ],
                    'description' => '*Access to the complete colosseum archive [here](https://madjavacoder.com/)*',
                    'color' => $colosseum->outcome == 'Victory' ? 2300919:16189705,
                    'footer' => [
                        'text' => 'All men created equals, except whales. Whales are not men.'
                    ]
                ]
            ]
        ];

        var_dump($payload);


        WebhookCall::create()
            ->url(Config::get('discord.discord_colosseum_webhook_url'))
            ->payload($payload)
            ->useSecret('sekrit')
            ->dispatch();

        $output->writeln(json_encode($payload));
    }

    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);

        return view('event.edit', compact('event'));
    }

    public function update($event_id, EventRequest $request)
    {
        $data = $request->validated();

        $event = Event::findOrFail($event_id);

        $event->fill($data);
        $event->save();

        return redirect('/event');
    }

    public function delete($colo_id)
    {
        Colosseum::findOrFail($colo_id)->delete();

        return redirect('/colosseum');
    }
}
