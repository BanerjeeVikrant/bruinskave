<?php
session_start();
session_destroy();
header("Location: /v2/socialnetwork/index.php");
?>