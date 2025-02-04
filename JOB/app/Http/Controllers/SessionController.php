<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        // validation
        $attribute = request()->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        // attemp to login the user
        if (! Auth::attempt($attribute)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those creaditials do not match.'
            ]);
        }

        // regenarate the session token
        request()->session()->regenerate();

        // redirect
        return redirect('jobs');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
