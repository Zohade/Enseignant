<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        'ecole_id',
        'user_id',
    ];
    public function classes() {
        return $this->hasMany(Classe::class);
    }

    public function ecole() {
        return $this->belongsTo(Ecole::class);
    }
}