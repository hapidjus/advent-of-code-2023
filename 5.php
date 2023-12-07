<?php
include "helpers.php";
$input = file_get_contents('inputs/test/5.txt');
$input = file_get_contents('inputs/5.txt');
function partOne($input)
{
    [$seeds, $soil, $fert, $water, $light, $temp, $hum, $location ] = explode("\n\n", $input);
    $seeds = explode(' ', substr($seeds, 7));
    $soil = parseGroup($soil);
    $fert = parseGroup($fert);
    $water = parseGroup($water);
    $light = parseGroup($light);
    $temp = parseGroup($temp);
    $hum = parseGroup($hum);
    $location = parseGroup($location);
    foreach ($seeds as $seed){
        $destination = translate($seed, $soil);
        $destination = translate($destination, $fert);
        $destination = translate($destination, $water);
        $destination = translate($destination, $light);
        $destination = translate($destination, $temp);
        $destination = translate($destination, $hum);
        $destination = translate($destination, $location);
        $destinations[] = $destination;
    }
    return min($destinations);
}

function translate($from, $dict)
{
    foreach ($dict as $key => [$destinationRange, $sourceRange, $rangeLength]){
        if($from >= $sourceRange && $from <= $sourceRange + $rangeLength){
            return $from - $sourceRange + $destinationRange;
        }
    }
    return $from;
}

function translateBack($from, $dict)
{
    foreach ($dict as $key => [$sourceRange, $destinationRange, $rangeLength]){
        if($from >= $sourceRange && $from <= $sourceRange + $rangeLength){
            return $from - $sourceRange + $destinationRange;
        }
    }
    return $from;
}

function parseGroup(string $group)
{
    $group = explode("\n", $group);
    $group = array_map(function($line){
        return explode(' ', $line);
    }, $group);
    array_shift($group);
    return $group;
}

function partTwo($input)
{
    [$seeds, $soil, $fert, $water, $light, $temp, $hum, $location ] = explode("\n\n", $input);
    $seeds = explode(' ', substr($seeds, 7));
    $seedranges = array_chunk($seeds, 2);
    $soil = parseGroup($soil);
    $fert = parseGroup($fert);
    $water = parseGroup($water);
    $light = parseGroup($light);
    $temp = parseGroup($temp);
    $hum = parseGroup($hum);
    $location = parseGroup($location);
    $loc = 0;
    while(true) {
        $destination = translateBack($loc, $location);
        $destination = translateBack($destination, $hum);
        $destination = translateBack($destination, $temp);
        $destination = translateBack($destination, $light);
        $destination = translateBack($destination, $water);
        $destination = translateBack($destination, $fert);
        $destination = translateBack($destination, $soil);

        if(inSeedrange($seedranges, $destination)){
            return $loc;
        }
        $loc++;
    }

}

function inSeedrange(array $seedranges, int $int)
{
    foreach ($seedranges as [$seedrangeStart, $seedrangeLength]){
        if($int >= $seedrangeStart && $int <= $seedrangeStart+$seedrangeLength){
            return true;
        }
    }
    return false;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
