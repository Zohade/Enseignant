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
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    //
    public function login(){
        return view("auth.index");
    }
    public function loginPost(AuthRequest $request){
          $credentials = [
            'email' => $request->Son_mail,
            'password' => $request->Son_passe,
        ];
        //https://laravel.com/docs/11.x/authentication#authenticating-users
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->statut == 0) {
                dd('compte pas encore validé');
            }else{
                dd('bravo vous êtes connecté');
            }
        } else {
            return back()->withErrors("Mail ou mot de passe incorrect");
        }
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
                "arrondissement_id"=>$request->arrondissement,
                "grade"=> $request->grade,
                "password"=>$password,
            ]);
            //récupération de l'id de l'utilisateur qui vient de s'inscrire
            $userId=User::where("email",$request->mail)->first()->id;
            //envoie de lien de confirmation par mail
            $data = [
                    'title' => 'Confirmation de compte Minsihoue',
                    'body' => "Bravo vous êtes à deux doigts de finir votre inscription.
                                Cliquez sur le bouton en bas pour confirmer votre inscription
                                ",
                    'buttonText' => 'Confirmer l\'inscription',
                    'confirmationLink' => route("confirmerInscript",['userId'=>$userId]),
                ];
                 \Illuminate\Support\Facades\Mail::to($request->mail)->send(new EnvoyerMail($data));
                 return redirect()->route('login')->with('success','Nous vous avons envoyé un message par mail. Vérifiez votre adresse mail pour activer compte.');
        } catch (\Throwable $th) {
            die('une erreur est survenue '.$th->getMessage());
        }
    }
    public function confirmerinscript($id)
    {
         $user_update = \Illuminate\Support\Facades\DB::table('users')
                ->where(['id'=>$id,
                    "email_verified_at"=>now(),
                ])
                ->update(['statut' =>1]);
        return redirect()->route('login')->with('success','Votre compte a été finalisé avec succès');
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