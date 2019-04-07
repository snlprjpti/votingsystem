<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizerRequest;
use App\Repository\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var User
     */
    private $user;

    /**
     * AdminController constructor.
     */
    public function __construct(UserRepository $userRepository, User $user)
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
        $this->middleware(function ($request, $next) {
            if(Gate::allows('isAdmin')){
                return $next($request);
            }
            abort(401);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAdmin();
        return view('admin.user.index', compact('users'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizerRequest $request)
    {
        try {
            $password = str_random(6);
            $request['password'] = bcrypt($password);

            $request['type'] = 'admin';
            $request['email_verified_at'] = Carbon::now();

            $user = $this->user->create($request->all());
            if ($user) {
                if ($user)
                    Mail::send('backend.email.addUser', ['userName' => $request->name, 'password' => $password], function ($m) use ($request) {
                        $m->to($request->email)->subject('Admin Registration Information');
                    });
                session()->flash('success', 'User Successfully Created!');
                return back();

            } else {
                session()->flash('success', 'User could not be Create!');
                return back();
            }


        } catch (\Exception $e) {
            $e = $e->getMessage();
            session()->flash('error', 'Exception : Something went wrong');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = (int)$id;
            $edits = $this->userRepository->findById($id);
            if ($edits->count() > 0) {
                $users = $this->userRepository->getAdmin();

                return view('admin.user.index', compact('users', 'edits'));
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizerRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $user = $this->userRepository->findById($id);
            $request['type'] = 'admin';
            $request['email_verified_at'] = Carbon::now();

            if ($user) {
                $update = $user->fill($request->all())->save();
                if ($update) {
                    session()->flash('success', 'User Successfully updated!');
                    return redirect(route('user.index'));
                } else {
                    session()->flash('error', 'User could not be update!');
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
