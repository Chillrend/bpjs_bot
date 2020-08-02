<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Spatie\WebhookServer\WebhookCall;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $event = Event::paginate(10);
        $time = Carbon::now('Asia/Jakarta');
        return view('event.index', compact(['event', 'time']));
    }

    public function show($event_id){
        $event = Event::findOrFail($event_id);

        return view('event.show', compact('event'));
    }

    public function create(){
        return view('event.create');
    }

    public function store(EventRequest $request){

        // WebhookCall::create()
        //         ->url(Config::get('discord.discord_webhook_url'))
        //         ->payload(['content' => 'HELLO TEMPEST DISCORD!'])
        //         ->useSecret('helloSecret')
        //         ->dispatch();

        $data = $request->validated();

        $event = new Event($data);
        $event->save();
        
        return redirect('/event');
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

    public function delete($event_id)   
    {
        Event::findOrFail($event_id)->delete();

        return redirect('/event');
    }
}
