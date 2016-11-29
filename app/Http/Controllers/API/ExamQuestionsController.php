<?php

namespace App\Http\Controllers\API;

use App\Exam;
use App\ExamQuestion;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Http\Request;

class ExamQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show($examId, $questionId)
    {
        $exam = $this->findExam($examId);
        if ($questionId < 1 || $questionId > $exam->total_questions) {
            throw new ModelNotFoundException;
        }

        $question = ExamQuestion::firstOrCreate([
            'exam_id' => $examId,
            'number' => $questionId
        ]);
        return $question->toJson();
    }

    public function update(Request $request, $id)
    {
        //
    }

    private function findExam($id)
    {
        return Exam::where('id', $id)
            ->where('id', Auth::guard('api')->id())
            ->firstOrFail();
    }
}
