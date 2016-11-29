<?php

class ExamQuestionsControllerTest extends TestCase
{
    public function testShow()
    {
        $exam = factory(App\Exam::class)->create();
        $this->json('GET', route('exams.questions.show', [
            'exam' => $exam->id,
            'question' => 1,
            'api_token' => $exam->api_token,
        ]))
        ->seeJsonStructure(['exam_id', 'number', 'answer', 'text', 'answers'])
        ->seeJson([
            'exam_id' => $exam->id,
            'number' => 1
        ]);
    }
}
