<?php 
$servername = "localhost";
$username1 = "gogogoruuser";
$password = "gogogoruuser";
$dbname = "gogogoru";

// Create connection
$conn = new mysqli($servername, $username1, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>