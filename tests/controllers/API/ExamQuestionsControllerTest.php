<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExamQuestionsControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testShow()
    {
        $exam = factory(App\Exam::class)->create();
        $this->json('GET', route('exams.questions.show', [
            'exam' => $exam->id,
            'question' => 1,
            'api_token' => $exam->api_token,
        ]))
        ->seeJsonStructure(['exam_id', 'number', 'text', 'answers'])
        ->seeJson([
            'exam_id' => $exam->id,
            'number' => 1
        ]);
        $exam->delete();
    }

    public function testUpdateWithWrongAnswer()
    {
        $pddQuestion = App\PddQuestion::inRandomOrder()->first();
        $exam = factory(App\Exam::class)->create();

        $question = factory(App\ExamQuestion::class)->make([
            'number' => 1,
            'pdd_question_id' => $pddQuestion->id
        ]);
        $exam->questions()->save($question);

        $answer = $pddQuestion->answer;
        if ($answer > 1) {
            --$answer;
        } else {
            ++$answer;
        }

        $this->json('PATCH', route('exams.questions.update', [
            'exam' => $exam->id,
            'question' => 1,
            'api_token' => $exam->api_token,
            'answer' => $answer,
        ]))
        ->seeJsonStructure(['exam_id', 'number', 'answer'])
        ->seeJson([
            'exam_id' => $exam->id,
            'number' => 1,
            'answer' => [
                'number' => $answer,
                'correct' => false
            ]
        ]);
    }

    public function testUpdateWithRightAnswer()
    {
        $pddQuestion = App\PddQuestion::inRandomOrder()->first();
        $exam = factory(App\Exam::class)->create();

        $question = factory(App\ExamQuestion::class)->make([
            'number' => 2,
            'pdd_question_id' => $pddQuestion->id
        ]);
        $exam->questions()->save($question);

        $this->json('PATCH', route('exams.questions.update', [
            'exam' => $exam->id,
            'question' => 2,
            'api_token' => $exam->api_token,
            'answer' => $pddQuestion->answer,
        ]))
        ->seeJsonStructure(['exam_id', 'number', 'answer'])
        ->seeJson([
            'exam_id' => $exam->id,
            'number' => 2,
            'answer' => [
                'number' => $pddQuestion->answer,
                'correct' => true
            ]
        ]);
    }
}
