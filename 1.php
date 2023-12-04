<?php
include "helpers.php";
$input = file_get_contents('inputs/test/1.txt');
$input = file_get_contents('inputs/test/1b.txt');
$input = file_get_contents('inputs/1.txt');

function partOne($input){
    $total = 0;
    foreach(explode("\n", $input) as $line){
        $line = preg_replace("/[^0-9]+/", "", $line);
        $total += ($line[0] * 10) + $line[strlen($line) - 1];
    }
    return $total;
}
function partTwo($input){
    $total = 0;
    foreach(explode("\n", $input) as $line){
        $line = str_replace(
            ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'],
            ['one1one', 'two2two', 'three3three', 'four4four', 'five5five', 'six6six', 'seven7seven', 'eight8eight', 'nine9nine'],
            $line
        );
        $line = preg_replace("/[^0-9]+/", "", $line);
        $total += ($line[0] * 10) + $line[strlen($line) - 1];
    }
    return $total;
}
echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
