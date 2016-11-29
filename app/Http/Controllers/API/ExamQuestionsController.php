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

        return [
            'exam_id' => $exam->id,
            'number' => $question->number,
            'answer' => $question->answer,
            'text' => $question->pddQuestion->questionText(),
            'answers' => $question->pddQuestion->answerText()
        ];
    }

    public function update(Request $request, $examId, $questionId)
    {
        //
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
