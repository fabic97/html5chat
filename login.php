<?php
if(isset($_GET['lo'])){
	require_once('inc/config.php');
	$usr = $_SESSION["xulsmrd"];
	// Unset all of the session variables.
	$_SESSION = array();
	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if(isset($_COOKIE[session_name()])) {
	   setcookie(session_name(), '', time()-42000, '/');
	} 
	session_destroy();
	mysql_query("UPDATE user SET state = 0 WHERE user = '".$usr."'");
	echo '<meta http-equiv="refresh" content="0;./">';
}
if(isset($_POST['login'])){
	$usr = $_POST['usr'];
	$pwd =  md5($_POST['pwd']);
	if(checkusrdata($usr, $pwd)){
		$_SESSION["xulsmrd"] = $usr;
		$_SESSION["xplwmdd"] = $pwd;
		$_SESSION['msg_login'] = "<span class='success'>Erfolgreich Angemeldet!</span>";
		echo '<meta http-equiv="refresh" content="0">';
	}
	else{
		$_SESSION['msg_login'] = "<span class='error'>Fehlerhafte Anmeldedaten!</span>";
		displaylogin();
	}
}
elseif(isset($_SESSION["xulsmrd"])){
	if(isset($_SESSION["xplwmdd"])){
		$usr = $_SESSION["xulsmrd"];
		$pwd =  $_SESSION["xplwmdd"];
		if(checkusrdata($usr, $pwd)){
			displaychat();
		}
		else{
			$_SESSION['msg_login'] = "<span class='error'>Fehlerhafte Anmeldedaten!</span>";
			displaylogin();
		}
	}
	else{
		$_SESSION['msg_login'] = "<span class='error'>Fehlerhafte Anmeldedaten!</span>";
		displaylogin();
	}
}
else{
	displaylogin();
}

function checkusrdata($usr, $pwd){
	require_once('inc/config.php');
	$ergebnis = mysql_query("SELECT user FROM user"); //Suche nach Benutzer
	$ut = false;
	while($row = mysql_fetch_assoc($ergebnis)){
		if($usr == $row['user']){ //Wenn vorhanden, dann datachecken
			$ut = true;
			$ergebnis = mysql_query("SELECT * FROM user WHERE user = '".$usr."' LIMIT 1");
			$res = mysql_fetch_object($ergebnis);
			if($res->password == $pwd){
				if($res->datetime == "0000-00-00 00:00:00"){
						$datetime = date("Y-m-d H:i:s");
						mysql_query("UPDATE user SET datetime = '".$datetime."' WHERE id = ".$res->id);
						$_SESSION['latest'] = date("Y-m-d H:i:s");
						$_SESSION["lsid"] = $res->id;
				}
				else{
					$_SESSION['latest'] = $res->datetime;
				}
				mysql_query("UPDATE user SET state = 1 WHERE user = '".$usr."'");
				return true; //User Vorhanden, Passwort korrekt
			}
			else{
				return false;
			}
		}
	}
	if($ut !== true){
		return false;
	}
}

function displaylogin(){
	if(isset($_SESSION['msg_login'])){
		$msg_login = $_SESSION['msg_login'];
		$_SESSION['msg_login'] = "";
	}
	else{
		$msg_login = "";
	}
?>
	<body>
		<form method="POST" id="login">
		<span>Benutzername:</span><input type="text" name="usr"/><br/>
		<span>Passwort:</span><input type="password" name="pwd"/><br/>
		<input type="submit" name="login" value="Anmelden"><a href="register.php">Registrieren</a>
		<?php echo $msg_login; ?>
		</form>
	</body>
<?php
}
?>