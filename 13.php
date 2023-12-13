<?php
include "helpers.php";
$input = file_get_contents('inputs/test/13.txt');
$input = file_get_contents('inputs/13.txt');

function partOne($input)
{
    return array_reduce(explode("\n\n", $input), function($carry, $board){
        $lines = explode("\n", $board);
        $carry += tallyMirrors($lines) * 100;
        $rows = transpose($lines);
        return $carry + tallyMirrors($rows);
    });
}

function partTwo($input){
    return array_reduce(explode("\n\n", $input), function($carry, $board){
        $lines = explode("\n", $board);
        $carry += tallyMirrors($lines, 1) * 100;
        $rows = transpose($lines);
        return $carry + tallyMirrors($rows, 1);
    });
}

function transpose(array $lines)
{
    foreach($lines as $line){
        $line = str_split($line);
        foreach($line as $j => $char){
            $rows[$j] = isset($rows[$j]) ? $rows[$j] . $char :  $char;
        }
    }
    return $rows;
}

function tallyMirrors(array $lines, $smidges = 0)
{
    foreach ($lines as $key => $line){
        if($key == 0){
            continue;
        }
        $top = array_reverse(array_slice($lines,0, $key));
        $bottom = array_slice($lines,$key);
        $top = array_slice($top,0, min(count($top), count($bottom)));
        $bottom = array_slice($bottom, 0, min(count($top), count($bottom)));
        if($smidges){
            if(levenshtein(implode($top), implode($bottom)) == $smidges){
                return $key;
            }
        }else if($top == $bottom){
            return $key;
        }
    }
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
