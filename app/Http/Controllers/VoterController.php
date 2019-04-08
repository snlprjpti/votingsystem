<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Event;
use App\Post;
use App\Vote;
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
    /**
     * @var Vote
     */
    private $vote;

    public function __construct(Event $event, Post $post, Candidate $candidate, Vote $vote)
    {
        $this->middleware(['auth', 'verified']);
        $this->event = $event;
        $this->post = $post;
        $this->candidate = $candidate;
        $this->vote = $vote;
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
        $auth = Auth::user();
        $vote = $this->vote->where('event_id',$id)->where('voter_id',$auth->id)->get();
        $event =  $this->event->find($id);
        return view('voter.event', compact('event','vote'));
    }

    public function voteCandidate(Request $request, $id)
    {
        $voter = Auth::user()->id;
        $value = $request->vote;

        foreach ($value as $key=>$post){
            if(count($post) > 1)
            {
                session()->flash('warning', 'Invalid Voting');
                return back();
            }

            foreach($post as $user){

                $insert = $this->vote->create([
                    'event_id' => $id,
                    'post_id' => $key,
                    'can_id' => $user,
                    'voter_id' => $voter,
                ]);
            }
        }
        session()->flash('success', 'Successfully Voted!');
        return back();
    }
}