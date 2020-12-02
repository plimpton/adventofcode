<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\n", $input);
foreach ($list as $num) {
    print("\n\nChecking: $num");
    foreach ($list as $num2) {
        print("\nCheck2: $num2");
        $expected = 2020 - $num - $num2;
        if ($key = array_search($expected, $list)) {
            print("\nFound at $key: $num * $num2 * $list[$key]");
            die("\nAnswer: ".$num * $num2 * $list[$key]."\n\n");
        }
    }
}

die("\n\nFAIL\n");
