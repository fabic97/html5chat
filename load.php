<?php
	session_start();
	$zeichen = array(
					":)", 
					";)", 
					":D", 
					":/", 
					":(", 
					":O", 
					":P", 
					":*", 
					"<3", 
					"8)"
				);
	$img = array(
		"<img src=\"images/smile.png\" alt=\":)\">", 
		"<img src=\"images/wink.png\" alt=\";)\">", 
		"<img src=\"images/grin.png\" alt=\":D\">", 
		"<img src=\"images/unsure.png\" alt=\":/\">", 
		"<img src=\"images/frown.png\" alt=\":(\">", 
		"<img src=\"images/gasp.png\" alt=\":O\">", 
		"<img src=\"images/tongue.png\" alt=\":P\">",
		"<img src=\"images/kiss.png\" alt=\":*\">", 
		"<img src=\"images/heart.png\" alt=\"<3\">",
		"<img src=\"images/glasses.png\" alt=\"8)\">"
		);
	if(isset($_SESSION["xulsmrd"]) && !empty($_SESSION["xulsmrd"])){
		require_once('inc/config.php');
		$count = 0;
		$msg = '';
		$conv = $_GET['conv'];
		if($_GET['id'] == 0){
			$ergebnis = mysql_query("SELECT * FROM chattext WHERE datetime >'".$_SESSION['latest']."' AND conv = '".$conv."'");
			while($row = mysql_fetch_assoc($ergebnis)){
				$text = str_ireplace($zeichen, $img, $row['chattext']);
				$datetime = $row['datetime'];
				$datetime = explode(" ", $datetime);
				$datetime = explode(":", $datetime[1]);
				$datetime = $datetime[0].":".$datetime[1];
				$msg .= '<span class="time">'.$datetime.'&nbsp;</span><span class="user">'.$row['user'].':&nbsp;</span><span class="chattext">'.$text.'</span><br/>';
				$latestID = $row['id'];
				$count += 1;
			}
		}
		else{
			$id = $_GET['id'];
			$ergebnis = mysql_query("SELECT * FROM chattext WHERE id >'".$id."' AND conv = '".$conv."'");
			while($row = mysql_fetch_assoc($ergebnis)){
				$text = str_ireplace($zeichen, $img, $row['chattext']);
				$datetime = $row['datetime'];
				$datetime = explode(" ", $datetime);
				$datetime = explode(":", $datetime[1]);
				$datetime = $datetime[0].":".$datetime[1];
				$msg .= '<span class="time">'.$datetime.'&nbsp;</span><span class="user">'.$row['user'].':&nbsp;</span><span class="chattext">'.$text.'</span><br/>';
				$latestID = $row['id'];
				$count += 1;
			}
		}
		if($msg !== "" && $latestID !== ""){
			$result = array("msg" => $msg, "latestID" => $latestID, "newmsg" => $count);
	    	echo json_encode($result);
		}
	}
    mysql_close();
?>