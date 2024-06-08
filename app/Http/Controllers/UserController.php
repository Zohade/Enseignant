<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use App\Models\Ville;

class UserController extends Controller
{
    //
    public function index(){
        //récupération de l'arrondissement en partant des variables de sessions
        $arron=session('user')['arrondissement'];
        //récupération de la ville d'appratenance de l'arrondissement
        $subQuery1 = Arrondissement::select('ville_id') ->where('id', $arron)->limit(1);
        //récupération du département d'appartenance de la ville
        $subQuery2 = Ville::select('departement_id')->where('id', $subQuery1);
        //récupération des villes appartenant à un département
        $villes = Ville::where("departement_id", $subQuery2)->get();
        return view('user.complete',['villes'=>$villes]);
    }
}