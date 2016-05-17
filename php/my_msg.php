<?php include 'header.php';?>
<?php include 'connect.php';?>

<style>

.inbox{
	background-color: white;
	width: 980px;
	height: 1000px;
	margin: auto;
	
}
.inbox-heading{
	color: #4C7637;
	font-family: cursive;
	position: relative;
	top: 20px;
	left: 50px;
	font-size: 50px;
	
}
.subject-top{
	display: inline;
	margin-left: 150px;
	font-weight: bold;
	font-family: cursive;
	
}
.from-top{
	display: inline;
	position: relative;
	left: 220px;
	font-weight: bold;
	font-family: cursive;
}
.at-top{
	display: inline;
	position: relative;
	left: 400px;
	font-weight: bold;
	font-family: cursive;
}
.delete-top{
	display: inline;
	position: relative;
	left: 500px;
	font-weight: bold;
	font-family: cursive;
}
.inbox-top{
	background-color: #999999;
	height: 30px;
	position: relative;
	top: 50px;
	font-size: 15px;
	padding: 5px;
	color: white;
	width: 900px;
	margin-left: 40px;
	
}
.messages{
	position: relative;
	top: 70px;
	left: 70px;
	width: 800px;
}
.subject{
	position: absolute;
	font-size: 20px;
	left: 50px;
}
.name{
	position: absolute;
	left: 400px;
}
.time{
	position: absolute;
	left: 560px;
}
.date_added{
	position: absolute;
	left: 650px;
}
.glyphicon-remove{
	position: absolute;
	left: 770px;
	font-size: 20px;
}
.msg-img{
	width: 45px;
	height: 45px;
	position: relative;
	left: 330px;
	top: -10px;
	margin-bottom: 5px;
}
.msg-tag{
	position: absolute;
	left: -10px;
}
.view-msg{
	color: black;
}
.view-msg:hover{
	color: red;
}
.left-bar{
	position: absolute;
	left: 1050px;
	top: 100px;
}
</style>

<div class="main-body" style = "background-color: #E4E8EB; position:relative; top:-20px;">
<div class = "left-bar">
<?php 
	include "left-sidebar.php";
?>
</div>
<?php

 	//check user exists
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
	

?>

<div class = "inbox" style="position: relative; left: -140px;">     
<h1 class = "inbox-heading">Inbox</h1>
<div class = "inbox-top">
<div class = "subject-top">
	<span class = "subject-text top-text">Subject</span>
</div>
<div class = "from-top">
	<span class = "from-text top-text">From</span>
</div>
<div class = "at-top">
	<span class = "at-text top-text">At</span>
</div>
<div class = "delete-top">
	<span class = "del-text top-text">Delete</span>
</div>
</div>


                    <?php
                    	$pageNumber = 1;
	                if (isset($_GET['page'])) {
				$pageNumber = $_GET['page'];
			}
			settype($pageNumber, "integer");
			$offset = ($pageNumber - 1) * 25;
			//$getposts = $conn->query("SELECT * FROM formalMessages WHERE user_to='$username' ORDER BY id DESC LIMIT 25 OFFSET $offset") or die(mysql_error());
			$getposts = $conn->query("SELECT * FROM msgVisibility WHERE username='$username' ORDER BY msgid DESC LIMIT 25 OFFSET $offset") or die(mysql_error());
			
			while ($rowVis = $getposts->fetch_assoc()) {
				$msgid = $rowVis['msgid'];
				$opened = $rowVis['opened'];
				$msgResult = $conn->query("SELECT * FROM formalMessages WHERE id='$msgid'");
				$row = $msgResult->fetch_assoc();
				$id = $row['id'];
				$body = $row['message'];
				$subject = $row['subject'];	
				$date_added = $row['date_added'];
				$added_by = $row['user_from'];
				$time = $row['time_added'];
				$username_posted_to = $row['user_to'];
				
				if($opened == 0){
					$msg = "<img src = '../img/openmessage.png' class = 'msg-mail'/>";
					$sub = "<b>$subject</b>";
				} else{
					$msg = "<img src = '../img/readmsg.png' class = 'msg-mail' />";
					$sub = "$subject";
				}
				
				$sql = "SELECT * FROM users WHERE username='$added_by'"; 
				$result = $conn->query($sql);
				$pic_row  = $result->fetch_assoc();
				$userpic =  $pic_row['profile_pic'];
				$userfirstname = $pic_row['first_name'];
				$userlastname = $pic_row['last_name'];
							
				echo " 
				
					
					<div class = 'messages'>
						
						<span class = 'msg-tag'>$msg</span>
						
						<a href = 'viewmessage.php?id=$id' class = 'view-msg'><span class = 'subject'>$sub</span></a>
						<div style = 'display: inline; position: relative;'>
						<img class = 'msg-img' src = '$userpic'></img>
						</div>
						<span class = 'name'>$userfirstname
						$userlastname</span>
						
						<span class = 'time'>$time,</span>
						<span class = 'date_added'> $date_added</span>
						
						<a class = 'glyphicon glyphicon-remove' href = 'del_msg.php?p=$id&u=$username' style = 'text-decoration: none;'></a>
					</div>
						
					
				";
				}
	                 ?>
</div>
</div>
</body>

</html>