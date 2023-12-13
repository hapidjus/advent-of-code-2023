<?php

CONST PE = PHP_EOL;
CONST BR = '<br>';

function dp($input){
    echo '<pre>';
	var_dump($input);
    echo '</pre>';
	die();
}

function dump($input)
{
    var_dump($input);
}

function dd($input = ''){
	var_dump($input);
	die();
}

function ClearCLI() {
    echo chr(27).chr(91).'H'.chr(27).chr(91).'J';   //^[H^[J
}

function pause() {
    echo 'PAUSED';
    $handle = fopen ("php://stdin","r");
    do { $line = fgets($handle); } while ($line == '');
    fclose($handle);
    return $line;
}
function colorize($str, $type = 'blue'){
    switch ($type) {
        case 'red':
            return "\033[31m$str\033[0m";
        case 'green':
            return "\033[32m$str\033[0m";
        case 'yellow':
            return "\033[33m$str\033[0m";
        case 'blue':
            return "\033[36m$str\033[0m";
        default:
        break;
    }
}

function printMap(&$map, $symbols, $minX, $maxX, $minY, $maxY){
    $line = '';
    for($y = $minY; $y <= $maxY; $y++){
        $line .= str_pad($y, '3') . ' ';
        for($x = $minX; $x <= $maxX; $x++){
            if(!isset($map[$x][$y])){
                $char = colorize(" ", 'blue');
            }else if(in_array($map[$x][$y], $symbols)) {
                $char = colorize($map[$x][$y], 'blue');
            }else if(in_array($map[$x][$y], range(0,9))){
                $char = colorize($map[$x][$y], 'red');
            }else{
                $char = colorize($map[$x][$y], 'yellow');
            }
            $line .= $char;
        }
        $line .= PE;
    }
    echo $line. PE;

}
