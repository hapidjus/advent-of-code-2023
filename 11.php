<?php
include "helpers.php";
$input = file_get_contents('inputs/test/11.txt');
$input = file_get_contents('inputs/11.txt');

function partOne($input)
{
    foreach (explode("\n", $input) as $y => $line){
        foreach(str_split($line) as $x => $char){
            $map[$y][$x] = $char;
            if($char == '#'){
                $galaxy[] = [$x, $y];
            }
        }
        if(substr_count($line, '#') == 0){
            $emptyY[] = $y;
        }
    }
    for($x = 0; $x < count($map[0]); $x++){
        if(count(array_unique(array_column($map, $x))) == 1){
            $emptyX[] = $x;
        }
    }
    foreach ($galaxy as $i => [$x, $y]){
        foreach ($galaxy as $j => [$xx, $yy]){
            if($i == $j || isset($distances[min($i, $j) . '-' . max($i, $j)])){
                continue;
            }
            $xAdds = array_filter($emptyX, function($a) use ($x, $xx){
                return $a > min($x, $xx) && $a < max($x, $xx);
            });
            $yAdds = array_filter($emptyY, function($a) use ($y, $yy){
                return $a > min($y, $yy) && $a < max($y, $yy);
            });
            $distances[min($i, $j) . '-' . max($i, $j)] = abs($xx - $x) + abs($yy - $y) + count($yAdds) + count($xAdds);
        }
    }
    return array_sum($distances);
}
function partTwo($input)
{
    foreach (explode("\n", $input) as $y => $line){
        foreach(str_split($line) as $x => $char){
            $map[$y][$x] = $char;
            if($char == '#'){
                $galaxy[] = [$x, $y];
            }
        }
        if(substr_count($line, '#') == 0){
            $emptyY[] = $y;
        }
    }
    for($x = 0; $x < count($map[0]); $x++){
        if(count(array_unique(array_column($map, $x))) == 1){
            $emptyX[] = $x;
        }
    }
    foreach ($galaxy as $i => [$x, $y]){
        foreach ($galaxy as $j => [$xx, $yy]){
            if($i == $j || isset($distances[min($i, $j) . '-' . max($i, $j)])){
                continue;
            }
            $xAdds = array_filter($emptyX, function($a) use ($x, $xx){
                return $a > min($x, $xx) && $a < max($x, $xx);
            });
            $yAdds = array_filter($emptyY, function($a) use ($y, $yy){
                return $a > min($y, $yy) && $a < max($y, $yy);
            });
            $distances[min($i, $j) . '-' . max($i, $j)] = abs($xx - $x) + abs($yy - $y) + count($yAdds) * 999_999 + count($xAdds) * 999_999;
        }
    }
    return array_sum($distances);
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
