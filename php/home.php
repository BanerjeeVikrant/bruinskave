<?php
include "header.php";
if ($_SESSION["user_login"]) {
	echo "Hello, " . $_SESSION['user_login'];
} else {
	echo "\n<script>window.location.assign('/v2/socialnetwork/index.php'); </script>\n";
}

?>