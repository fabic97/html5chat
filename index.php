<?php
session_start();
?>
<html>
<head>
<title id="title">Chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width; initial-scale=1.0"/>
<link href="css/style.css" rel="stylesheet" media="all"/>
</head>
<?php 
require_once("login.php");
function displaychat(){ ?>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/ajax_handler.js"></script>
    <script type="text/javascript" src="js/jquery_control.js"></script>
    <body onload="getmsgs();" onFocus="cleartitle();">
    <header>
        <a id="closes" class="sidebar_control"><img src="images/comment.png" alt="Einstellungen" title="Einstellungen"></a>
        <a id="opens" class="sidebar_control"><img src="images/settings.png" alt="Chat" title="Chat"></a>
        <a id="closel" class="online_list"><img src="images/comment.png" alt="Chat" title="Chat"></a>
        <a id="openl" class="online_list"><img src="images/eye.png" alt="Online" title="Online"></a>
         <h1 id="tabtitle">Chat</h1>
    </header>
    <div id="sidebar">
        <fieldset><legend>Chat-Auswahl</legend>
            <ul id="chats">
                <li><a href="javascript:changeconv('all');">Komplette Klasse</a></li>
                <li><a href="javascript:changeconv('finish');">Fertig mit Aufgaben</a></li>
                <li><a href="javascript:changeconv('aufgaben');">Aufgabendiskussion</a></li>
            </ul>
        </fieldset>
        <fieldset><legend>Passwort Ändern</legend>
            <form>
                <span>Altes Passwort:</span><br/><input type="password" id="oldpwd"/><br/>
                <span>Neues Passwort:</span><br/><input type="password" id="newpwd1"/><br/>
                <span>Neues Passwort wiederholen:</span><br/><input type="password" id="newpwd2"/><br/>
                <input type="button" onClick="savenewpwd();" onFocus="cleartitle();" value="Speichern"/>
            </form>
        </fieldset>
        <fieldset><legend></legend>
             <a href="?lo" class="options">Abmelden</a>
        </fieldset>
    </div>
    <div id="onlinelist">
        
    </div>
    <div id="chatbox"></div>
    <form id="msg_form">
        <textarea id="msg" placeholder="Deine Nachricht..."></textarea>
        <input type="button" onClick="sendmsg();" value="">
    </form>    
    <script type="text/javascript">
    var px = window.innerHeight - 160;
    document.getElementById('chatbox').style.height = px;
    window.onresize = function(){
        var px = window.innerHeight - 160;
        document.getElementById('chatbox').style.height = px;
    }
    function pressed(key_value){
        var keycode = key_value.which;
        if(keycode == 13){
            sendmsg();
            return !(window.event && window.event.keyCode == 13);
        }
    }
    document.onkeydown = pressed;
    </script>
    </body>
<?php } ?>
</html>