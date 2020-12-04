<?php
$input = file_get_contents('input.txt');
if (!$input) die("Unable to open input.txt");

$list = explode("\n", $input);
$list = array_filter($list);

$slopes = [
    [1, 1],// cols, rows
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2],
];
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

$gridCopy = $grid;

$treesHitList = [];
foreach ($slopes as $slopeKey => $slopeSpec) {
    print("\nSLOPE: rows: {$slopeSpec[1]} cols: {$slopeSpec[0]}\n");
    $lineNum = 0;
    $col = 0;
    $treesHit = 0;
    while ($lineNum+$slopeSpec[1] < $lineMax) {
        $lineNum += $slopeSpec[1];
        $col += $slopeSpec[0];
        if ($col > $colMax-1) {
            //print("\nEND OF COLS\n");
            $col = $col - $colMax;
        }

        $checkVal = $grid[$lineNum][$col];
        //print("\nLine: $lineNum Col: $col\n");
        switch ($checkVal) {
            case '.': $grid[$lineNum][$col] = 'O'; break;
            case '#': $grid[$lineNum][$col] = 'X'; $treesHit++; break;
            default: die('Unexpected checkval: '.serialize($checkVal));
        }
    }
    $treesHitList[] = $treesHit;
    //printGrid($grid);
    print("\n\nTrees Hit: $treesHit\n");
    $grid = $gridCopy;
}

print_r($treesHitList);

$ret = 0;
print("\nTrees hit product: ".array_product($treesHitList)."\n\n");
