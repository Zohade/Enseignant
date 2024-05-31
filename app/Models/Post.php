<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publication;

class Post extends Publication
{
    use HasFactory;
    protected $fillable = [
        'texte',
        'photo',
    ];

    //constructeur prenant en compte le parent publication
    public function __construct()
    {

    }
    public function publication()
    {
        return $this->morphOne('App\Models\Publication', 'postable');
    }
}
