<?php

class ExamsControllerTest extends TestCase
{
    public function testStore()
    {
        $this->json('POST', route('exams.store'))
            ->seeJsonStructure(['id', 'api_token', 'total_questions']);
    }

    public function testShow()
    {
        $exam = factory(App\Exam::class)->create();
        $this->json('GET', route('exams.show', [
            'exam' => $exam->id,
            'api_token' => $exam->api_token,
        ]))
        ->seeJsonStructure(['id', 'api_token', 'total_questions'])
        ->seeJson([
            'id' => $exam->id,
            'api_token' => $exam->api_token,
            'total_questions' => 10
        ]);
    }
}
