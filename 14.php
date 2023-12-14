<?php
include "helpers.php";
$input = file_get_contents('inputs/test/14.txt');
$input = file_get_contents('inputs/14.txt');

function partOne($input)
{
    $map = transpose(explode("\n", $input));
    foreach ($map as &$line){
        while(str_contains($line, '.O')){
            $line = str_replace('.O', 'O.', $line);
        }
    }
    $tally = 0;
    foreach(transpose($map) as $i => $l){
        $tally += (substr_count($l, 'O') * (count($map) - $i));
    }
    return $tally;
}
function partTwo($input)
{
    $map = transpose(explode("\n", $input));
    $subs = ['.O', '.O', 'O.', 'O.'];
    $roll = 0;
    $hashes = [];
    while(true){
        $hash = md5(implode($map));
        if(isset($hashes[$hash])){
            if((1_000_000_000 * 4 - $roll) % ($roll - $hashes[$hash]) < 1){
                break;
            }
        }
        $hashes[$hash] = $roll ;
        foreach ($map as &$line){
            while(str_contains($line, $subs[$roll % 4])) {
                $line = str_replace($subs[$roll % 4], strrev($subs[$roll % 4]), $line);
            }
        }
        $map = transpose($map);
        $roll++;
    }
    $tally = 0;
    foreach (transpose($map) as $i => $l) {
        $tally += (substr_count($l, 'O') * (count($map) - $i));
    }
    return $tally;

}
function transpose($lines)
{
    foreach($lines as $line){
        $line = str_split($line);
        foreach($line as $j => $char){
            $rows[$j] = isset($rows[$j]) ? $rows[$j] . $char :  $char;
        }
    }
    return $rows;
}

echo "Part 1: 105003 =" . partOne($input) . PE;
echo "Part 2: 93742 = " . partTwo($input) . PE;
