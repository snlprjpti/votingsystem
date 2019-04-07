<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventRequest;
use App\Post;
use App\Repository\EventRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    /**
     * @var EventRepository
     */
    private $eventRepository;
    /**
     * @var Event
     */
    private $event;
    /**
     * @var Post
     */
    private $post;

    /**
     * EventController constructor.
     */
    public function __construct(EventRepository $eventRepository, Event $event, Post $post)
    {
        $this->eventRepository = $eventRepository;
        $this->middleware(function ($request, $next) {
            if(Gate::allows('isOrganizer')){
                return $next($request);
            }
            abort(401);
        });
        $this->event = $event;
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org = Auth::user()->id;
        $events = $this->eventRepository->getEventByOrganizer($org);
        return view('organizer.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        try {
            $request['status'] = 'inactive';
            $request['organizer_id'] = Auth::user()->id;
            $event = $this->event->create($request->all());
            if ($event) {

                session()->flash('success', 'User Successfully Created!');
                return back();

            } else {
                session()->flash('success', 'User could not be Create!');
                return back();
            }


        } catch (\Exception $e) {
            $e = $e->getMessage();
            session()->flash('error', 'Exception : '.$e);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = (int)$id;
            $edits = $this->eventRepository->findById($id);
            if ($edits->count() > 0) {
                $events = $this->eventRepository->getEventByOrganizer(Auth::user()->id);

                return view('organizer.event.index', compact('events', 'edits'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $event = $this->eventRepository->findById($id);
            $request['status'] = 'inactive';
            $request['organizer_id'] = Auth::user()->id;
            if ($event) {
                $update = $event->fill($request->all())->save();
                if ($update) {
                    session()->flash('success', 'Event Successfully updated!');
                    return redirect(route('events.index'));
                } else {
                    session()->flash('error', 'Event could not be update!');
                    return back();
                }
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $event = $this->eventRepository->findById($id);
            if ($event) {

                $value = $this->post->where('event_id',$id)->get();
                if(count($value)>0)
                {
                    session()->flash('warning', 'Event Cannot be deleted');
                    return back();
                }
                $event->delete();
                session()->flash('success', 'Event successfully deleted!');
                return back();
            } else {
                session()->flash('error', 'Event could not be delete!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }
}
