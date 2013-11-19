<?php 
session_start();
if(isset($_POST['submit'])){
	$usr = $_POST['usr'];
	$pwd1 = $_POST['pwd1'];
	$pwd2 = $_POST['pwd2'];
	$usrcrect = true;
	if(!empty($usr)){
		require_once('inc/config.php');
		$res = mysql_query("SELECT user FROM user");
		while($row = mysql_fetch_assoc($res)){
			if($usr == $row['user']){
				$usrcrect = false;
				$_SESSION['msg_login'] = "<span class=\"error\">Benutzername schon vorhanden!</span>";
			}
		}
	}
	if($usrcrect == true){
		if($pwd1 == $pwd2){
			$pwd = md5($pwd1);
			if(mysql_query("INSERT INTO user (id, user, password, datetime) VALUES (NULL, '".$usr."', '".$pwd."', '0000-00-00 00:00:00')")){
				$_SESSION['msg_login'] = "<span class=\"success\">Erfolgreich Eingetragen!</span>";
				echo '<meta http-equiv="refresh" content="0.5;./">';
			}
			else{
				$_SESSION['msg_login'] = "<span class=\"error\">Fehler beim Eintragen!</span>";
			}
		}
		else{
			$_SESSION['msg_login'] = "<span class=\"error\">Die Passwörter stimmen nicht überein!</span>";
		}
	}
}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width; initial-scale=1.0"/>
	<link href="css/style.css" rel="stylesheet" media="all"/>
</head>
<body>
	<form method="post" id="register">
	<span>Benutzername:</span><input type="text" name="usr" required="true"/><br/>
	<span>Passwort:</span><input type="password" name="pwd1" required="true"/><br/>
	<span>Passwortwiederholung:</span><input type="password" name="pwd2" required="true"/><br/>
	<input type="submit" name="submit" value="Eintragen"/>
	<?php
	if(isset($_SESSION['msg_login'])){
		$msg_login = $_SESSION['msg_login'];
		$_SESSION['msg_login'] = "";
	}
	else{
		$msg_login = "";
	}
	echo $msg_login; 
	?>
	</form>
</body>
</html>