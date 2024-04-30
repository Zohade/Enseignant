<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(){
        return view("auth.index");
    }

    public function register()
    {
        return view("auth.register");
    }
    public function registerPost(){
        return ("hello");
    }
    public function forget()
    {
        return view("auth.forgot");
    }

    public function forgetPost()
    {
        return view("auth.forgotPost");
    }
    public function forgetLast()
    {
        return view("auth.forgotLast");
    }
    public function newpasschange(){
        return to_route("login")->with("success","Votre mot de passe a été bien mis à jour");
    }
}