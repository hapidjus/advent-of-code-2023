<?php
include "helpers.php";
$input = file_get_contents('inputs/test/10.txt');
$input = file_get_contents('inputs/10.txt');
CONST SIZE= 140;
CONST LOOKUP = [
    'J' => [[0, -1], [-1, 0]],
    '7' => [[0, 1], [-1, 0]],
    'F' => [[0, 1], [1, 0]],
    'L' => [[0, -1], [1, 0]],
];
function partOne($input)
{
    [$map, [$x, $y]] = parseMap($input);
    $dx = 1;
    $dy = 0;
    $tally = 0;
    $walked = [];

    while(true){
        $tally++;
        [$x, $y, $dx, $dy, $walked] = walk($map, $x, $y, $dx, $dy, $walked);
        if($map[$x][$y] == 'S'){
            localprintMap($walked, 0, SIZE, 0 ,SIZE);
            return $tally / 2;
        }
    }
}
function partTwo($input)
{
    [$map, [$x, $y]] = parseMap($input);
    $dx = 1;
    $dy = 0;
    $tally = 0;
    $walked = [];

    while(true){
        [$x, $y, $dx, $dy, $walked] = walk($map, $x, $y, $dx, $dy, $walked);
        if($map[$x][$y] == 'S'){
            for ($iy = 0; $iy < SIZE; $iy++ ){
                $inside = false;
                for ($ix = 0; $ix < SIZE; $ix++ ){
                    if(!isset($walked[$ix][$iy])){
                        if($inside){
                            $walked[$ix][$iy] = '▇';
                            $tally++;
                        }
                    }elseif(in_array($walked[$ix][$iy], ['|', 'F', '7'])){
                        $inside = !$inside;
                    }
                }
            }
            localprintMap($walked, 0, SIZE, 0 ,SIZE);
            return $tally;
        }
    }
}

function parseMap($input)
{
    foreach (explode("\n", $input) as $key => $line){
        foreach(str_split($line) as $i => $char){
            $map[$i][$key] = $char;
            if($char == 'S'){
                $start = [$i, $key];
            }
        }
    }
    return [$map, $start];
}
function walk(&$map, mixed $x, mixed $y, int $dx, int $dy, $walked)
{
    $x += $dx;
    $y += $dy;
    $current = $map[$x][$y];
    $walked[$x][$y] = $map[$x][$y];
    if (in_array($current, ['J', '7', 'F', 'L'])) {
        $dy = LOOKUP[$current][$dx ? 0 : 1][1];
        $dx = LOOKUP[$current][$dx ? 0 : 1][0];
    }
    return [$x, $y, $dx, $dy, $walked];
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;


function localprintMap(&$map, $minX, $maxX, $minY, $maxY){
    $ttable = [
        '|' => '│',
        '-' => '━',
        '7' => '┑',
        'J' => '┙',
        'F' => '┍',
        'L' => '┕',
    ];
    $line = '';
    for($y = $minY; $y <= $maxY; $y++){
        $line .= str_pad($y, '3') . ' ';
        for($x = $minX; $x <= $maxX; $x++){
            if(!isset($map[$x][$y])){
                $char = colorize("░", 'blue');
            }else if(isset($ttable[$map[$x][$y]])) {
                $char = colorize($ttable[$map[$x][$y]], 'yellow');
            }else if(in_array($map[$x][$y], ['S'])){
                $char = colorize($map[$x][$y], 'red');
            }else{
                $char = colorize($map[$x][$y], 'red');
            }
            $line .= $char;
        }
        $line .= PE;
    }
    echo $line. PE;
}
