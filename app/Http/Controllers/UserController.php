<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('User.index')->with('users', User::all());
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('Success','User Made Admin Successfully');
        return $this->index();
    }

    public function edit()
    {

        return view('User.edit')->with('user',auth()->user());

    }

    public function update(UserProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
           'name'=> $request->name,
           'about'=> $request->about,
        ]);

        session()->flash('Success','User Updated Successfully');
        return $this->index();
    }
}
