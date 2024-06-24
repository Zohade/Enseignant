<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Publication;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PublicationRequest;

class DocumentController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $doc = Document::where(['id' => $document->id])->update([
            'titre' => $request->titre,
            'desc' => $request->desc,
            'prix' => $request->price,
            'payant' => ($request->price > 0) ? 1 : 0,
        ]);
        if($doc){
            return back()->with(["alert" => "Votre document a été mis à jour"]);
        }else{
            return back()->withErrors(['une erreur est survenue']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        $pub = Publication::where([
            'postable_id' => $document->id,
            'postable_type' => "App\Models\Document",
        ])->delete();
        if($pub){
            return back()->with(['alert' => 'Votre document a été supprimé']);
        }else{
            return back()->with(['alert'=>'Une erreur s\'est produite']);
        }
    }

    public function getDocument($id){
        $document = Document::where(['id' => $id])->first();
        $pub = Publication::where(['postable_type' => "App\Models\Document", 'postable_id' => $id])->first();
        $auteur = User::select('name', 'id','photo')->where(['id' => $pub->user_id])->first();
        return response()->json(['document'=> $document,'auteur'=>$auteur]);
    }

    public function valideDocument($id){
        $pub = Publication::where(["postable_type" => "App\Models\Document", "postable_id" => $id])->update(["statutPub" => "valide"]);
        if($pub){
            return response()->json("success");
        }else{
            return response()->json('error');
        }
    }
    public function rejeteDocument($id){
         $pub = Publication::where(["postable_type" => "App\Models\Document", "postable_id" => $id])->update(["statutPub" => "rejet"]);
        if($pub){
            return response()->json("success");
        }else{
            return response()->json('error');
        }
    }
}