<?php
if(isset($_POST['submit'])){
	echo "Now";
        $gamename = $_REQUEST["gamename"];
	echo $gamename;
        include_once 'db.php';
        global $db;
        if (gettype($gamename) == "string"){
                $q = "SELECT * FROM apps WHERE name LIKE \"%name\"";
        }else if (gettype($gamename) == "integer") {
                $q = "SELECT * FROM apps WHERE appid = $appid";
        }else{
                echo "Please specify a game name or app id from steam";
        }
/*
        $res = $db->query($q);

        while ($row =  $res->fetch_assoc() ){
                echo "{$row['appid']}";
        }
*/
}else{
	echo "submit is not set";
}
?>
