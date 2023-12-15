<?php
include "helpers.php";
$input = file_get_contents('inputs/test/15.txt');
$input = file_get_contents('inputs/15.txt');

function partOne($input)
{
    return array_reduce(explode(',', $input), function ($carry, $item) {
        return $carry + HAASH($item);
    });
}

function partTwo($input)
{
    $boxes = array_fill(0, 256, []);
    foreach(explode(',', $input) as $item) {
        if(str_contains($item, '=')){
            [$label, $value] = explode('=', $item);
            $box = HAASH($label);
            $boxes[$box][$label] = $value;
        }else{
            $label = substr($item, 0, -1);
            $box = HAASH($label);
            unset($boxes[$box][$label]);
        }
    }
    $tally = 0;
    foreach ($boxes as $i => $box){
        $slot = 1;
        foreach ($box as $lens){
            $tally += ($i+1) * $slot++ * $lens;
        }
    }
    return $tally;
}

function HAASH($string)
{
    return array_reduce(str_split($string), function ($carry, $item) {
        return (($carry + ord($item)) * 17) % 256;
    });
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
