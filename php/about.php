<?php include 'header.php';?>
<?php include 'connect.php';?>
<?php
if (isset($_GET['u'])) {
	$uUser = $_GET['u'];
 	//check user exists
 	$sql = "SELECT * FROM users WHERE username='$uUser'";
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
	
}
?>
<style>


.main-body{
	background-color: #E4E8EB;
}
.boxinfo{
	color: white;
	font-weight: bold;
	padding: 15px;
	font-size: 18px;
}
.basicinfo-box{
	position: absolute;
	left:500px;
	top: 270px;
	width: 500px;
	min-height: 200px;
	background-color: #4f3317;
}
.basicinfo-inner-box{
	min-height: 180px;
	padding: 20px;
	border: 1px solid grey;
}
.word-heading{
	padding-right:5px;
	font-weight: bold;
}
.accountinfo-box{
	position: absolute;
	left:500px;
	top: 100px;
	width: 500px;
	min-height: 130px;
	background-color: #4f3317;
}
.accountinfo-inner-box{
	min-height: 120px;
	padding: 20px;
	border: 1px solid grey;
}
.moreinfo-box{
	position: absolute;
	left:500px;
	top: 500px;
	width: 500px;
  	min-height: 210px;
	background-color: #4f3317;
}
.moreinfo-inner-box{
	min-height:220px;
	padding: 20px;
	border: 1px solid grey;
}
.img-box{
	background-color: #4f3317;
	width: 300px;
	border: 1px solid grey;
	position: absolute;
	border-radius: 10px;
	top: 100px;
	left: 100px;
}
.profileimg{
	width: 298px;
}
.activity-box{
	background-color: #4f3317;
	width: 300px;
	border: 1px solid grey;
	position: absolute;
	top: 500px;
	left: 100px;
}
.activity-inner-box{
	padding: 10px;
}
.currently-box{
	background-color: #4f3317;
	width: 300px;
	border: 1px solid grey;
	position: absolute;
	top: 590px;
	left: 100px;
}
.currently-inner-box{
	padding: 10px;
}
.access-box{
	background-color: #4f3317;
	width: 300px;
	border: 1px solid grey;
	position: absolute;
	top: 678px;
	left: 100px;
}
.access-inner-box{
	padding: 10px;
}
.left-bar{
	position: absolute;
	left: 1050px;
	top: 100px;
	position: fixed;
}
    
</style>
<div class="main-body">
<div class = "left-bar">
<?php 
	include "left-sidebar.php";
?>
</div>
<div class = "accountinfo-box">
	<span class = "boxinfo">Account Info</span>
<div class = "accountinfo-inner-box" style = "background-color: white;">
	<div class = "name info-input"><span class = "word-heading">Name:</span> <span class = "ans"><?php echo $firstname . " " . $lastname; ?></span></div>
	<div class = "account"><span class = "word-heading">Member Since:</span> <span class = "ans"><?php echo $signupdate; ?></span></div>
	<div class = "grade"><span class = "word-heading">Currently: </span><span class = "ans"><?php echo $grade; ?></span></div>
</div>
</div>
<div class = "basicinfo-box">
	<span class = "boxinfo">Basic Info</span>
<div class = "basicinfo-inner-box" style = "background-color: white;">
	<div class = "email"><span class = "word-heading">Email: </span><span class = "ans"><?php echo $email ?></span></div>
      	<div class = "sex"><span class = "word-heading">Sex: </span><span class = "ans"><?php echo $sex; ?></span></div>
      	<div class = "yearof"><span class = "word-heading">Year of: </span><span class = "ans"><?php echo $yearof; ?></span></div>
      	<div class = "interests"><span class = "word-heading">Interests:</span> <span class = "ans"><?php echo $interests; ?></span></div>
      	<div class = "hates"><span class = "word-heading">Hates:</span> <span class = "ans"><?php echo $hates; ?></span></div>
      	<div class = "ms"><span class = "word-heading">Middle School:</span> <span class = "ans"><?php echo $midschool; ?></span></div>
      	<div class = "es"><span class = "word-heading">Elementary School: </span><span class = "ans"><?php echo $elemschool; ?></span></div>
</div>
</div>
<div class = "moreinfo-box">
	<span class = "boxinfo">More Info</span>
<div class = "moreinfo-inner-box" style = "background-color: white;">
	<div class = "username"><span class = "word-heading">Username: </span><span class = "ans"><?php echo $uUser; ?></span></div>
	<div class = "relationship"><span class = "word-heading">Relation Status:</span> <span class = "ans"><?php echo $relationship; ?></span></div>
	<div class = "interestedin"><span class = "word-heading">Interested In: </span><span class = "ans"><?php echo $interestedin; ?></span></div>
	<div class = "talent"><span class = "word-heading">Talent: </span><span class = "ans"><?php echo $talent; ?></span></div>
	<div class = "favquote"><span class = "word-heading">Favourite Quote:</span> <span class = "ans"><?php echo $favquote; ?></span></div>
	<div class = "dob"><span class = "word-heading">Date of Birth: </span><span class = "ans"><?php echo $dob; ?></span></div>
	<div class = "bio"><span class = "word-heading">Bio: </span><span class = "ans"><?php echo $bio; ?></span></div>
</div>
</div>

<div class = "img-box">
	<span class = "boxinfo"><?php echo $firstname; ?></span>
<div class = "img-inner-box" style = "background-color: white;">
	<img class = "profileimg" src="<?php echo $profilepic; ?>"></img>
</div>
</div>
<div class = "activity-box">
	<span class = "boxinfo">Activity</span>
	<div class = "activity-inner-box" style = "background-color: white;">
		Last activity 1 min ago.
	</div>
</div>
<div class = "currently-box">
	<span class = "boxinfo">Currently</span>
	<div class = "currently-inner-box" style = "background-color: white;">
		Currently online
	</div>
</div>
<div class = "access-box">
	<span class = "boxinfo">Access</span>
	<div class = "access-inner-box" style = "background-color: white;">
		Currently using From School
	</div>
</div>
</body>

</html>