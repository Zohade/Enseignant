<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirigerGroupe extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','groupe_id','annee_scolaire'];
}