<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Publication;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationRequest;
use Illuminate\Http\Request;

class PostController extends Controller
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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationRequest $request, Post $post)
    {
        $pub = Post::where(['id' => $post->id])->update(['texte' => $request->texte]);
        if($pub){
            return back()->with(['success' => 'Votre post a été mis à jour']);
        }else{
            return back()->withErrors(['Une erreur s\'est produite']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $pub = Publication::where(['postable_type' => "App\Models\Post", "postable_id" => $post->id])->first();
        $back = Publication::where(['id' => $pub->id])->delete();
        if($back){
            return back()->with(['success' => 'Post suprimé avec succès']);
        }else{
            return back()->withErrors('Une erreur s\'est produite');
        }
    }
    public function getPost($id){
        $post = Post::where(['id' => $id])->first();
        $pub = Publication::where(['postable_type' => "App\Models\Post", 'postable_id' => $id])->first();
        $auteur = User::select('name', 'id','photo')->where(['id' => $pub->user_id])->first();
        return response()->json(['post'=> $post, "pub"=>$pub, 'auteur'=>$auteur]);
    }
    public function validePost($id){
        $pub = Publication::where(["postable_type" => "App\Models\Post", "postable_id" => $id])->update(["statutPub" => "valide"]);
        if($pub){
            return response()->json("success");
        }else{
            return response()->json('error');
        }
    }
    public function rejetePost($id){
         $pub = Publication::where(["postable_type" => "App\Models\Post", "postable_id" => $id])->update(["statutPub" => "rejet"]);
        if($pub){
            return response()->json("success");
        }else{
            return response()->json('error');
        }
    }
 }