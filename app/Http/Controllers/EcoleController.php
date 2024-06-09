<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Ecole;
use App\Models\Groupe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EcoleRequest;

class EcoleController extends Controller
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
    public function store(EcoleRequest $request)
    {
        //
        try {
            DB::beginTransaction();
            $ecole = Ecole::create([
                'nom'=>$request->nomE,
                'circonscription_id'=>$request->circonscription,
            ]);
            $groupe = Groupe::create([
                'nom'=>$request->groupe,
                'ecole_id'=>$ecole->id,
                'user_id'=>session('user')['id'],
            ]);
                DB::commit();
            return to_route('login')->with(['success' => 'Inscription complète. Connectez-vous pour prendre en compte les modifications']);
        } catch (\Throwable $th) {
            DB::rollBack();
            die("Une erreur s'est produite " . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ecole $ecole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ecole $ecole)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ecole $ecole)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ecole $ecole)
    {
        //
    }
    public function getEcoles($circonscriptionId){
          $ecoles = Ecole::where('circonscription_id', $circonscriptionId)->get();
        return response()->json(['ecoles' => $ecoles]);
    }
}