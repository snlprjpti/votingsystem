<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Http\Requests\CandidateRequest;
use App\Post;
use App\Repository\OrganizerRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CandidateController extends Controller
{
    /**
     * @var OrganizerRepository
     */
    private $organizerRepository;
    /**
     * @var Candidate
     */
    private $candidate;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var User
     */
    private $user;

    /**
     * CandidateController constructor.
     */
    public function __construct(OrganizerRepository $organizerRepository, Candidate $candidate, Post $post, User $user)
    {
        $this->middleware(function ($request, $next) {
            if(Gate::allows('isOrganizer')){
                return $next($request);
            }
            abort(401);
        });
        $this->organizerRepository = $organizerRepository;
        $this->candidate = $candidate;
        $this->post = $post;
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org = Auth::user()->id;
        $posts = $this->post->where('organizer_id',$org)->get();
        $candidates = $this->organizerRepository->getCandidateByOrgId($org);
        return view('organizer.candidate.index', compact('candidates','posts'));
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
    public function store(CandidateRequest $request)
    {
        try {
            $request['organizer_id'] = Auth::user()->id;
            $candidate = $this->candidate->create($request->all());
            if ($candidate) {

                session()->flash('success', 'Candidate Successfully Created!');
                return back();

            } else {
                session()->flash('success', 'Candidate could not be Create!');
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
            $edits = $this->candidate->find($id);
            if ($edits->count() > 0) {
                $org = Auth::user()->id;

                $posts = $this->post->where('organizer_id',$org)->get();
                $candidates = $this->organizerRepository->getCandidateByOrgId($org);

                return view('organizer.candidate.index', compact('candidates','posts', 'edits'));
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
    public function update(Request $request, $id)
    {
        $id = (int)$id;
        try {
            $candidate = $this->candidate->find($id);
            $request['organizer_id'] = Auth::user()->id;
            if ($candidate) {
                $update = $candidate->fill($request->all())->save();
                if ($update) {
                    session()->flash('success', 'Candidate Successfully updated!');
                    return redirect(route('candidates.index'));
                } else {
                    session()->flash('error', 'Candidate could not be update!');
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
            $candidate = $this->candidate->find($id);
            if ($candidate) {
                $candidate->delete();
                session()->flash('success', 'Candidate successfully deleted!');
                return back();
            } else {
                session()->flash('error', 'Candidate could not be delete!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }


    public function voters()
    {
        $org = Auth::user()->id;
        $voters = $this->organizerRepository->voterByOrg($org);
        return view('organizer.voter.index', compact('voters'));
    }

    public function voterStatus($id)
    {
        try {
            $id = (int)$id;
            $voter = $this->user->find($id);
            if ($voter->can_vote == 'no') {
                $voter->can_vote = 'yes';
                $voter->save();
                session()->flash('success', 'Voter has been Activated!');
                return back();
            } else {
                $voter->can_vote = 'no';
                $voter->save();
                session()->flash('success', 'Voter has been Deactivated!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION : Something Went Wrong!' );
        }
    }
}
