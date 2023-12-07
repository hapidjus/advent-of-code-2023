<?php
include "helpers.php";
$input = file_get_contents('inputs/test/7.txt');
$input = file_get_contents('inputs/7.txt');
function sortCards($b, $a, $joker = false){
    if($joker) {
        $aOrg = $a;
        $bOrg = $b;
        // Replace J with most common char
        $a = replaceJoker($a);
        $b = replaceJoker($b);
    }
    // Less count of distinct cards means higher rating
    if(($ac = count($ca = count_chars($a, 1))) !== ($bc = count($cb = count_chars($b, 1)))){
        return $ac <=> $bc;
    }
    // If same distinct count, max count for any char means higher rating
    if($ac == 2 || $ac == 3){
        if(($ma = max($ca)) !== ($mb = max($cb))){
            return $mb <=> $ma;
        }
    }
    $subArray = $joker ? [10,1,12,13,14] : [10,11,12,13,14];
    $a = $joker ? $aOrg : $a;
    $b = $joker ? $bOrg : $b;
    // Start compare card values
    for ($i = 0; $i < 5; $i++){
        $aSub = str_replace(['T', 'J', 'Q', 'K', 'A'], $subArray, $a[$i]);
        $bSub = str_replace(['T', 'J', 'Q', 'K', 'A'], $subArray, $b[$i]);
        if($aSub !== $bSub){
            return (int)$bSub <=> (int)$aSub;
        }
    }
    return 0;
}
function replaceJoker($a)
{
    if (!str_contains($a, 'J')) {
        return $a;
    }
    $aCharCount = count_chars(str_replace('J', '', $a), 1);
    arsort($aCharCount);
    return str_replace('J', chr(array_key_first($aCharCount)), $a);
}
function partOne($input)
{
    foreach (explode("\n", $input) as $line){
        [$hand, $bid] = explode(" ", $line);
        $hands[] = $hand;
        $bids[$hand] = $bid;
    }
    usort($hands, 'sortCards');
    $total = 0;
    foreach($hands as $rank => $hand){
        $total += ($rank+1) * $bids[$hand];
    }
    return $total;
}
function partTwo($input)
{
    foreach (explode("\n", $input) as $line){
        [$hand, $bid] = explode(" ", $line);
        $hands[] = $hand;
        $bids[$hand] = $bid;
    }
    usort($hands, function ($a, $b){
        return sortCards($a, $b, true);
    });

    $total = 0;
    foreach($hands as $rank => $hand){
        $total += ($rank+1) * $bids[$hand];
    }
    return $total;
}

echo "Part 1: " . partOne($input) . PE;
echo "Part 2: " . partTwo($input) . PE;
