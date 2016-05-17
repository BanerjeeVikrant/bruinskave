<?php
include "header.php";
include "connect.php";
if (isset($_GET['u'])) {
	$u = $_GET['u'];
	$sql = "SELECT * FROM users WHERE username='$u'";
	$get = $conn->query($sql);
	$backto = $get->fetch_assoc();
	$goto =  $backto['activated'];
	$adminornot = $backto['admin'];
	
	if($adminornot == '1'){
		$admin = true;
	}else{
		$admin = false;
	}
	if(($admin) || ($username == $u)){
		$sql = "UPDATE users SET activated='1', account_closer='$username' WHERE username='$u'";
		$delete = $conn->query($sql);
	}
	
	echo "<script>location.assign('profile.php?u=$username')</script>";
}

?>