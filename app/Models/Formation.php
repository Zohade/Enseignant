<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Publication
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'formateur',
        'desc',
        'dateDebut',
        'dateFin',
        'payant',
        'prix',
    ];

     public function __construct()
    {

    }
    public function publication()
    {
        return $this->morphOne('App\Models\Publication', 'formation');
    }
}
