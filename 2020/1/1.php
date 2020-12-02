<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\n", $input);
foreach ($list as $num) {
    print("\nChecking: $num");
    $expected = 2020 - $num;
    if ($key = array_search($expected, $list)) {
        print("\nFound at $key: $list[$key]");
        die("\nAnswer: ".$num * $list[$key]."\n\n");
    }
}

die("\n\nFAIL\n");
