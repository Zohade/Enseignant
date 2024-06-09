<?php

namespace App\Http\Controllers;

use App\Models\Circonscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CirconscriptionRequest;
use App\Models\User;

class CirconscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CirconscriptionRequest $request)
    {
        try {
            if($request->role=='chef'){
                $circonscription = Circonscription::create([
                    'ville_id'=>$request->ville,
                    'user_id'=>session('user')['id'],
                    'nom'=>$request->nomC,
                ]);
                    return to_route('login')->with(['success' => 'Inscription complète. Connectez-vous pour prendre en compte les modifications']);
            }elseif($request->role=='collaborateur'){
                $user = User::where([
                    'phone_number' => $request->numChef,
                    'name' => $request->nomChef
                ]);
                if($user){
                     $circonscription = Circonscription::create([
                    'ville_id'=>$request->ville,
                    'user_id'=>session('user')['id'],
                    'nom'=>$request->nomC,
                ]);
                    return to_route('login')->with(['success' => 'Inscription complète. Connectez-vous pour prendre en compte les modifications']);
                }else{
                    return back()->withErrors('Le chef de la circonscription n\'est pas inscrit sur le site');
                }
            }
        } catch (\Throwable $th) {
            die('Une erreur s\'est produite ' . $th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Circonscription $circonscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Circonscription $circonscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Circonscription $circonscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Circonscription $circonscription)
    {
        //
    }
    public function getCircons($villeId){
         $circons = Circonscription::where('ville_id', $villeId)->get();
        return response()->json(['circons' => $circons]);
    }
}