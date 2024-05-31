<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Document;
use App\Models\Formation;
use App\Models\Post;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ClamAVScanner;
use Illuminate\Routing\Route;

class PublicationController extends Controller
{
    protected $clamAVScanner;

    public function __construct(ClamAVScanner $clamAVScanner)
    {
        $this->clamAVScanner = $clamAVScanner;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(PublicationRequest $request)
    {
       if ($request->has('DocumentSoumission')) {
          $retour=$this->storeDocument(new PublicationRequest($request->all()));
            session(['last_submitted' => 'document']);
        } elseif ($request->has('FormationSoumission')) {
            $retour=$this->storeFormation(new PublicationRequest($request->all()));
            session(['last_submitted' => 'formation']);
        } else {
            $retour=$this->storePost(new PublicationRequest($request->all()));
            session(['last_submitted' => 'post']);
        }
        if($retour==1){
            return to_route('dash')->with('success', 'Votre Publication a été bien soumis');
        }else{
            return redirect()->back()->withErrors('Une erreur est survenue');
        }
    }

     protected function storeDocument(PublicationRequest $request)
    {
        // Logique pour sauvegarder le document
    /**
     * Traitement du fichier de document
     * Vérifier que le document ne contienne pas des vulnérabilités
     *Vérifier la taille du document(Max 50Mo)
     * Nommer le document
     */
         try {

            $file = $request->document;
            $filePath = $file->getPathName();
            $scanResult = $this->clamAVScanner->scanFile($filePath);
            if ($scanResult !== true) {
                return response()->json(['error' => 'File is infected: ' . $scanResult], 400);
            }

            if($file->getSize()<=52428800){
                $lastPubId = Document::orderBy('id', 'desc')->first();
                if ($lastPubId == null) {
                    $fileId = 0;
                } else {
                    $fileId = $lastPubId['id'];
                }
                $Docname = "Minsihoue.doc" . ($fileId + 1) . '.' . $file->extension();
                if($request->type=='fiche'){
                    $name = $file->storeAs('document/fiche', $Docname, 'public');
                }elseif($request->type=="guide"){
                    $name = $file->storeAs('document/guide', $Docname, 'public');
                }
                DB::beginTransaction();
                $doc = Document::create([
                    'type_doc'=>$request->type,
                    'titre'=>$request->titre,
                    'fichier'=>$name,
                    'desc'=>$request->description,
                    'classe'=>$request->classe,
                    'payant'=>($request->paid=='checked')?1:0,
                    'prix'=>($request->paid=='checked')?$request->priceDoc:0,
                    'matiere'=>($request->type=='fiche')?$request->matiere:'null',
                    'SA'=>($request->type=='fiche')?$request->SA:'null',
                ]);
                $publication = new Publication([
                        'user_id' => session('user')['id'],
                        'statutPub' => (session('user')['grade']=='instituteur')?'attente':'valide',
                        'postable_id' => $doc->id,
                        'postable_type' => Document::class,
                ]);
                $publication->save();
                DB::commit();

                return 1;
            }else{
                return 0;
            }

    } catch (\Throwable $th) {
            die('erreur ' . $th->getMessage());
    }
    }

    protected function storeFormation(PublicationRequest $request)
    {
        // Logique pour sauvegarder la formation
        try {
            if($request->paid=='checked'){
                $payant=True;
                $prix=$request->priceFor;
            }else{
                $payant=false;
                $prix=0;
            }
            if(session('user')['grade']=='instituteur'){
                $statut = "attente";
            }else{
                $statut = 'valide';
            }
            DB::beginTransaction();
            $formation = Formation::create([
                'titre'=>$request->titreForm,
                'formateur'=>$request->auteur,
                'desc'=>$request->desc,
                'dateDebut'=>$request->DateDebut,
                'dateFin'=>$request->DateFin,
                'payant'=>$payant,
                'prix'=>$prix,
            ]);
            $publication = new Publication([
                'user_id' => session('user')['id'],
                'statutPub' => $statut,
                'postable_id' => $formation->id,
                'postable_type' => Formation::class,
            ]);
            $publication->save();
            DB::commit();
            return 1;
        } catch (\Throwable $th) {
            die(' Problème : ' . $th->getMessage());
        }

    }

    protected function storePost(PublicationRequest $request)
    {
        // Logique pour sauvegarder le post
        $photo = $request->photo_pub;
        /**TRAITEMENT SUR LA PHOTO*
         * Vérifier que la taille ne dépasse pas 5Mo
         * Nommer la photo
         * enregistrer la photo dans le repectoire post de storage
         */
        try {
            if ($photo != null) {
                if ($photo->getSize() <= 5242880) {
                    $lastPubId = Post::orderBy('id', 'desc')->first();
                    if ($lastPubId == null) {
                        $photoId = 0;
                    } else {
                        $photoId = $lastPubId['id'];
                    }
                    $photoName = "Minsihoue" . ($photoId + 1) . '.' . $photo->extension();
                    $name = $photo->storeAs('post', $photoName, 'public');
                } else {
                    return back()->withErrors('La photo est trop grande');
                }
            } else {
                $name = 'null';
            }
                if(session('user')['grade']=='instituteur'){
                    $statut = 'attente';
                }else{
                    $statut = 'valide';
                }
                DB::beginTransaction();
                    $post = Post::create([
                    'texte' => $request->texte,
                    'photo' => $name,
                    ]);

                    $publication = new Publication([
                        'user_id' => session('user')['id'],
                        'statutPub' => $statut,
                        'postable_id' => $post->id,
                        'postable_type' => Post::class,
                    ]);
                    $publication->save();
                DB::commit();
            return 1;
        } catch (\Throwable $th) {
            DB::rollBack();
            die('Une erreur s\'est produite.'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        //
    }
}