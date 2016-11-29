<?php

use Illuminate\Database\Seeder;
use App\PddQuestion;

class PddQuestionsSeeder extends Seeder
{
    public function run()
    {
        factory(App\PddQuestion::class, 50)->make()->each(function ($q) {
            $answers_count = count(Lang::get("pdd_questions.{$q->ticket}.{$q->number}.answers"));

            $q->answer = rand(1, $answers_count);
            $q->save();

            factory(App\PddAnswer::class, $answers_count)
                ->make()
                ->each(function ($a, $i) use ($q) {
                    $a->number = $i + 1;
                    $q->answers()->save($a);
                });
        });
    }
}
