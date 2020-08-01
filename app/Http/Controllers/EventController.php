<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Spatie\WebhookServer\WebhookCall;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $event = Event::paginate(10);

        return view('event.index', compact('event'));
    }

    public function create(){
        return view('event.create');
    }

    public function store(EventRequest $request){

        WebhookCall::create()
                ->url('https://discordapp.com/api/webhooks/739056585430532126/-WfR0ieITYeJ5zbF2Wo_LdTpDYiieWYMOiGg-jCa56MT0zcnJXvl17qg9TXjbWQN78QL')
                ->payload(['content' => 'HELLO TEMPEST DISCORD!'])
                ->dispatch();


        // $data = $request->validated();

        // $event = new Event($data);
        // $event->save();
        
        return redirect('/event');
    }
}
