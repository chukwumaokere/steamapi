<!DOCTYPE html>
<title>Pinots Steam API POC</title>
<head></head>
<body>
<style>

html, body {
    margin: 0 auto;
    padding: 0;
    height: 100%;
/*    display: table; */
}

.bg{
	background-image: url('bc1.png');
	background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	 width: 100%;
    height: 100%;
	 margin: 0;
    padding: 0;
	z-index: 1;
	
}

.layer {
	background-color: rgba(0,0,0,0.5);
/*	background: grey no-repeat center center; */
	margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
	z-index: 2;
}

input, textarea, h1, p{
	font-family: "PT Sans", sans-serif;
}

h1 {
	color: white;
	margin-top: 0px;
}
p.bottom-text {
	margin-top: 8px;
	text-align: center;
	font-size: 12px;
}

.has-border {
	border: 1px solid #d2d8d8;
	-webkit-appearance: none;
	border-radius: 5px;
}

.has-padding {
	padding: 16px 20px 16px 20px;
	
}

.has-border:focus {
	border-color: #343642;
	box-shadow: 0 0 5px rgba(52, 54, 66, 0.1);
	outline: none;
	border-radius: 5px;
	      border-color: #343642;
   -moz-box-shadow:    inset 0 0 10px 3px #888;
   -webkit-box-shadow: inset 0 0 10px 3px #888;
   box-shadow: inset 0 0 10px 3px #888;
}

.btn-shadow {
}

.btn-shadow:hover{
	box-shadow:         0px 0px 10px 3px #888;
	-webkit-box-shadow: 0px 0px 10px 3px #888;
	-moz-box-shadow: 0px 0px 10px 3px #888;
}
.btn-shadow:focus{
appearance: none;
border: none;
    outline: 0 !important;
outline-style: none;
}

::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-size:16px;
	border: none;
    outline: 0 !important;
outline-style: none;
}
::-moz-placeholder { /* Firefox 19+ */
  font-size:16px;
}
:-ms-input-placeholder { /* IE 10+ */
 font-size:16px;
}
:-moz-placeholder { /* Firefox 18- */
  font-size:16px;
}

input {
  font-size:16px;
}

.shadow {
	border-color: #343642;
   -moz-box-shadow:    inset 0 0 10px 3px #888;
   -webkit-box-shadow: inset 0 0 10px 3px #888;
   box-shadow:         inset 0 0 10px 3px #888;
}

.shadow:focus {
box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  border: 1px solid #01b2a0;
box-shadow:         0px 0px 10px 3px #888;
}

.full-width {
	width: 25%;
}

.half-width {
	width: 6%;
}

input[type=submit] {
	padding: 13px 0;
    cursor: pointer;
    background: #01b2a0;
    color: #FFF;
    font-weight: bold;
    font-size: 20px;
    border: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
    appearance: none;
    margin-left: 10px;
    border-radius: 5px;
    position: relative;
    top: 2px;
}

.content {
    width: 100%;
    text-align: center;
	z-index: 3;
	position: absolute;
	top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}


</style>

<div class="bg">

<div class="layer">

	<div class="content">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" name="search">
		<h1>Search for Steam Games </h1>
		<input name="gamename" class="has-border has-padding full-width shadow" placeholder="Steam App ID or game name"></input>
		<input class="half-width btn-shadow" type="submit" name="submit" value="Search">
	</form>
	<p class="bottom-text" style="color: white">Type "List All Games" (case-sensitive) in search box for a full list of games </p>
	</div>
</div>
</div>

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

