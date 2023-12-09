<?php
include "helpers.php";
$input = file_get_contents('inputs/test/9.txt');
$input = file_get_contents('inputs/9.txt');

function partOne($input)
{
    $total = 0;
    foreach (explode("\n", $input) as $line){
        $level = 0;
        $nestedNumbers = [];
        $nestedNumbers[] = explode(" ", $line);
        while(true){
            if(count(array_unique($nestedNumbers[$level])) === 1){
                $total += array_reduce($nestedNumbers, function($carry, $a){
                    return $carry + end($a);
                });
                continue 2;
            }
            foreach ($nestedNumbers[$level] as $index => $number){
                if(isset($nestedNumbers[$level][$index + 1])){
                    $nestedNumbers[$level + 1][] =  $nestedNumbers[$level][$index + 1] - $number;
                }
            }
            $level++;
        }
    }
    return $total;
}

function partTwo($input)
{
    $total = 0;
    foreach (explode("\n", $input) as $line){
        $level = 0;
        $nestedNumbers = [];
        $nestedNumbers[] = array_reverse(explode(" ", $line));
        while(true){
            if(count(array_unique($nestedNumbers[$level])) === 1){
                $total += array_reduce($nestedNumbers, function($carry, $a){
                    return $carry + end($a);
                });
                continue 2;
            }
            foreach ($nestedNumbers[$level] as $index => $number){
                if(isset($nestedNumbers[$level][$index + 1])){
                    $nestedNumbers[$level + 1][] =  $nestedNumbers[$level][$index + 1] - $number;
                }
            }
            $level++;
        }
    }
    return $total;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
