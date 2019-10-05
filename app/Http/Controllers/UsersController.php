<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Users\UpdateUser;

class UsersController extends Controller
{
    public function index()
    {
      return view('users.index')->with('users', User::all());
    }

    public function beAdmin(User $user)
    {
      $user->role = 'admin';
      $user->save();
      return redirect()->back();
    }

    public function profile()
    {
      return view('users.profile')->with('users',Auth::user());
    }
    public function updateprofile(UpdateUser $request)
    {
      $user = Auth::user(); //auth user don't need to pass the id
      $user->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'about'=>$request->about,
      ]);

      session()->flash('success','User Updated');
      return redirect('home');
    }
}
