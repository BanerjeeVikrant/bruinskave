<?php include 'php/header.php';?>
<?php include 'php/connect.php';?>
<?php
if ($_SERVER['HTTP_CLIENT_IP']!="") {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} 
else if ($_SERVER['HTTP_X_FORWARDED_FOR']!=""){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} 
else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
?>
<?php
$reg = @$_POST['reg'];
//declaring variables to prevent errors
$fn = ""; //First Name
$ln = ""; //Last Name
$un = ""; //Username
$em = ""; //Email
$em2 = ""; //Email 2
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$d = ""; // Sign up Date
$u_check = ""; // Check if username exists
//registration form
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$em2 = strip_tags(@$_POST['email2']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("Y-m-d"); // Year - Month - Day

        
if ($reg) {
	if ($em==$em2) {
		$result = $conn->query("SELECT username FROM users WHERE username='$un'");
		$check = $result->num_rows;
		$result = $conn->query("SELECT email FROM users WHERE email='$em'");
		$email_check = $result->num_rows;
		if ($check == 0) {
			if ($email_check == 0) {
				if ($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {
					if ($pswd==$pswd2) {
						if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
							echo "The maximum limit for username/first name/last name is 25 characters!";
						} else if (strlen($pswd)>30||strlen($pswd)<5) {
							echo "Your password must be between 5 and 30 characters long!";
						} else {	
							$pswd = md5($pswd);
							$pswd2 = md5($pswd2);
							$sql = "INSERT INTO users VALUES (NULL,'$un','$fn','$ln','$em','$pswd','$d','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'$ip')";
							$conn->query($sql);
						}
					} else {
						echo "Your passwords don't match!";
					}
				} else {
					echo "Please fill in all of the fields";
				}
			} else {
				echo "Sorry, but it looks like someone has already used that email!";
			}
		} else {
			echo "Username already taken ...";
		}
	} else {
		echo "Your E-mails don't match!";
	}
}

//Login

if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
	$user_login = $_POST["user_login"];
    	$password_login = $_POST["password_login"];
	$md5password_login = md5($password_login);
    	$result = $conn->query("SELECT id FROM users WHERE username='$user_login' AND password='$md5password_login' AND activated='0' LIMIT 1"); // query the person
	//Check for their existance
	$userCount = $result->num_rows; //Count the number of rows returned
	if ($userCount == 1) {
		$row = $result->fetch_assoc();
             	$id = $row["id"];
		$_SESSION["id"] = $id;
		$_SESSION["user_login"] = $user_login;
		$_SESSION["password_login"] = $password_login;

		//echo 'header("Location: http://www.gogogoru.com/v2/socialnetwork/php/home.php");';
         	
	} else {
		echo 'That information is incorrect, try again';
		exit();
	}
	
}
if ($_SESSION["user_login"]) {
	$updateIP = "UPDATE users SET ip='$ip' WHERE username='$user_login'";
	$changeIP = $conn->query($updateIP);
	echo "\n<script>window.location.assign('/v2/socialnetwork/php/home.php'); </script>\n";
}
?>
<style>
.login-section{
	height: 200px;
}
</style>
    <div class="main-body">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            	<div style = "position: relative;">
            	<div class = "top-background">
                	<h1 class = "bg-heading">Welcome to BruinsConect!</h1>
                	<p class = "bg-side">a Simple but Effective Social Network</p>
                	<p class = "info-connect">
                	
                	<b>You can use BruinConnect to:-</b>
                	<br>
                	
                	<span class = "connect-options">Search for people at your school </span><br>
                	<span class = "connect-options">Find out who has the same interests </span><br>
                	<span class = "connect-options">Look up your friends' friends</span><br>
                	<span class = "connect-options">Get a taste of your own Social Network</span><br>
                	
                	</p>
                </div>
                </div>
            </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
           	<div class = "trends-index">
           		<h2 class = "heading-trends-index">Trends</h2>
           		
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		<a href = "" class = "links-trends-index">#Hello</a><br>
           		
           	</div>
           </div> 
           <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"> 
           	<div class = "news-index">
           		
<?php

$getposts = $conn->query("SELECT * FROM posts WHERE news = '0' ORDER BY id DESC LIMIT 10") or die(mysql_error());

while ($row = $getposts->fetch_assoc()) {
	$id = $row['id'];
	$hidden = $row['hidden'];
	if($hidden == '1'){
		continue;
	}
	$body = $row['body'];	
	$date_added = $row['date_added'];
	$added_by = $row['added_by'];
	$time = $row['time_added'];
	$username_posted_to = $row['user_posted_to'];
	
	
	$sql = "SELECT profile_pic FROM users WHERE username='$added_by'"; 
	$result = $conn->query($sql);
	$pic_row  = $result->fetch_assoc();
	$userpic =  $pic_row['profile_pic'];
	if($admin || ($username == $profileUser)){
		$hide = "<a href = 'deleteposts.php?p=$id' class = 'glyphicon glyphicon-remove'></a>";
	}
				
	echo " 
		<div class = 'news-content-index'>
			<h3>$body</h3>	
			<img  class = 'news-img-index' src = '$userpic' />
			
		</div>
	";
	}
						
?>
           		
           	</div>
           </div> 
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            $(".signup-calling-btn").click(function() {
                $(".inner-side-body").load("signup-index.php");
            });
        });
    </script>
    </body>

    </html>