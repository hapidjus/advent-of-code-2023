<?php
include "helpers.php";
$input = file_get_contents('inputs/test/4.txt');
$input = file_get_contents('inputs/4.txt');
function partOne($input)
{
    $total = 0;
    $input = explode("\n", $input);
    foreach($input as $line){
        [$game, $line] = explode(':', $line);
        [$winning, $current] = explode('|', $line);
        $winning = array_filter(explode(' ', trim($winning)));
        $current = array_filter(explode(' ', trim($current)));
        $score = floor(pow(2, count(array_intersect($winning, $current))-1));
        $total+= $score;
    }
    return $total;
}
function partTwo($input)
{
    $input = explode("\n", $input);
    $stack = array_fill(1, count($input), 1);
    foreach($input as $line){
        [$game, $line] = explode(':', $line);
        $game = trim(substr($game, 4));
        [$winning, $current] = explode('|', $line);
        $winning = array_filter(explode(' ', trim($winning)));
        $current = array_filter(explode(' ', trim($current)));
        $score = count(array_intersect($winning, $current));
        for ($i = $game+1; $i <= $game+$score; $i++){
            $stack[$i] +=  $stack[$game] ?? 0;
        }
    }

    return array_sum($stack);
}
echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
