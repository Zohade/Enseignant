<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Post;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
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
          $this->storeDocument(new PublicationRequest($request->all()));
            session(['last_submitted' => 'document']);
        } elseif ($request->has('FormationSoumission')) {
            $this->storeFormation(new PublicationRequest($request->all()));
            session(['last_submitted' => 'formation']);
        } else {
            $this->storePost(new PublicationRequest($request->all()));
            session(['last_submitted' => 'post']);
        }
    }

     protected function storeDocument(PublicationRequest $request)
    {
        // Logique pour sauvegarder le document
        $doc = $request->document;
        dd($doc);
    }

    protected function storeFormation(PublicationRequest $request)
    {
        // Logique pour sauvegarder la formation
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
                    return to_route('dash')->with('success', 'Publication effectuée');
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