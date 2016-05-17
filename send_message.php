<?php
include "php/connect.php";
include "php/header.php";



$post = $_POST['post'];
$to_user = $_POST['to'];

if($post != ""){
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$user_to = $to_user;
	$time_added = date("h:i:sa");
	
	$sqlcommand = "INSERT INTO posts VALUES ('', '$post', '$username', '$user_to', '$date_added', '$time_added')";
	$query = $conn->query($sqlcommand) or die(mysql_error());
	
}else{
	echo "You must enter something before posting.";
}
?>