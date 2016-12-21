<?php

if ($argc < 3) {
    echo "USAGE input.json output.php\n";
    exit();
}

$buf = file_get_contents($argv[1]);
$json = json_decode($buf);
$f = fopen($argv[2], 'w');
$t = 1;
$s = '';
$answers = [];
$questions = [];

fwrite($f, "<?php\n\n");
fwrite($f, "return [\n");

foreach ($json as $q) {


    if ($q->ticket != $t) {
        if ($s) {
            $b = "    '{$t}' => [\n";
            $b .= $s;
            $b .= "    ],\n";

            fwrite($f, $b);
            $s = '';
        }
        $t = $q->ticket;
    }
    $s .= "        '{$q->number}' => [\n";
    $s .= "             'text' => '{$q->question->ru}',\n";
    $s .= "             'answers' => [\n";
    foreach ($q->answers->ru as $i => $a) {
        $i++;
        $s .= "                '{$i}' => '{$a}',\n";
    }
    $s .= "            ],\n";
    $s .= "        ],\n";
}

if ($s) {
    $b = "    '{$t}' => [\n";
    $b .= $s;
    $b .= "    ],\n";

    fwrite($f, $b);
    $s = '';
}

fwrite($f, "];\n");
fclose($f);
