<?php

namespace App\Http\Controllers\API;

use App\Exam;
use Auth;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('store');
    }

    public function store(Request $request)
    {
        $exam = Exam::create([
            'api_token' => str_random(60),
            'total_questions' => 10
        ]);
        return $exam->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::where('id', $id)
            // TODO: use user_id
            ->where('id', Auth::guard('api')->id())
            ->firstOrFail();
        return $exam->toJson();
    }
}
