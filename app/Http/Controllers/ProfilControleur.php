<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfilControleur extends Controller
{
    //
    public function index($userId){
        if($userId==session('user')['id']){
            return view('profil.profileUser');
        }else{
            return view('profil.profilOther');
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
         } catch (\Throwable $th) {
            die('erreur ' . $th->getMessage());
        }
    }
}