<?php
include_once 'db.php';
global $db;

$app = json_decode(file_get_contents('steamgames2.json'), true);
$array_size = sizeof($app["applist"]["apps"]);
$i=0;
$x=0;

while($x < $array_size){
	$appid = $app["applist"]["apps"][$i]["appid"];
	$name = $app["applist"]["apps"][$i]["name"];

	$str = "INSERT INTO apps (appid, name) VALUES ($appid, \"$name\")";
	$i++;
	$x++;
	$db->query($str);
	echo "$str \n";
}

//echo "$str \n\n";
//var_dump($array_size);
