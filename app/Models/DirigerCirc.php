<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirigerCirc extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','circonscription_id','annee_scolaire'
    ];
}