<?php
include "helpers.php";
$input = file_get_contents('inputs/test/3.txt');
$input = file_get_contents('inputs/3.txt');
function partOne($input)
{
    $symbols = str_replace([1,2,3,4,5,6,7,8,9,'0','.', ' ', "\n"],'', $input);
    $symbols = array_unique( str_split($symbols));
    $hits = [];
    $total = 0;
    foreach (explode("\n", $input) as $y => $line){
        foreach (str_split($line) as $x => $char){
            if(in_array($char, $symbols)){
                $hits[] = [$x, $y];
            }
            $map[$x][$y] = $char;
        }
    }
    foreach ($hits as [$x, $y]){
        $total += array_sum(array_unique(getParts($map, $x, $y)));
    }
    return $total;

}
function partTwo($input)
{
    $hits = [];
    $total = 0;
    foreach (explode("\n", $input) as $y => $line){
        foreach (str_split($line) as $x => $char){
            if(in_array($char, ['*'])){
                $hits[] = [$x, $y];
            }
            $map[$x][$y] = $char;
        }
    }
    foreach ($hits as [$x, $y]){
        $parts = getParts($map, $x, $y);
        if(count(array_unique($parts)) == 2 ){
            $total += array_product(array_unique($parts));
        }
    }
    return $total;
}
function getParts($map, $x, $y){
    $numberPositions = lookAround($map, $x, $y);
    $parts = [];
    foreach($numberPositions as [$xx, $yy]){
        $part = '';
        if(is_numeric($map[$xx-1][$yy])){
            $part .= $map[$xx-1][$yy];
            if(is_numeric($map[$xx-2][$yy])){
                $part = $map[$xx-2][$yy] . $part;
            }
        }
        $part.= $map[$xx][$yy];
        if(is_numeric($map[$xx+1][$yy])){
            $part.= $map[$xx+1][$yy];
            if(is_numeric($map[$xx+2][$yy])){
                $part.= $map[$xx+2][$yy];
            }
        }
        $parts[] = $part;
    }
    return $parts;
}
function lookAround(&$map, mixed $x, mixed $y)
{
    for($xDelta = -1; $xDelta < 2; $xDelta++){
        for($yDelta = -1; $yDelta < 2; $yDelta++){
            $tx = $x+$xDelta;
            $ty = $y+$yDelta;
            if(is_numeric($map[$tx][$ty] ?? null)){
                $numbersPositions[] = [$tx, $ty];
            }
        }
    }
    return $numbersPositions;
}
echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
