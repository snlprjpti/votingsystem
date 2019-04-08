<?php

namespace App\Http\Controllers;

use App\Event;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var Vote
     */
    private $vote;
    /**
     * @var Event
     */
    private $event;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Vote $vote, Event $event)
    {
        $this->middleware('auth');
        $this->vote = $vote;
        $this->event = $event;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = Auth::user();
        $type = Auth::user()->type;
        if($type == 'admin'){
            $events = $this->event->where('status','active')->get();
            return view('admin.dashboard',compact('events'));
        }elseif($type == 'voter'){
            $events = $this->event->where('organizer_id',$auth->organizer_id)->where('status','active')->get();
            return view('voter.dashboard', compact('events'));
        }
        elseif($type == 'org'){
            $events = $this->event->where('organizer_id',$auth->id)->where('status','active')->get();
            return view('organizer.dashboard',compact('events'));
        }
        else{

        }
    }
}
