<?php

$factory->define(App\ExamQuestion::class, function () {
    return [
        'number' => rand(1, 10)
    ];
});
