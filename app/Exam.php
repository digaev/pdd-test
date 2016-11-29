<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'api_token', 'total_questions'
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
