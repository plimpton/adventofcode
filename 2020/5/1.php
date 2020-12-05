<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\n", $input);
$list = array_filter($list);

//print_r($list);
$list = ['FBFBBFFRLR'];

function getMedian($arr) {
    $count = count($arr);
    $middleval = floor(($count-1)/2);
    if ($count % 2) {
        $median = $arr[$middleval];
    } else {
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return floor($median);
}

function rowChar($low, $high, $char) {
    switch ($char) {
        case 'F':
            $high = getMedian(range($low, $high));
            break;
        case 'B':
            $low = getMedian(range($low, $high));
            break;
        default: die('Bad row char: '.$char);
    }
    return [$low, $high];
}

foreach ($list as $row) {
    print($row);
    //First 7 chars is row, seat is last 3 chars
    $rowLow = 0;
    $rowHigh = 127;
    for ($i=0;$i<7;$i++) {
        print("\nRowlow: $rowLow Rowhigh: $rowHigh");
        [$rowLow,$rowHigh] = rowChar($rowLow,$rowHigh, $row[$i]);
    }
    print("\nRowlow: $rowLow Rowhigh: $rowHigh\n");
    break;
}
