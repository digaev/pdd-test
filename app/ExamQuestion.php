<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_id', 'pdd_question_id', 'number', 'answer'
    ];

    protected $casts = [
        'exam_id' => 'integer',
        'pdd_question_id' => 'integer',
        'number' => 'integer'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function pddQuestion()
    {
        return $this->belongsTo('App\PddQuestion');
    }
}
