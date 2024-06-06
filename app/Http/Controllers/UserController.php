<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use App\Models\Circonscription;

class UserController extends Controller
{
    //
    public function index(){
        $arron=session('user')['arrondissement'];
        $ville = Arrondissement::where('id', $arron)->first();
        $circons = Circonscription::where('ville_id', $ville['ville_id'])->get();
        $data['circonsption']=$circons;
        if(session('user')['grade']!='cpins'){
            foreach ($circons as $key => $value) {

            }
        }
        return view('user.complete');
    }
}
