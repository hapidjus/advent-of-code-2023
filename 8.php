<?php
include "helpers.php";
$input = file_get_contents('inputs/test/8.txt');
$input = file_get_contents('inputs/8.txt');

function lcm($x, $y) {
    $large = max($x,$y);
    $small = min($x,$y);
    $i = $large;

    while (true) {
        if($i % $small == 0)
            return $i;
        $i = $i + $large;
    }
}
function parseNodes($str){
    foreach (explode("\n", $str) as $line){
        $nodeList[substr($line, 0, 3)] = [
            'L' => substr($line, 7, 3),
            'R' => substr($line, 12, 3)
        ];
    }
    return $nodeList;
}
function partOne($input)
{
    $i = 0;
    $total = 0;
    [$path, $nodes] = explode("\n\n", $input);
    $nodeList = parseNodes($nodes);
    $pathLength = strlen($path);
    $node = 'AAA';
    while(true){
        $node = $nodeList[$node][$path[$total % $pathLength]];
        if($node == 'ZZZ'){
            return $total + 1;
        }
        $total++;
    }
}
function partTwo($input)
{
    [$path, $nodes] = explode("\n\n", $input);
    $nodeList = parseNodes($nodes);
    $startNodes = array_filter(array_keys($nodeList), fn($node) => $node[2] == 'A');
    $pathLength = strlen($path);
    $repeats = [];
    foreach ($startNodes as $startNode){
        $total = 0;
        $tempNode = $startNode;
        while(true){
            $tempNode = $nodeList[$tempNode][$path[$total % $pathLength]];
            if($tempNode[2] == 'Z'){
                $repeats[$startNode] = $total + 1;
                continue 2;
            }
            $total++;
        }
    }
    $lcm = 1;
    foreach ($repeats as $r){
        $lcm = lcm($lcm, $r);
    }
    return $lcm;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
