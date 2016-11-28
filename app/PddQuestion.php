<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PddQuestion extends Model
{
    protected $fillable = [
        'ticket', 'number', 'answer'
    ];

    public function answers()
    {
        return $this->hasMany('App\PddAnswer');
    }
}
