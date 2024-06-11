<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteRequest;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use App\Models\Circonscription;
use App\Models\Ville;
use App\Models\Groupe;
use App\Models\Classe;

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
    public function complete(CompleteRequest $request){
        $user = session('user');
        if($user['grade']=="cpins"){
            $cir = Circonscription::where(['user_id' => $user['id'],
            'id'=>$request->circonscription,
            ])->get();
            if($cir){
                return back()->withErrors("Un inspecteur est déjà chef de cette circonscription. S'il s'agit d'une mauvaise inscription, veillez notifier dans l'espace aide ");
            }else{
                try {
                $back = \Illuminate\Support\Facades\DB::table('circonscriptions')
                ->where('id',$request->circonscription)->update(['user_id'=> $user['id']]);
                return to_route('login')->with('success', 'inscription complète');
                    //code...
                } catch (\Throwable $th) {
                    die("Erreur " . $th->getMessage());
                }
            }
        } elseif($user['grade']=="directeur"){
            $groupe = Groupe::where(['user_id' => $user['id'],
            'id'=>$request->groupe,
            ])->get();
            if($groupe){
                return back()->withErrors("Un directeur est déjà chef de ce groupe. S'il s'agit d'une mauvaise inscription, veillez notifier dans l'espace aide ");
            }else{
                 try {
                $back = \Illuminate\Support\Facades\DB::table('groupes')
                ->where('id',$request->groupe)->update(['user_id'=> $user['id']]);
                return to_route('login')->with('success', 'inscription complète');
                } catch (\Throwable $th) {
                    die("Erreur " . $th->getMessage());
                }
            }
        } elseif($user['grade']=="instituteur"){
            $classe = Classe::where(['user_id' => $user['id'],
            'id'=>$request->classe,
            'groupe_id'=>$request->groupe
            ])->get();
            if($classe){
                return back()->withErrors("Un directeur est déjà chef de ce groupe. S'il s'agit d'une mauvaise inscription, veillez notifier dans l'espace aide ");
            }else{
                 try {
                $back = \Illuminate\Support\Facades\DB::table('classes')
                ->where('id',$request->classe)->update(['user_id'=> $user['id']]);
                return to_route('login')->with('success', 'inscription complète');
                } catch (\Throwable $th) {
                    die("Erreur " . $th->getMessage());
                }
            }
        }
    }
}