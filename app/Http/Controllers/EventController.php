<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

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
}
