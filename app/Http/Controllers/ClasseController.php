<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use Illuminate\Http\Request;

class ClasseController extends Controller
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
    public function store(ClasseRequest $request)
    {
         try {
            $classe = Classe::create([
                'nom'=>$request->classe,
                'groupe_id'=>$request->groupe,
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
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }
    public function getClasses($groupeId){
         $classes = Classe::where('groupe_id', $groupeId)->get();
        return response()->json(['classes' => $classes]);
    }
}