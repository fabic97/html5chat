<?php
session_start();
if(isset($_POST['oldpwd']) && isset($_POST['newpwd1']) && isset($_POST['newpwd2'])){
	$usr = $_SESSION["xulsmrd"];
	if($_POST['newpwd1'] == $_POST['newpwd2']){ // Überprüfe, ob die neuen Passwörter übereinstimmen
		require_once('inc/config.php');
		$ergebnis = mysql_query("SELECT * FROM user WHERE user = '".$usr."' LIMIT 1");
		$row = mysql_fetch_object($ergebnis);
		if($row->password == md5($_POST['oldpwd'])){ // Überprüfe, ob das alte Passwort stimmt
			if(mysql_query("UPDATE user SET password = '".md5($_POST['newpwd2'])."' WHERE id = ".$row->id)){
				$_SESSION["xplwmdd"] = md5($_POST['newpwd2']);
				echo "Passwort erfolgreich geändert!";
			} //Setze neues Passwort
		}
		else{
			echo "Altes Passwort stimmt nicht!";
		}
	}
	else{
		echo "Passwörter stimmen nicht überein!";
	}
}

?>