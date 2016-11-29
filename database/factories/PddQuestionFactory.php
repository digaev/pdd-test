<?php

$factory->define(App\PddQuestion::class, function() {
    return [
        'ticket' => rand(1, 10),
        'number' => rand(1, 10)
    ];
});
