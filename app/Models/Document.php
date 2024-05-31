<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Publication
{
    use HasFactory;
    protected $fillable = [
        'type_doc',
        'titre',
        'fichier',
        'desc',
        'classe',
        'payant',
        'prix',
        'matiere',
        'SA',
    ];
     public function __construct()
    {

    }
    public function publication()
    {
        return $this->morphOne('App\Models\Publication', 'document');
    }
}
