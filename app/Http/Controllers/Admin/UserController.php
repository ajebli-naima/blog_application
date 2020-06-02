<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); 
        return view('admin.users.index')->with('users', $users);
    }


   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user)
    {
        if (Gate::denies('edit-users')) {
            return redirect( '/admin/users ');
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->save()) {

            $request->session()->flash('success', 'User ' . $user->name . ' has been updated  ' );
        } else {
            $request->session()->flash('error', 'There was an error updating the user');
        }

        return redirect( '/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        if (Gate::denies('edit-users')) {
            return redirect( '/admin/users ');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect( '/admin/users');
    }
}
