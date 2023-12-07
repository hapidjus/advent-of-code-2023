<?php
include "helpers.php";
$input = file_get_contents('inputs/test/2.txt');
$input = file_get_contents('inputs/2.txt');

function partOne($input)
{
    $total = 0;
    $limits = [
        'red'       => 12,
        'green'     => 13,
        'blue'      => 14,
    ];
    foreach (explode("\n", $input) as $index => $line) {
        $totals = [];
        [$game, $line] = explode(':', $line);
        $grabs = explode(";", $line);
        foreach ($grabs as $cubesTuples){
            $cubes = explode(",", $cubesTuples);
            foreach ($cubes as $cube){
                [$count, $color] = explode(" ", trim($cube));
                $totals[$color] = max($totals[$color] ?? 0, $count);
            }
        }
        foreach ($totals as $color => $count){
            if($count > $limits[$color]){
                $total += $index + 1;
                continue 2;
            }
        }
    }
    return(array_sum(range(1, 100)) - $total);
}

function partTwo($input)
{
    $total = 0;
    foreach (explode("\n", $input) as $line) {
        $totals = [];
        [$game, $line] = explode(':', $line);
        $grabs = explode(";", $line);
        foreach ($grabs as $cubesTuples){
            $cubes = explode(",", $cubesTuples);
            foreach ($cubes as $cube){
                [$count, $color] = explode(" ", trim($cube));
                $totals[$color] = max($totals[$color] ?? 0, $count);
            }
        }
        $total += array_product($totals);
    }
    return $total;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
