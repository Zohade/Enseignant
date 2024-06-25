<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use DateTimeZone;

class AcceuilControlleur extends Controller
{
    //
    public function index(){
        $publications = Publication::where(['postable_type'=>"App\Models\Post", "statutPub"=>"valide"])->orderByDesc("created_at")->get();
                    $fils = [];
                    foreach ($publications as $key => $postable) {
                        $timeElapsed = $this->getTimeElapsed($postable->created_at);
                        $recup = Post::where(['id' => $postable->postable_id])->first();
                        $author = User::select('name', 'id', 'photo')->where('id', $postable->user_id)->first();
                        $recup->auteur = $author;
                        $recup->time = $timeElapsed;
                        $fils[] = $recup;
                    }
        return view('afterAuth.index', compact('fils'));
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
