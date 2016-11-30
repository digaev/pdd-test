<?php

namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Http\Request;

use App\Exam;
use App\ExamQuestion;

class ExamQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show(Exam $exam, ExamQuestion $question)
    {
        $json = [
            'exam_id' => $exam->id,
            'number' => $question->number,
            'text' => $question->pddQuestion->questionText(),
            'answers' => $question->pddQuestion->answerText()
        ];

        if ($question->answer) {
            $json['answer'] = [
                'number' => $question->answer,
                'correct' => $question->pddQuestion->answer == $question->answer
            ];
        }
        return $json;
    }

    public function update(Request $request, Exam $exam, ExamQuestion $question)
    {
        $this->validate($request, [
            'answer' => 'required|integer',
        ]);

        if (!$question->answer) {
            $question->answer = (int) $request->input('answer');
            $question->save();
        }

        $json = [
            'exam_id' => $exam->id,
            'number' => $question->number,
            'answer' => [
                'number' => $question->answer,
                'correct' => $question->pddQuestion->answer == $question->answer
            ]
        ];
        return $json;
    }
}
