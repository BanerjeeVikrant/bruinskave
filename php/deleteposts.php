<?php
include "header.php";
include "connect.php";
if (isset($_GET['p'])) {
	$id = $_GET['p'];
	$sql = "SELECT * FROM posts WHERE id='$id'";
	$get = $conn->query($sql);
	$backto = $get->fetch_assoc();
	$goto =  $backto['user_posted_to'];
	$sql = "SELECT * FROM users WHERE username='$username'";
	$get = $conn->query($sql);
	$backto = $get->fetch_assoc();
	$adminornot = $backto['admin'];
	
	if($adminornot == '1'){
		$admin = true;
	}
	else{
		$admin = false;
	}
	
	
	if(($admin) || ($username == $goto)){
		$sql = "UPDATE posts SET hidden='1', hidden_by='$username' WHERE id='$id'";
		$delete = $conn->query($sql);
	}
	
	echo "<script>location.assign('profile.php?u=$goto#profilePosts')</script>";
}

?>