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
use App\Models\DirigerCirc;
use App\Models\DirigerGroupe;
use App\Models\GarderClasse;
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
                  $date = '';
                    if (date('m') < '09') {
                        $date = (date('Y') - 1) . '-' . date('Y');
                    } else {
                        $date = date('Y') . '-' . (date('Y') + 1);
                    }
                $data = [];
                $user = session('user');
                /*recupération de l'adresse de l'utilisateur*/
                $data['arrondissement'] = Arrondissement::where(['id' => $user['arrondissement']])->first();
                $data['ville'] = Ville::where(['id' => $data['arrondissement']->ville_id])->first();
                $data['departement'] = Departement::where(['id' => $data['ville']->departement_id])->first();
            //recupération des informations du grade
                if ($user["grade"] == 'cpins') {
                    $circ= DirigerCirc::where(['user_id'=>$user["id"],"annee_scolaire"=>$date])->first();
                    if($circ!=null)
                        $data['circonscription'] = Circonscription::where('id', $circ->circonscription_id)->first();
                    else
                    $data['circonscription'] = null;
                } elseif ($user["grade"] == 'directeur') {
                    //le groupe dirigé par le directeur
                    $groupe= DirigerGroupe::where(['user_id'=>$user["id"],"annee_scolaire"=>$date])->first();
                    if($groupe!=null){
                    $data['groupe'] = Groupe::where('id',$groupe->groupe_id)->first();
                    $data['ecole'] = Ecole::where(['id' => $data['groupe']->ecole_id])->first();
                    $data['circonscription'] = Circonscription::where(['id' => $data['ecole']->circonscription_id])->first();
                    }else{
                        $data['groupe'] = null;
                        $data['ecole'] = null;
                        $data['circonscription'] = null;
                    }
                } elseif ($user["grade"] == 'instituteur') {
                    $classe=GarderClasse::where(['user_id'=>$user["id"],"annee_scolaire"=>$date])->first();
                if ($classe != null) {
                    $data['classe'] = Classe::where(['id' => $classe->classe_id])->first();
                    $data['groupe'] = Groupe::where(['id' => $data['classe']->groupe_id])->first();
                    $data['ecole'] = Ecole::where(['id' => $data['groupe']->ecole_id])->first();
                    $data['circonscription'] = Circonscription::where(['id' => $data['ecole']->circonscription_id])->first();
                }else{
                     $data['groupe'] = null;
                     $data['ecole'] = null;
                     $data['circonscription'] = null;
                     $data['classe'] = null;
                }
                }
                //posts de l'user
                $publications = Publication::where(['user_id' => $user['id']])->orderBy('created_at','desc')->get();
                $valeurs = $this->ParsePubOnChildrenModele($publications);
                //pour les pubs en attente
                if($user['grade']=='directeur' && session('info')!=null){
                    $req1 = Classe::where(['groupe_id' => session('info')['id']])->get();
                $pubForValidates = [];
                    foreach ($req1 as $key => $classe) {
                    $auteur = GarderClasse::where(['classe_id'=>$classe->id, 'annee_scolaire'=>$date])->first();
                    $pubForValidates [] = Publication::where([
                        'user_id' => $auteur->user_id,
                        'statutPub' => "attente"
                    ])->orderBy('created_at','asc')->get();
                    }
                $taille=count($pubForValidates);
                $pubsEnAttente = [];
                for ($i = 0; $i < $taille;$i++){
                    $pubsEnAttente []= $this->ParsePubOnChildrenModele($pubForValidates[$i]);
                }
                }

                if(session('user')['grade']=="directeur" && session('info')!=null) {
                    $data['EnAttente'] = $pubsEnAttente;
                } else {
                    $data['EnAttente'] = null;
                }
                $data['posts']= $valeurs["posts"];
                $data['documents'] = $valeurs['documents'];
                $data['formations'] = $valeurs['formations'];
                return view('profil.profileUser',compact('data'));
            }else{
            return to_route('dash');
            }
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

        private function ParsePubOnChildrenModele($publications){
            $posts = [];
            $documents = [];
            $formations = [];
            foreach ($publications as $publication) {
                    $timeElapsed = $this->getTimeElapsed($publication->created_at);
                    $publication->postable->time_elapsed = $timeElapsed;
                    $publication->postable->statutPub = $publication->statutPub;
                    $publication->postable->type = $publication->postable_type;
                    $publication->postable->auteur = User::select(['name','id'])->where(['id' => $publication->user_id])->first();
                    switch ($publication->postable_type) {
                        case 'App\Models\Post':
                            $posts[] = $publication->postable;
                            break;
                        case 'App\Models\Document':
                            $documents[] = $publication->postable;
                            break;
                        case 'App\Models\Formation':
                            $formations[] = $publication->postable;
                        break;
                    }
                }
        $valeurs['posts'] = $posts;
        $valeurs['documents'] = $documents;
        $valeurs['formations'] = $formations;
        return $valeurs;
        }
}