<?php
include "helpers.php";
function partOne()
{
    $test = [
        7 => 9,
        15 => 40,
        30 => 200,
    ];
    $real = [
        57 => 291,
        72 => 1172,
        69 => 1176,
        92 => 2026,
    ];
    $total = 1;
    foreach ($real as $time => $distance)
    {
        $tally = 0;
        $tick = $time;
        while($tick--){
            $traveled = $tick * ($time - $tick) . PE;
            if($traveled > $distance){
                $tally++;
            }
        }
        $total *= $tally;
    }
    return $total;
}
function partTwo()
{
    $test = [
        71_530 => 940200,
    ];
    $real = [
        57_726_992 => 291_117_211_762_026,
    ];
    $total = 1;
    foreach ($real as $time => $distance)
    {
        $tally = 0;
        $tick = $time;
        while($tick--){
            $traveled = $tick * ($time - $tick) . PE;
            if($traveled > $distance){
                $tally++;
            }
        }

        $total *= $tally;
    }
    return $total;
}

echo "Part 1: " . partOne() . PE;
echo "Part 2: " . partTwo() . PE;
