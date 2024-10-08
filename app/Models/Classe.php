<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable =
    [
        "nom",
        'groupe_id',
        'user_id',
    ];
     public function groupe() {
        return $this->belongsTo(Groupe::class);
    }
}