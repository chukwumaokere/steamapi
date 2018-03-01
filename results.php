<!DOCTYPE html>
<title>Pinots Steam API v1.0.0</title>
<head>
<link rel="stylesheet" href="results.css">
<!
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body class="bg">
<div id="contents">
	<div id="centerme">
	<div id="centeragain">
	<h1 style="color:white;">Searching for "<?php echo $_REQUEST["gamename"]; ?>"...</h1>
	<div id="container">
<?php
        $url = "http://store.steampowered.com/api/appdetails?appids=";
  //      echo "Now";
        $gamename = $_REQUEST["gamename"];
        //echo is_numeric($gamename) . "\n <br>";
        //echo var_dump($gamename) . "\n <br>";
        include_once 'db.php';
	if (isset($_GET['p'])){
                $p = $_GET['p'];
                $offset = ($p - 1) * 20;
		$pageno = $p;
	}
        global $db;
        if (is_numeric($gamename) == ''){
		$qcount = "SELECT count(*) FROM apps WHERE name LIKE \"%$gamename%\"";
			$resCount = $db->query($qcount);
		while ($row =  $resCount->fetch_assoc() ){
			$totalItems = $row['count(*)'];
			
		}
		$totalPages = ceil($totalItems / 20);
		if (isset($_GET['p'])){
			$q = "SELECT * FROM apps WHERE name LIKE \"%$gamename%\" LIMIT 20 OFFSET $offset";
		}else{
			$q = "SELECT * FROM apps WHERE name LIKE \"%$gamename%\" LIMIT 20 OFFSET 0";
			$pageno = 1;
		}
                if ($gamename == ''){
                        $q = '';
                        echo "Please Specify a game name or app id from Steam";
                }
                if ($gamename == 'List All Games' || $gamename == '*'){
//                        $q = "SELECT * FROM apps";
			$qcount = "SELECT count(*) FROM apps";
				$resCount = $db->query($qcount);
				while ($row =  $resCount->fetch_assoc() ){
		                        $totalItems = $row['count(*)'];
                		}
			$totalPages = ceil($totalItems / 20);
			if (isset($_GET['p'])){
        	                $q = "SELECT * FROM apps LIMIT 20 OFFSET $offset";
                	}else{
                        	$q = "SELECT * FROM apps LIMIT 20 OFFSET 0";
	                        $pageno = 1;
        	        }
                }
        }else if (is_numeric($gamename) == 1) {
                $q = "SELECT * FROM apps WHERE appid = $gamename";
		$pageno = 1;
		$totalPages = 1;
		$totalItems = 1;
        }
        else{
                //Need to put popup on main page.
		//Need to put hover info show 
                echo "Please specify a game name or app id from Steam";
        }

        $res = $db->query($q);

        while ($row =  $res->fetch_assoc() ){
                $appid = $row['appid'];
                $apiurl = $url . $appid;
                $json = file_get_contents($apiurl);

 //             echo "{$row['name']}\n <br>";

		$data = json_decode($json, true);
		$picture = $data[$appid]["data"]["header_image"];
		if ($picture){
			echo "<div class=\"griddy\"> <a href=\"http://store.steampowered.com/app/$appid/\"><img class=\"gametile\" src=\"$picture\" alt=\"{$row['name']}\" title=\"{$row['name']}\"></img></a></div>";
		}else{
			 echo "<div class=\"griddy\"> <a href=\"http://store.steampowered.com/app/$appid\"><img class=\"gametile not-avail\" src=\"./notavailableresz.png\" alt=\"{$row['name']}\" title=\"{$row['name']}\" ></img></a></div>";
		}
        }
	echo "</div>"; //container
	echo "</div>"; //centeragain
	echo "</div>"; //centerme
	if ($totalItems > 20){
		$nextpage = $pageno + 1;
		$prevpage = $pageno - 1;
		$lastp = $totalPages;
		$firstp = 1;
		if ($prevpage == 0){ 
			$firstpage = "This is the";
			$prevpageC = "First Page";
		}elseif ($prevpage > 0){
			$firstpage = "<a href=\"results.php?gamename=$gamename&p=$firstp\">First</a>";
			$prevpageC = "<a href=\"results.php?gamename=$gamename&p=$prevpage\">Prev</a>";
		}
		if ($nextpage <= $totalPages){
			$lastpage = "<a href=\"results.php?gamename=$gamename&p=$lastp\">Last</a>";
			$nextpageC = "<a href=\"results.php?gamename=$gamename&p=$nextpage\">Next</a>";
		}else{
			$lastpage = "";
			$nextpageC = "Last Page";
		}
		$pagination = "$firstpage $prevpageC - Page $pageno of $totalPages Page(s) for $totalItems Results - $nextpageC $lastpage";
	}else{
		$pagination = "Page $pageno of $totalPages Page(s) for $totalItems Result.";
	}
	echo "<div class=\"footer\">";
        echo $pagination;
	echo "</div>";

?>
</div>
</body>
</html>
