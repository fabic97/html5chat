<?php
	session_start();
	$vulg = array(
					"scheiße", 
					"scheisse", 
					"shit", 
					"sex", 
					"s3x", 
					"6x",
					"fick",
					"fuck",  
					"gay", 
					"porn",
					"hate",
					"schwul",
					"behindert",
					"spast",
					"behindert",
					"hure",
					"hurensohn",
					"vulva",
					"vagina",
					"scheide",
					"penis",
					"muschi",
					"arsch",
					"8==",
					"wichser",
					"wixxer",
					"schwanz",
					"nutte",
					"spaten",
					"fotze",
					"inzest",
					"bitch"
				);
	if(isset($_SESSION["xulsmrd"]) && !empty($_SESSION["xulsmrd"])){
	    $usr = $_SESSION["xulsmrd"];
		if(!empty($_POST['msg'])){
			if(preg_match_all("/\S/", $_POST['msg'])){
				if(preg_match_all("/\bcmd\b:\S/", $_POST['msg'])){ //Anfang für eine Commandline
					$datetime = date("H:i");
					echo "<span class='time'>".$datetime."&nbsp;</span><span class='chattext'>".$_POST['msg']."</span><br/>";
				}
				else{
					require_once('inc/config.php');
					if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
						$client_ip = $_SERVER['REMOTE_ADDR'];
					}
					else {
						$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
					}
					$eintrag = $_POST['msg'];
					$eintrag = str_ireplace($vulg, "***", $eintrag);
					$date = date("Y-m-d H:i:s");
					$conv = $_POST['conv'];
					mysql_query("INSERT INTO chattext(chattext, user, datetime, ip, conv) VALUES('".$eintrag."' , '".$usr."', '".$date."', '".$client_ip."', '".$conv."')");
					mysql_close();
				}	
			}
		}
	}
?>