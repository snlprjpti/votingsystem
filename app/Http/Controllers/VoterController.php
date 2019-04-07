<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Event;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    /**
     * @var Event
     */
    private $event;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var Candidate
     */
    private $candidate;

    public function __construct(Event $event, Post $post, Candidate $candidate)
    {
        $this->middleware(['auth', 'verified']);
        $this->event = $event;
        $this->post = $post;
        $this->candidate = $candidate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $events = $this->event->where('organizer_id',$auth->organizer_id)->where('status','active')->get();

        return view('voter.index', compact('events'));
    }

    public function eventShow($id)
    {
        $event =  $this->event->find($id);
        return view('voter.event', compact('event'));
    }

}
