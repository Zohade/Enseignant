<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Models\Arrondissement;
use App\Models\Ville;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Circonscription;
use App\Models\Groupe;
use App\Models\Ecole;
use App\Models\Classe;
use App\Models\Publication;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DateTimeZone;
use Throwable;

class ProfilControleur extends Controller
{
    //
    public function index($userId){
            if($userId==session('user')['id']){
                $data = [];
                $user = session('user');
                /*recupération de l'adresse de l'utilisateur*/
                $data['arrondissement'] = Arrondissement::where(['id' => $user['arrondissement']])->first();
                $data['ville'] = Ville::where(['id' => $data['arrondissement']->ville_id])->first();
                $data['departement'] = Departement::where(['id' => $data['ville']->departement_id])->first();
            //recupération des informations du grade
                if ($user["grade"] == 'cpins') {
                    $data['circonscription'] = Circonscription::where('user_id', $user["id"])->first();
                } elseif ($user["grade"] == 'directeur') {
                    $data['groupe'] = Groupe::where(['user_id' => $user['id']])->first();
                    $data['ecole'] = Ecole::where(['id' => $data['groupe']->ecole_id])->first();
                    $data['circonscription'] = Circonscription::where(['id' => $data['ecole']->circonscription_id])->first();
                } elseif ($user["grade"] == 'instituteur') {
                    $data['classe'] = Classe::where(['user_id' => $user['id']])->first();
                    $data['groupe'] = Groupe::where(['id' => $data['classe']->groupe_id])->first();
                    $data['ecole'] = Ecole::where(['id' => $data['groupe']->ecole_id])->first();
                    $data['circonscription'] = Circonscription::where(['id' => $data['ecole']->circonscription_id])->first();
                }
                //posts de l'user
                $publications = Publication::where(['user_id' => $user['id']])->orderBy('created_at','desc')->get();
                $posts = [];
                $documents = [];
                $formations = [];
                foreach ($publications as $publication) {
                    $timeElapsed = $this->getTimeElapsed($publication->created_at);
                    switch ($publication->postable_type) {
                        case 'App\Models\Post':
                            $publication->postable->time_elapsed = $timeElapsed;
                            $posts[] = $publication->postable;
                            break;
                        case 'App\Models\Document':
                            $publication->postable->time_elapsed = $timeElapsed;
                            $documents[] = $publication->postable;
                            break;
                        case 'App\Models\Formation':
                            $publication->postable->time_elapsed = $timeElapsed;
                            $formations[] = $publication->postable;
                        break;
                    }
                }
            }
                $data['posts']= $posts;
                $data['documents'] = $documents;
                $data['formations'] = $formations;
                return view('profil.profileUser',compact('data'));
    }
    public function store(PhotoRequest $request){
        try {
        $image = $request->croppedImage;
        if ($image->getSize() <= 5242880) {
            $photoName = 'profil' . session('user')['id'] . '.png';
                if (Storage::exists('avatars/' . $photoName)) {
                    Storage::delete('avatars/' . $photoName);
                }
                $name = $image->storeAs('avatars', $photoName, 'public');
                $user = User::where('id', session('user')['id'])->update(['photo' => $name]);
                return response()->json(['success'=>'ok']);
        }else{
                return response()->json(['error' => 'Image trop grande']);
        }
         } catch (Throwable $th) {
            die('erreur ' . $th->getMessage());
        }
    }
   private function getTimeElapsed($createdAt)
        {
            $created = Carbon::parse($createdAt, new DateTimeZone("Africa/Porto-Novo"));
            $now = Carbon::now(new DateTimeZone("Africa/Porto-Novo"));

            // Utilisation des méthodes diffIn*Correct pour éviter des valeurs négatives
            $diffInSeconds = $now->diffInSeconds($created, false);
            $diffInMinutes = $now->diffInMinutes($created, false);
            $diffInHours = $now->diffInHours($created, false);
            $diffInDays = $now->diffInDays($created, false);

            if (abs($diffInSeconds) < 60) {
                return  round(abs($diffInSeconds)) . "s";
            } elseif (abs($diffInMinutes) < 60) {
                return  round(abs($diffInMinutes)) . "m";
            } elseif (abs($diffInHours) < 24) {
                return  round(abs($diffInHours)) . "h";
            } elseif (abs($diffInDays) <= 6) {
                return  round(abs($diffInDays)) . "j";
            } else {
                return $created->format('Y-m-d H:i:s');
            }
        }
}