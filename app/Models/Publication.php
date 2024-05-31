<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'statutPub',
        'postable_type',
        'postable_id',
    ];
        public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!isset($this->attributes['user_id'])) {
            $this->attributes['user_id'] = session('user')['id'];
        }

        if (!isset($this->attributes['statutPub'])) {
            $this->attributes['statutPub'] = 'attente';
        }
    }
    public function postable()
    {
        return $this->morphTo();
    }
}