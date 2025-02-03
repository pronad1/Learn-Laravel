<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    // protected $guarded=[];
    public function store()
    {
        // validation
        $attributes= request()->validate([
            'name'=>['required'],
            'email'=>['required','email'],
            'password'=>['required', Password::min(6), 'confirmed']
        ]);

        //dd($validatedAttributes);

        //create the user
        $user=User::create($attributes);

        // log in
        Auth::login($user);

        // redirect somewhere
        return redirect('/jobs');
    }
}
