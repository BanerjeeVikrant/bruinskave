<?php 
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}


?>
<!DOCTYPE html>

<html>
	<head>
		<title>TheBruinConnect</title>
		<!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">-->
		<link rel = "stylesheet" type = "text/css" href = "/v2/socialnetwork/css/style.css" />
		<script src = "/v2/socialnetwork/js/main.js"></script>
		<script src = "/v2/socialnetwork/js/jquery-dd.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="/v2/socialnetwork/css/dd.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
		<link href="https://cdn.rawgit.com/noelboss/featherlight/1.4.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />
	</head>
	<script type="text/javascript">
	/*
            function refreshPage () {
                var page_y = document.getElementsByTagName("body")[0].scrollTop;
                window.location.href = window.location.href.split('?')[0] + '?page_y=' + page_y;
            }
            window.onload = function () {
                setTimeout(refreshPage, 35000);
                if ( window.location.href.indexOf('page_y') != -1 ) {
                    var match = window.location.href.split('?')[1].split("&")[0].split("=");
                    document.getElementsByTagName("body")[0].scrollTop = match[1];
                }
            }
        */
        </script>
	<body onLoad="iFrameOn();">
		<div class = "top-heading">
			
				
					<img class = "logo" width = "50px" src = "/v2/socialnetwork/img/branham.png" alt = "logo"></img>
				
				
					<div class = "heading">BruinsKannect</div>
					<?php
						if($username){
							
						}else{
							echo '
							<div class = "top-options">
							
								<div class = "top-case top-volunteer"><a id = "volunteer-h" class = "top-links">&nbsp;Volunteer&nbsp;</a></div>
								<div class = "top-case top-sponsors"><a id = "sponsors-h" class = "top-links">&nbsp;Sponsors&nbsp;</a></div>
								<div class = "top-case top-privacy"><a id = "privacy-h" class = "top-links">&nbsp;Privacy&nbsp;</a></div>
								<div class = "top-case top-contact"><a id = "contact-h" class = "top-links">&nbsp;Contact&nbsp;</a></div>
								<div class = "top-case top-about"><a id = "about-h" class = "top-links">&nbsp;About&nbsp;</a></div>
							</div>
							';
						}
					?>
				
				
				
				
				<div class = "toplogin">
				<?php 
				if($username){
					echo '<a href = "/v2/socialnetwork/php/logout.php" class = "btn-login" id = "btn-login"><span class = "glyphicon glyphicon-lock"/> <b>Logout&nbsp;</b></a>';
				}else {
					echo '<a class = "btn-login" id = "btn-login"><span class = "glyphicon glyphicon-lock"/> <b>Login&nbsp;</b></a>';
				}
				?>
				
				</div>
				<div id = "heading-display">
				
				</div>
				
				    <script>
				    	var _0x8b2f=["\x74\x6F\x70","\x35\x30\x30\x70\x78","\x63\x73\x73","\x2E\x74\x6F\x70\x2D\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64","\x6C\x6F\x67\x69\x6E\x2D\x69\x6E\x64\x65\x78\x2E\x70\x68\x70","\x6C\x6F\x61\x64","\x23\x68\x65\x61\x64\x69\x6E\x67\x2D\x64\x69\x73\x70\x6C\x61\x79","\x63\x6C\x69\x63\x6B","\x23\x62\x74\x6E\x2D\x6C\x6F\x67\x69\x6E","\x72\x65\x61\x64\x79","\x62\x61\x63\x6B\x67\x72\x6F\x75\x6E\x64\x2D\x63\x6F\x6C\x6F\x72","\x23\x32\x36\x34\x38\x36\x37","\x2E\x74\x6F\x70\x2D\x76\x6F\x6C\x75\x6E\x74\x65\x65\x72","\x2E\x74\x6F\x70\x2D\x73\x70\x6F\x6E\x73\x6F\x72\x73","\x2E\x74\x6F\x70\x2D\x70\x72\x69\x76\x61\x63\x79","\x2E\x74\x6F\x70\x2D\x63\x6F\x6E\x74\x61\x63\x74","\x2E\x74\x6F\x70\x2D\x61\x62\x6F\x75\x74","\x2E\x74\x6F\x70\x6C\x6F\x67\x69\x6E","\x76\x6F\x6C\x75\x6E\x74\x65\x65\x72\x2D\x69\x6E\x64\x65\x78\x2E\x70\x68\x70","\x23\x32\x36\x32\x36\x32\x36","\x23\x76\x6F\x6C\x75\x6E\x74\x65\x65\x72\x2D\x68","\x73\x70\x6F\x6E\x73\x6F\x72\x73\x2D\x69\x6E\x64\x65\x78\x2E\x70\x68\x70","\x23\x73\x70\x6F\x6E\x73\x6F\x72\x73\x2D\x68","\x70\x72\x69\x76\x61\x63\x79\x2D\x69\x6E\x64\x65\x78\x2E\x70\x68\x70","\x23\x70\x72\x69\x76\x61\x63\x79\x2D\x68","\x63\x6F\x6E\x74\x61\x63\x74\x2D\x69\x6E\x64\x65\x78\x2E\x70\x68\x70","\x23\x63\x6F\x6E\x74\x61\x63\x74\x2D\x68","\x61\x62\x6F\x75\x74\x2D\x69\x6E\x64\x65\x78\x2E\x70\x68\x70","\x23\x61\x62\x6F\x75\x74\x2D\x68"];var v=false;var s=false;var p=false;var c=false;var a=false;var l=false;$(document)[_0x8b2f[9]](function(){$(_0x8b2f[8])[_0x8b2f[7]](function(){$(_0x8b2f[3])[_0x8b2f[2]](_0x8b2f[0],_0x8b2f[1]);$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[4])})});$(document)[_0x8b2f[9]](function(){$(_0x8b2f[20])[_0x8b2f[7]](function(){if(v){$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);v=false}else {if(s){$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);s=false}else {if(p){$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);p=false}else {if(c){$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);c=false}else {if(a){$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);a=false}else {if(l){$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);l=false}}}}}};v=true;$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[18]);$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[19])})});$(document)[_0x8b2f[9]](function(){$(_0x8b2f[22])[_0x8b2f[7]](function(){if(v){$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);v=false}else {if(s){$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);s=false}else {if(p){$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);p=false}else {if(c){$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);c=false}else {if(a){$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);a=false}else {if(l){$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);l=false}}}}}};s=true;$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[21]);$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[19])})});$(document)[_0x8b2f[9]](function(){$(_0x8b2f[24])[_0x8b2f[7]](function(){if(v){$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);v=false}else {if(s){$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);s=false}else {if(p){$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);p=false}else {if(c){$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);c=false}else {if(a){$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);a=false}else {if(l){$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);l=false}}}}}};p=true;$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[23]);$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[19])})});$(document)[_0x8b2f[9]](function(){$(_0x8b2f[26])[_0x8b2f[7]](function(){if(v){$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);v=false}else {if(s){$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);s=false}else {if(p){$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);p=false}else {if(c){$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);c=false}else {if(a){$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);a=false}else {if(l){$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);l=false}}}}}};c=true;$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[25]);$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[19])})});$(document)[_0x8b2f[9]](function(){$(_0x8b2f[28])[_0x8b2f[7]](function(){if(v){$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);v=false}else {if(s){$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);s=false}else {if(p){$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);p=false}else {if(c){$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);c=false}else {if(a){$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);a=false}else {if(l){$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);l=false}}}}}};a=true;$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[27]);$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[19])})});$(document)[_0x8b2f[9]](function(){$(_0x8b2f[8])[_0x8b2f[7]](function(){if(v){$(_0x8b2f[12])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);v=false}else {if(s){$(_0x8b2f[13])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);s=false}else {if(p){$(_0x8b2f[14])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);p=false}else {if(c){$(_0x8b2f[15])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);c=false}else {if(a){$(_0x8b2f[16])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);a=false}else {if(l){$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[11]);l=false}}}}}};l=true;$(_0x8b2f[6])[_0x8b2f[5]](_0x8b2f[4]);$(_0x8b2f[17])[_0x8b2f[2]](_0x8b2f[10],_0x8b2f[19])})})
				    </script>
			
		</div>