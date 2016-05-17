<?php include 'header.php';?>
<?php include 'connect.php';?>
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM msgVisibility WHERE username='$username' AND msgid='$id'";
	$checkVisibility = $conn->query($sql);
	if ($checkVisibility->num_rows == 0) {
	    echo "No Message for you";
	    exit();
	} else {
	    $sql = "UPDATE msgVisibility SET opened=1 WHERE username='$username' AND msgid='$id'";
	    $conn->query($sql);
	}
	$sql = "SELECT * FROM formalMessages WHERE id='$id'";
	$get = $conn->query($sql);
	$backto = $get->fetch_assoc();
	$goto =  $backto['user_from'];
	$subject = $backto['subject'];
	$to_user = $backto['user_to'];
	$cc_user = $backto['user_cc'];
	$msg = $backto['message'];
	$date_added =  $backto['date_added'];
	$time_added =  $backto['time_added'];
	$sql = "SELECT * FROM users WHERE username='$goto'";
	$user = $conn->query($sql);
	$c = $user->fetch_assoc();
	$user_firstname =  $c['first_name'];
	$user_lastname =  $c['last_name'];
	
}

?>
<style>

.msg-body{
	background-color:white;
	width: 1000px;
	min-height: 600px;
	position: relative;
	top: 70px;
	margin: auto;
}
.sender-pic{
	position: absolute;
	top: 50px;
	left: 50px;
	max-height: 250px;
	max-width: 200px;
}
.name{
	font-size: 27px;
	font-family: verdana;
	position: absolute;
	top: 50px;
	left: 310px;
}
.grade{
	font-size: 27px;
	font-family: cursive;
	position: absolute;
	top: 86px;
	left: 310px;
}
.time{
	font-size: 20px;

	position: absolute;
	top: 130px;
	left: 420px;
}
.date{
	font-size: 20px;

	position: absolute;
	top: 130px;
	left: 310px;
}
.to_user{
	font-size: 20px;

	position: absolute;
	top: 170px;
	left: 310px;
}
.cc_user{
	font-size: 20px;

	position: absolute;
	top: 210px;
	left: 310px;
}
.subject{
	font-size: 40px;
	position: absolute;
	font-weight: bold;
	top: 320px;
	left: 50px;
	
}
.msg{
	font-size: 20px;
	position: absolute;
	top: 390px;
	left: 50px;
}
.btn-reply{
	position: absolute;
	top: 50px;
	left: 800px;
	width: 130px;
	font-size: 18px;
}
.left-bar{
	position: absolute;
	left: 1050px;
	top: 100px;
}
</style>

<div style = "background-color: #E4E8EB;">
<div class="main-body">
<div class = "left-bar">
<?php 
	include "left-sidebar.php";
?>
</div>
<?php

 	
 	$sql = "SELECT * FROM users WHERE username='$username'";
	$check = $conn->query($sql);
	if ($check->num_rows == 1) {
		$get = $check->fetch_assoc();
		$firstname = $get['first_name'];
		$lastname = $get['last_name'];
		$email = $get['email'];
		$grade = $get['grade'];
		if($grade == 9){
			$grade = "Freshman";
			$yearsleft = 3;
		}else if($grade == 10){
			$grade = "Sophomore";
			$yearsleft = 2;
		}else if($grade == 11){
			$grade = "Junior";
			$yearsleft = 1;
		}else if($grade == 12){
			$grade = "Senior";
			$yearsleft = 0;
		}
		$year = date("Y");
		$yearof = $year + $yearsleft;
		$signupdate= $get['sign_up_date'];
		$profilepic = $get['profile_pic'];
		$bio = $get['bio'];
		$sex = $get['sex'];
		$interests = $get['interests'];
		$dob = $get['dob'];
		$relationship = $get['relationship'];
		$interestedin = $get['interestedin'];
		$friends = $get['friend_array'];
		$midschool = $get['ms'];
		$elemschool = $get['es'];
		$talent = $get['talent'];
		$favquote = $get['favquote'];
		$hates = $get['hates'];
			
	} else {
		echo "ERROR 5718 NO USER FOUND";
		exit();
	}
	
	$sql = "SELECT * FROM users WHERE username='$goto'";
	$messengercheck = $conn->query($sql);
	if ($messengercheck->num_rows == 1) {
		$messengerget = $messengercheck->fetch_assoc();
		$messengerfirstname = $messengerget['first_name'];
		$messengerlastname = $messengerget['last_name'];
		$messengeremail = $messengerget['email'];
		$messengergrade = $messengerget['grade'];
		if($messengergrade == 9){
			$messengergrade = "Freshman";
			$messengeryearsleft = 3;
		}else if($messengergrade == 10){
			$messengergrade = "Sophomore";
			$messengeryearsleft = 2;
		}else if($messengergrade == 11){
			$messengergrade = "Junior";
			$messengeryearsleft = 1;
		}else if($messengergrade == 12){
			$messengergrade = "Senior";
			$messengeryearsleft = 0;
		}
		$messengeryear = date("Y");
		$messengeryearof = $messengeryear + $messengeryearsleft;
		$messengersignupdate= $messengerget['sign_up_date'];
		$messengerprofilepic = $messengerget['profile_pic'];
		$messengerbio = $messengerget['bio'];
		$messengersex = $messengerget['sex'];
		$messengerinterests = $messengerget['interests'];
		$messengerdob = $messengerget['dob'];
		$messengerrelationship = $messengerget['relationship'];
		$messengerinterestedin = $messengerget['interestedin'];
		$messengerfriends = $messengerget['friend_array'];
		$messengermidschool = $messengerget['ms'];
		$messengerelemschool = $messengerget['es'];
		$messengertalent = $messengerget['talent'];
		$messengerfavquote = $messengerget['favquote'];
		$messengerhates = $messengerget['hates'];
			
	} else {
		echo "ERROR 5718 NO USER FOUND";
		exit();
	}
	

?>
	<div class = "msg-body" style="position: relative; left: -150px;">
		<img src = "<?php echo $messengerprofilepic; ?>" class = "sender-pic"></img>
		
		<span class = "grade"><?php echo $messengergrade; ?></span>
		<span class = "name"><?php echo $user_firstname. " " .$user_lastname; ?></span>
		<span class = "date"><?php echo $date_added; ?></span>
		<span class = "time"><?php echo "@ " . $time_added; ?></span>
		
		<span class = "to_user"><?php echo "Send to: " . $to_user; ?></span>
		<span class = "cc_user"><?php echo "Copy of Message Send to: " . $cc_user; ?></span>
		
		<span class = "subject"><?php echo $subject; ?></span>
		
		<div class = "msg"><?php echo $msg; ?></div>
<?php		
echo '		<a class = "btn btn-warning btn-reply" href="message.php?u='.$goto.'&s='.$subject.'">Reply</a>';
?>
	</div>
</div>
</div>
        
</body>

</html>