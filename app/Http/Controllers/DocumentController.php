<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Publication;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTimeZone;
use App\Http\Requests\PublicationRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use App\Models\Telechargement;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::where(['postable_type'=>"App\Models\Document", "statutPub"=>"valide"])->get();
        $documents = [];
        foreach ($publications as $key => $pub) {
            $doc = Document::where(['id' => $pub->postable_id])->first();
            $doc->author = User::select(['name', 'id', 'photo'])->where(['id' => $pub->user_id])->first();
            $doc->createAt = $this->getTimeElapsed($pub->created_at);
            $documents[] = $doc;
        }
        $n=count($documents);
        return view('document.index', compact('documents',"n"));
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
       try {
            $document = Document::findOrFail($document->id);
            return view('document.preview', compact('document'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors('Document not found.');
        }
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
    public function download($id){
        $document = Document::where(['id'=>$id])->first();
        if($document->prix==0){
            try {
                $telecharge = Telechargement::create(["user_id"=>session('user')['id'],"document_id"=>$document->id]);
                if ($telecharge) {
                    $path = public_path("storage/{$document->fichier}");
                    return response()->download($path);
                }
            } catch (\Throwable $th) {
                die('Une erreur s\'est produite');
            }
        }else{
            return view('document.paiement',compact('document'));
        }
    }
    public function afterPaiement(Request $request){
        if($request['transaction-status']=="approved"){
             try {
                $telecharge = Telechargement::create(["user_id"=>session('user')['id'],"document_id"=>$request->docID]);
                $document = Document::where(['id'=>$request->docID])->first();
                if ($telecharge) {
                    $path = public_path("storage/{$document->fichier}");
                    return response()->download($path);
                }
            } catch (\Throwable $th) {
                die('Une erreur s\'est produite');
            }
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