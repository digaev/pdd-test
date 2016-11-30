<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'api_token', 'total_questions'
    ];

    protected $casts = [
        'total_questions' => 'integer'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function questions()
    {
        return $this->hasMany('App\ExamQuestion');
    }

    public function firstOrCreateQuestion($number)
    {
        $question = $this->questions()->firstOrNew(['number' => $number]);
        if (!$question->exists) {
            $question->pdd_question_id = $this->randomPddQuestion()->id;
            $question->save();
        }
        return $question;
    }

    private function randomPddQuestion()
    {
        return PddQuestion::whereNotIn('id', function ($q) {
            $q->select('pdd_question_id')
                ->from('exam_questions')
                ->where('exam_id', $this->id);
        })
        ->inRandomOrder()
        ->first();
    }
}
