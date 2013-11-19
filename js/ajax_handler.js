var latestID = 0;
var newz = 0;
var sconv = "all";
function cleartitle(){
    newz = 0;
    document.getElementById("title").innerHTML = "Chat";
}
function setitle(number){
    if(latestID > 0){
        newz += number;
        document.getElementById("title").innerHTML = "Chat (" + newz + ")";
    }  
}
function changeconv(conv){
    document.getElementById("chatbox").innerHTML = "";
    latestID = 0;
    sconv = conv;
    getmsgs();
    jQuery(document).ready(function($){ 
        $('#sidebar').animate({ width: 'hide', duration: '1000'});
        $('#close').hide();
        $('#open').fadeIn('slow');
        $('#tabtitle').html("Chat");
    });
}
function getmsgs(){
    if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      getm = new XMLHttpRequest();
    }
    else if(window.ActiveXObject){
        try {
            getm = new ActiveXObject("Msxml2.XMLHTTP");
        } 
        catch(e) {
            try {
                getm = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                alert("Ihr Browser unterstützt dieses Programm leider nicht!");
            }
        }
        }
    getm.onreadystatechange = function(){
      if(getm.readyState == 4 && getm.status == 200){
            try{
                var result = eval('('+ getm.responseText +')');
                document.getElementById("chatbox").innerHTML += result.msg;
                setitle(result.newmsg);         
                $("#chatbox").animate({ scrollTop: $('#chatbox')[0].scrollHeight}, 1000);
                latestID = result.latestID;
                setTimeout("getmsgs();", 1000);
            }
            catch(e){
                setTimeout("getmsgs();", 1000);
            }
        }
    }
    string = document.getElementById("chatbox").innerHTML;
    getm.open("GET","load.php?id=" + latestID + "&conv=" + sconv, true);
    getm.send();
}
function sendmsg(){
    if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      sendm = new XMLHttpRequest();
    }
    else if(window.ActiveXObject){
        try {
            sendm = new ActiveXObject("Msxml2.XMLHTTP");
        } 
        catch(e) {
            try {
                sendm = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                alert("Ihr Browser unterstützt dieses Programm leider nicht!");
            }
        }
        }
    sendm.onreadystatechange = function(){
      if(sendm.readyState == 4 && sendm.status == 200){
            document.getElementById("msg").value = "";
            document.getElementById("chatbox").innerHTML += sendm.responseText;
            getmsgs();
        }
    }
    msg = document.getElementById("msg").value;
    var msgdata = new FormData();
    msgdata.append("msg", msg);
    msgdata.append("conv", sconv);
    sendm.open("POST", "send.php");
    sendm.send(msgdata);
}
function savenewpwd(){ //Speichert neues Passwort
    var saver = new XMLHttpRequest();
    var oldpwd = document.getElementById("oldpwd").value;
    var newpwd1 = document.getElementById("newpwd1").value;
    var newpwd2 = document.getElementById("newpwd2").value;
    saver.onreadystatechange = function(){
        if(saver.readyState == 4 && saver.status == 200){
            alert(saver.responseText);
        }
    }
    var formdata = new FormData(); 
    formdata.append("oldpwd", oldpwd);
    formdata.append("newpwd1", newpwd1); 
    formdata.append("newpwd2", newpwd2);  
    saver.open("POST", "editusrpref.php"); 
    saver.send(formdata);
}
function whoisonline(){
    if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
      wio = new XMLHttpRequest();
    }
    else if(window.ActiveXObject){
        try {
            wio = new ActiveXObject("Msxml2.XMLHTTP");
        } 
        catch(e) {
            try {
                wio = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                alert("Ihr Browser unterstützt dieses Programm leider nicht!");
            }
        }
        }
    wio.onreadystatechange = function(){
      if(wio.readyState == 4 && wio.status == 200){
            document.getElementById("onlinelist").innerHTML = wio.responseText;
        }
    }
    wio.open("GET","online.php?q=online", true);
    wio.send();
    document.getElementById("onlinelist").innerHTML = "<iframe src='css/spinner.html'/><span>Einen Moment bitte...</span>";
}