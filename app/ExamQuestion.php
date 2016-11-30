<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_id', 'pdd_question_id', 'number', 'answer'
    ];

    protected $casts = [
        'exam_id' => 'integer',
        'pdd_question_id' => 'integer',
        'number' => 'integer',
        'answer' => 'integer'
    ];

    protected $hidden = [
        'pdd_question_id', 'created_at', 'updated_at'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function pddQuestion()
    {
        return $this->belongsTo('App\PddQuestion');
    }

    public function jsonSerialize()
    {
        $json = parent::jsonSerialize();
        if ($this->pddQuestion) {
            $json['text'] = $this->pddQuestion->questionText();
            $json['answers'] = $this->pddQuestion->answerText();

            if ($this->answer) {
                $json['answer'] = [
                    'number' => $this->answer,
                    'correct' => $this->pddQuestion->answer == $this->answer
                ];
            }
        }
        return $json;
    }
}
