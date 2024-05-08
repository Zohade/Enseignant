<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ForgetRequest;
use App\Http\Requests\PasswordChangeRequest;
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
    public function loginPost(AuthRequest $request)
    {
        try {
            $user = User::where('email', $request->input('Son_mail'))
                ->orWhere('phone_number', $request->input('Son_mail'))
                ->first();
            if ($user && Hash::check($request->input('Son_pass'), $user->password)) {
                echo 'hello';

            }else{
                return to_route('login')->withErrors('Mail ou mot de passe incorrect');
            }
        } catch (\Throwable $th) {
            die('Problème : ' . $th->getMessage());
        }
    }
    public function register()
    {
        $departements = Departement::all();
        return view("auth.register", ["departements"=>$departements]);
    }
    public function registerPost(RegisterRequest $request){
        $arrondissement=intval($request->arrondissement);
        //hasher le mot de passe
        $password=Hash::make($request->password,['rounds' => 12,]);
        try {
            //enregistrement de l'utilisateur
            User::create([
                "name"=> $request->nom." ".$request->prenom,
                "email"=>$request->mail,
                "phone_number"=> $request->phone_number,
                "arrondissement"=>$arrondissement,
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

    public function forgetPost(ForgetRequest $request)
    {
        $user=User::where("email",$request->input("email"))->first();
        if($user){
            try {
                 $userId=User::where("email",$request->email)->first()->id;
                //envoie de lien de confirmation par mail
                $data = [
                        'title' => 'Réinitialiation de compte Minsihoue',
                        'body' => "Cliquez sur le bouton en bas pour réinitialiser votre inscription
                                    ",
                        'buttonText' => 'Confirmer l\'inscription',
                        'confirmationLink' => route("forgetLast",['userId'=>$userId]),
                    ];
                    \Illuminate\Support\Facades\Mail::to($request->email)->send(new EnvoyerMail($data));
                    return redirect()->route('forget')->with('success','Nous vous avons envpyé un mail pour réinitiallisé votre compte');
            } catch (\Throwable $th) {
                die('Problème ' . $th->getMessage());
            }
        } else {
            return to_route('forget')->withErrors("L'adresse mail ne correspond à aucun compte.");
        }
    }
    public function forgetLast($userId){
        return view('auth.forgotLast',['userId'=>$userId]);
    }
    public function newpasschange(PasswordChangeRequest $request){
        $password=Hash::make($request->input('mot_de_passe'));
        $id=$request->input('id');
        $back = \Illuminate\Support\Facades\DB::table('users')
            ->where('id',$id)->update(['password'=> $password]);
        if ($back) {
            return to_route("login")->with("success", "Votre mot de passe a été bien mis à jour");
        } else {
            die('une erreur s\'est produite, veillez reprendre plus tard');
        }
    }
}