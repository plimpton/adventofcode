<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\n", $input);
$list = array_filter($list);

$grid = [];
$colMax = null;
$lineMax = count($list);
foreach ($list as $row) {
    $line = str_split($row);
    array_pop($line);//empty
    $colMax = count($line);
    $grid[] = $line;
}

function printGrid(array $grid)
{
    foreach ($grid as $row) {
        print("\n".implode($row));
    }
    print("\n");
}

print("\nLineMax: $lineMax ColMax: $colMax");

$lineNum = 0;
$col = 0;
$treesHit = 0;
while ($lineNum+1 < $lineMax) {
    $lineNum++;
    $col += 3;
    if ($col > $colMax-1) {
        print("\nEND OF COLS\n");
        $col = $col - $colMax;
    }

    $checkVal = $grid[$lineNum][$col];
    print("\nLine: $lineNum Col: $col\n");
    switch ($checkVal) {
        case '.': $grid[$lineNum][$col] = 'O'; break;
        case '#': $grid[$lineNum][$col] = 'X'; $treesHit++; break;
        default: die('Unexpected checkval: '.serialize($checkVal));
    }
}
printGrid($grid);

print("\n\nTrees Hit: $treesHit\n");
