<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'api_token'
    ];

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function questions()
    {
        return $this->hasMany('App\ExamQuestion');
    }
}
