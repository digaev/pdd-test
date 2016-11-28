<?php

$factory->define(App\Exam::class, function() {
    return [
        'api_token' => str_random(60),
    ];
});
