<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_id', 'number', 'answer'
    ];

    protected $casts = [
        'exam_id' => 'integer',
        'number' => 'integer'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
