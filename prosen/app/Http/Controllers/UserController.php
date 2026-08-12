<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    //
    function userHome($name){
        $name="pro";
        $users=['pro','sen','jit','pritha'];
        return view('home',["name"=>$name,"users"=>$users]);
    }

    function userAbout($name){
        return view('about',['user'=>$name]);
    }

    function adminLogin(){

        // if(View::exists('admin.login')){
        //     return view('admin.login');
        // }
        // else{
        //     echo "No view found";
        // }


        if(View::exists('admin.signup')){
            return view('admin.signup');
        }
        else{
            echo "No view found";
        }
    }
}
