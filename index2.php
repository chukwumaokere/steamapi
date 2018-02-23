<!DOCTYPE html>
<title>Pinots Steam API POC</title>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<style>


</style>
<ul class="cb-slideshow" style="margin-top: 0px;">
	<li>
		<span></span>
		<div class ="content">
			<h1>Search for Steam Games</h1>
                <input name="gamename" class="has-border has-padding full-width shadow" placeholder="Steam App ID or game name"></input>
                <input class="half-width btn-shadow" type="submit" name="submit" value="Search">
        </form>
        <p class="bottom-text" style="color: white">Type "List All Games" (case-sensitive) in search box for a full list of games </p>
		</div>
	</li>
	<li>
		<span></span>
		<div>
			<h1>Search for Steam Games</h1>
		</div>

	</li>
</ul>

<!--
<div class="bg">

<div class="layer">

	<div class="content">
	<form action="<?php //echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="search">
		<h1>Search for Steam Games </h1>
		<input name="gamename" class="has-border has-padding full-width shadow" placeholder="Steam App ID or game name"></input>
		<input class="half-width btn-shadow" type="submit" name="submit" value="Search">
	</form>
	<p class="bottom-text" style="color: white">Type "List All Games" (case-sensitive) in search box for a full list of games </p>
	</div>
</div>
</div> -->

<?php
if(isset($_POST['submit'])){
	$url = "http://store.steampowered.com/api/appdetails?appids=";
  //      echo "Now";
        $gamename = $_REQUEST["gamename"];
	//echo is_numeric($gamename) . "\n <br>";
        //echo var_dump($gamename) . "\n <br>";
        include_once 'db.php';
        global $db;
        if (is_numeric($gamename) == ''){
                $q = "SELECT * FROM apps WHERE name LIKE \"%$gamename%\"";
		if ($gamename == ''){
			$q = '';
                	echo "Please Specify a game name or app id from Steam";
        	}
		if ($gamename == 'List All Games'){
			$q = "SELECT * FROM apps";
		}
	//	echo "$q \n <br>";
        }else if (is_numeric($gamename) == 1) {
                $q = "SELECT * FROM apps WHERE appid = $gamename";
	//	echo "$q \n <br>";
        }
	else{
		//Need to put 
                echo "Please specify a game name or app id from Steam";
        }

        $res = $db->query($q);

        while ($row =  $res->fetch_assoc() ){
		$appid = $row['appid'];
		$apiurl = $url . $appid;
		$json = file_get_contents($apiurl);
                echo "{$row['name']}\n <br>";
		$jsonfixed = str_replace("\\", '', $json);
		$jsonfixed = str_replace("<br>t", '<br>', $jsonfixed);
		$jsonfixed = str_replace("<br />rn", "<br>", $jsonfixed);
		//$jenc = json_encode($jsonfixed, true);
		echo "<pre> $jsonfixed </pre>  <br>";
        }

}else{
	//nothing was set.
	die();
}
?>


</body>
</html>
