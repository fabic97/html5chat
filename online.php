<?php

session_start();
if($_GET['q'] == "online"){
	if(isset($_SESSION["xulsmrd"]) && !empty($_SESSION["xulsmrd"])){
		require_once('inc/config.php');
		$online = "";
		$ergebnis = mysql_query("SELECT user FROM user WHERE state = 1");
		while($row = mysql_fetch_assoc($ergebnis)){
			$online .= "<li>".$row['user']."</li>";
		}
		echo "<ul>".$online."</ul>";
	}
}


?>