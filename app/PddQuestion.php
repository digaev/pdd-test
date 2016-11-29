<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Lang;

class PddQuestion extends Model
{
    protected $fillable = [
        'ticket', 'number', 'answer'
    ];

    protected $casts = [
        'ticket' => 'integer',
        'number' => 'integer',
        'answer' => 'integer'
    ];

    public function answers()
    {
        return $this->hasMany('App\PddAnswer');
    }

    public function questionText()
    {
        return Lang::get("pdd_questions.{$this->ticket}.{$this->number}.text");
    }

    public function answerText($number = null)
    {
        $answers = Lang::get("pdd_questions.{$this->ticket}.{$this->number}.answers");
        return $number ? $answer[strval($number)] : $answers;
    }
}
