<?php
include "header.php";
include "connect.php";
if (isset($_GET['p'])) {
	$id = $_GET['p'];
	$username = $_GET['u'];
	$sql = "DELETE FROM msgVisibility WHERE msgid='$id' AND username='$username'";
	$get = $conn->query($sql);
	
	echo "<script>location.assign('my_msg.php')</script>";
}

?>