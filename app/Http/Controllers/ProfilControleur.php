<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilControleur extends Controller
{
    //
    public function index($userId){
        if($userId==session('user')['id']){
            return view('profil.profileUser');
        }else{
            return view('profil.profilOther');
        }
    }
}