<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PddAnswer extends Model
{
    protected $fillable = [
        'number'
    ];

    protected $casts = [
        'number' => 'integer'
    ];

    public function question()
    {
        return $this->belongsTo('App\PddQuestion');
    }
}
