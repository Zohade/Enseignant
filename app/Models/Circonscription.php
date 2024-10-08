<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circonscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'ville_id',
        'user_id',
    ];
     public function ecoles() {
        return $this->hasMany(Ecole::class);
    }
}