<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Classe;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use App\Models\GarderClasse;
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
        $date = '';
                    if (date('m') < '09') {
                        $date = (date('Y') - 1) . '-' . date('Y');
                    } else {
                        $date = date('Y') . '-' . (date('Y') + 1);
                    }
         try {
            DB::beginTransaction();
            $classe = Classe::create([
                'nom'=>$request->classe,
                'groupe_id'=>$request->groupe,
            ]);
            $garder = GarderClasse::create([
                'user_id'=>session('user')['id'],
                'classe_id'=>$classe->id,
                'annee_scolaire'=>$date,
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