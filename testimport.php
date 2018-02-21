<?php

$string = file_get_contents('./steamgames2.json');
//echo $string;
//$json_a = json_decode($string, true);

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($string, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $column => $value) {
    if(is_array($value)) {
 //       echo "$column\n";
	$appid = $column;
	
    } else {
       echo "$column => $value\n\n";
    }
}
