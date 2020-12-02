<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\n", $input);
$numValid = 0;
foreach ($list as $line) {
    print("\nChecking: $line");
    if (empty($line)) continue;

    $segments = explode(" ", $line);
    $minMax = explode("-", $segments[0]);
    $min = $minMax[0];
    $max = $minMax[1];
    $letter = $segments[1];
    $letter = str_replace(":", "", $letter);
    $pwd = $segments[2];
    //print("\n Min: $min Max: $max");// Letter: $letter Pwd: $pwd\n");

    $foundFirst = substr($pwd, $min -1, 1) == $letter;
    $foundSecond = substr($pwd, $max -1, 1) == $letter;
    if (($foundFirst && !$foundSecond) || ($foundSecond && !$foundFirst)) {
        print("\nVALID");
        $numValid++;
    }
}

print("\n\nNum valid: $numValid\n\n");

die("\n\nFAIL\n");
