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

function dd($input){
	var_dump($input);
	die();
}

function ClearCLI() {
    echo chr(27).chr(91).'H'.chr(27).chr(91).'J';   //^[H^[J
}

function pause() {
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