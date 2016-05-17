<?php
include "php/connect.php";
include "php/header.php";

$tags = array();

function identifyTagsInMsg($msg) {
	$tags = array();
	$msg_space = split(' ',$msg);
	for($i=0; $i < count($msg_space); $i++) {
	    $msg_comma = split(',',$msg_space[$i]);
	    for($j=0; $j < count($msg_comma); $j++) {
	    	    $new_msg_comma = $msg_comma[$j];
		    if (preg_match('/^http:/',$msg_comma[$j]) || preg_match('/^https:/',$msg_comma[$j])) {
		    	$new_msg_comma = "<a href=\'".$msg_comma[$j]."\'>".$msg_comma[$j]."</a>";
		    } else {
		    	$msg_dot = split('\.',$msg_comma[$j]);
			for($k=0; $k < count($msg_dot); $k++) {
				if (preg_match('/^\#/',$msg_dot[$k])) {
				    array_push($tags, $msg_dot[$k]);
				    $new_msg_dot = "<a class=\'msg-tag\' href=#>".$msg_dot[$k]."</a>";
				    //$new_msg_dot = "<a href=\'/v2/profile.php?u=ssdf\'>tag</a> start ".$msg_dot[$k];
				} elseif (preg_match('/^\@/',$msg_dot[$k])) {
				    $new_msg_dot = "<a href=\'/v2/socialnetwork/php/profile.php?u=".substr($msg_dot[$k],1)."\'>".$msg_dot[$k]."</a>";
				} else {
				    $new_msg_dot = $msg_dot[$k];
				}
				if ($k == 0) {
				    $new_msg_comma = $new_msg_dot;
				} else {
				    $new_msg_comma = $new_msg_comma.".".$new_msg_dot;
				}
			}
		    }
		    $msg_comma[$j] = $new_msg_comma;
	    }
	    $msg_space[$i] = join(',',$msg_comma);
	}
	$msg = join(' ',$msg_space);
	return $msg;
}

$post = identifyTagsInMsg($_POST['post']);
$to_user = $_POST['to'];

if($post != ""){
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$user_posted_to = $to_user;
	$time_added = date("h:i:sa");
	
	$sqlcommand = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '', '')";
	$query = $conn->query($sqlcommand) or die(mysql_error());
	
}else{
	echo "You must enter something before posting.";
}
?>