<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Http\Controllers\Controller;
use App\Http\Requests\GroupeRequest;
use Illuminate\Http\Request;

class GroupeController extends Controller
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
    public function store(GroupeRequest $request)
    {
        try {
            $groupe = Groupe::create([
                'nom'=>$request->groupe,
                'ecole_id'=>$request->ecole,
                'user_id'=>session('user')['id'],
            ]);
            return to_route('login')->with(['success' => 'Inscription complète. Connectez-vous pour prendre en compte les modifications']);
        } catch (\Throwable $th) {
            die("Une erreur s'est produite " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Groupe $groupe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Groupe $groupe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Groupe $groupe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Groupe $groupe)
    {
        //
    }
    public function getGroupes($ecoleId){
         $groupes = Groupe::where('ecole_id', $ecoleId)->get();
        return response()->json(['groupes' => $groupes]);
    }
}