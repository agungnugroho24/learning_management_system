<?php
$username=$_POST['username'];
if (!$username||$username=="Guest") $username="Guest".rand(1000,9999);
$r=$_POST['r'];

include_once("incsan.php");
sanV($r);
sanV($username);

setcookie("user_name",urlencode($username),time()+86400);
setcookie("room_name",urlencode($r),time()+86400);

$swfurl="2wvc.swf?room=" . urlencode($r);
$bgcolor="#fff";
$baseurl="";
$wmode="transparent";
?>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>LMS Perguruan Buddhi</title>
<style type="text/css">
<!--
BODY
{
margin:0px;
	background-color: #fff;
}

#2wayvideochat
{
width:100%;
height:700px;
	z-index:0;
	vertical-align: middle;
	text-align: center;
}
-->
</style>
<SCRIPT language="JavaScript">
//the code below allows activating certain functions from javascript
function getFlashMovie(movieName) {
	
   if (navigator.appName.indexOf("Microsoft") != -1) {
        //alert("IE");
        if (typeof (window[movieName].videowhisperToActionscript) == 'function') {
            // alert("< IE9");
            movie = window[movieName];
        }
        else if (typeof (document[movieName].videowhisperToActionscript) == 'function') {
            // alert(">= IE9");
            movie = document[movieName];
        }
    }
    else {
        // alert("NON IE");
        movie = document[movieName];
    }

    return movie;
}

//flash = flash html object name (ie "videowhisper_chat")
//action = next / snapshot / snapshot_self / buzz / p2p_toggle
function videowhisperCallActionscript(flash, action) 
{
    var movie = getFlashMovie(flash);
	if (movie == null || movie == undefined) window.alert("Flash element not found:" + flash + " :" + movie);
	else movie.videowhisperToActionscript(action);
}
</SCRIPT>
</head>
<BODY>
<CENTER>

<div id="2wayvideochat">

<object id="videowhisper_chat" width="1000" height="700" type="application/x-shockwave-flash" data="<?=$swfurl?>">
<param name="movie" value="<?=$swfurl?>" /><param name="bgcolor" value="<?=$bgcolor?>" /><param name="salign" value="lt" /><param name="scale" value="noscale" /><param name="allowFullScreen" value="true" /><param name="allowscriptaccess" value="always" /> <param name="base" value="<?=$baseurl?>" /> <param name="wmode" value="<?=$wmode?>" /> 
</object>

<noscript>
</noscript>

</div>
</CENTER>
</BODY>
</html>
