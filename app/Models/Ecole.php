<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecole extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'circonscription_id',
    ];
     public function groupes() {
        return $this->hasMany(Groupe::class);
    }

    public function circonscription() {
        return $this->belongsTo(Circonscription::class);
    }
}