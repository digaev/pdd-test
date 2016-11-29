<?php

namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Http\Request;

use App\Exam;

class ExamQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show($examId, $questionId)
    {
        $exam = $this->findExam($examId, $questionId);
        $question = $exam->firstOrCreateQuestion($questionId);

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

    public function update(Request $request, $examId, $questionId)
    {
        $this->validate($request, [
            'answer' => 'required|integer'
        ]);

        $exam = $this->findExam($examId, $questionId);
        $question = $exam->questions()->where('number', $questionId)->firstOrFail();
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

    private function findExam($examId, $number)
    {
        $exam = Exam::where('id', $examId)
            ->where('id', Auth::guard('api')->id())
            ->firstOrFail();
        if ($number < 1 || $number > $exam->total_questions) {
            throw new ModelNotFoundException;
        }
        return $exam;
    }
}
