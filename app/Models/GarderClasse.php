<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarderClasse extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'classe_id',
        'annee_scolaire',
    ];
}