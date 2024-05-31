<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcceuilControlleur extends Controller
{
    //
    public function index(){
        return view('afterAuth.index');
    }
}
