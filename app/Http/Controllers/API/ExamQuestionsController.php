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
        return $question->toJson();
    }

    public function update(Request $request, Exam $exam, ExamQuestion $question)
    {
        $this->validate($request, [
            'answer' => 'required|integer',
        ]);

        if (!$question->answer) {
            $question->answer = $request->input('answer');
            $question->save();
        }
        return $question->toJson();
    }
}
