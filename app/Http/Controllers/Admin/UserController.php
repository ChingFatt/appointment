<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateUser;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('merchant')) {
            $users = User::where('merchant_id', Auth::user()->merchant_id)->latest()->get();
        } else {
            $users = User::latest()->get();
        }
        return view('admin.users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('merchant')) {
            $roles = Role::pluck('name', 'id')->except(1);
            $merchants = Merchant::where('id', Auth::user()->merchant_id)->get()->pluck('name', 'id');
        } else {
            $roles = Role::pluck('name', 'id');
            $merchants = Merchant::pluck('name', 'id');
        }

        return view('admin.users.create')->with(compact('roles', 'merchants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $request->merge([
            'password' => bcrypt($request->password),
        ]);
        $user = User::create($request->all());
        $user->assignRole($role);

        Mail::to($user->email)->send(new CreateUser());
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->hasRole('merchant')) {
            $roles = Role::pluck('name', 'id')->except(1);
            $merchants = Merchant::where('id', Auth::user()->merchant_id)->get()->pluck('name', 'id');
        } else {
            $roles = Role::pluck('name', 'id');
            $merchants = Merchant::pluck('name', 'id');
        }

        $selected = [];
        if ($user->roles) {
            foreach ($user->roles as $key => $role) {
                $selected[] = $role->id;
            }
        }

        return view('admin.users.edit')->with(compact('user', 'roles', 'merchants', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->except('_method', '_token', 'password'));
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function profile()
    {
        dd('profile');
    }

    public function impersonate($user_id)
    {
        $user = User::find($user_id);
        Auth::user()->impersonate($user);
        return redirect()->route('admin.dashboard.index');
    }

    public function impersonate_leave()
    {
        Auth::user()->leaveImpersonation();
        return redirect()->route('admin.dashboard.index');
    }
}
