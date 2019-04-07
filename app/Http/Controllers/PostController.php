<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Post;
use App\Repository\OrganizerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * @var OrganizerRepository
     */
    private $organizerRepository;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var Candidate
     */
    private $candidate;

    /**
     * PostController constructor.
     */
    public function __construct(OrganizerRepository $organizerRepository, Post $post, Candidate $candidate)
    {
        $this->middleware(function ($request, $next) {
            if(Gate::allows('isOrganizer')){
                return $next($request);
            }
            abort(401);
        });
        $this->organizerRepository = $organizerRepository;
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
        $org = Auth::user()->id;
        $posts = $this->organizerRepository->findPostByOrgId($org);
        return view('organizer.post.index', compact('posts'));
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
    public function store(Request $request)
    {
        try {
            $request['organizer_id'] = Auth::user()->id;
            $post = $this->post->create($request->all());
            if ($post) {

                session()->flash('success', 'Post Successfully Created!');
                return back();

            } else {
                session()->flash('success', 'Post could not be Create!');
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
            $edits = $this->post->find($id);
            if ($edits->count() > 0) {
                $posts = $this->organizerRepository->findPostByOrgId(Auth::user()->id);

                return view('organizer.post.index', compact('posts', 'edits'));
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
            $post = $this->post->find($id);
            if ($post) {
                $request['organizer_id'] = Auth::user()->id;
                $update = $post->fill($request->all())->save();
                if ($update) {
                    session()->flash('success', 'Post Successfully updated!');
                    return redirect(route('posts.index'));
                } else {
                    session()->flash('error', 'Post could not be update!');
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
            $post = $this->post->find($id);
            if ($post) {

                $value = $this->candidate->where('post_id',$id)->get();
                if(count($value)>0)
                {
                    session()->flash('warning', 'Post Cannot be deleted');
                    return back();
                }
                $post->delete();
                session()->flash('success', 'Post successfully deleted!');
                return back();
            } else {
                session()->flash('error', 'Post could not be delete!');
                return back();
            }

        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();

        }
    }
}
