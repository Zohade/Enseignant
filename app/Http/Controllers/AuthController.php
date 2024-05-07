<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Departement;
use App\Models\Ville;
use App\Models\Arrondissement;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\EnvoyerMail;


class AuthController extends Controller
{
    //
    public function login(){
        return view("auth.index");
    }
    public function loginPost(AuthRequest $request){
        echo 'hello';
    }

    public function register()
    {
        $departements = Departement::all();
        $villes=Ville::all();
        $arrondissements=Arrondissement::all();
        return view("auth.register", ["departements"=>$departements,"villes"=>$villes,
        "arrondissements"=>$arrondissements]);
    }
    public function registerPost(RegisterRequest $request){
        //hasher le mot de passe
        $password=Hash::make($request->password);
        try {
            //enregistrement de l'utilisateur
            User::create([
                "name"=> $request->nom." ".$request->prenom,
                "email"=>$request->mail,
                "phone_number"=> $request->phone_number,
                "aronodissement_id"=>$request->arrondissement,
                "grade"=> $request->grade,
                "password"=>$password,
            ]);
            //envoie de lien de confirmation par mail
            $data = [
                    'title' => 'Confirmation de compte Minsihoue',
                    'body' => "Bravo vous êtes à deux doigts de finir votre inscription.
                                Cliquez sur le bouton en bas pour confirmer votre inscription
                                ",
                    'buttonText' => 'Confirmer l\'inscription',
                    'confirmationLink' => route('confirmerInscript'),
                ];
                 \Illuminate\Support\Facades\Mail::to($request->mail)->send(new EnvoyerMail($data));
                 return redirect()->route('login')->with('success','mail envoyé');
        } catch (\Throwable $th) {
            die('une erreur est survenue'.$th->getMessage());
        }
    }
    public function confirmerinscript()
    {

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