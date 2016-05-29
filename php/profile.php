<?php include 'header.php';?>
<?php include 'connect.php';?>
<script src="/bruinskave/js/main.js"></script>

<?php
if ($_SESSION['user_login']){
	$username = $_SESSION['user_login'];
	$adminCheck = $conn->query("SELECT admin FROM users WHERE username='$username'");
	$find = $adminCheck->fetch_assoc();
	$found = $find['admin'];
	if($found == '1'){
		$admin = true;
	}
	else{
		$admin = false;
	}
}else{
	echo "You need to <a href = '/bruinskave/'>Login</a>";
	exit();
}

if (isset($_GET['u'])) {
	$profileUser = $_GET['u'];
	if($profileUser == ""){
		echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/php/profile.php?u=$username\">";
	}
//check user exists
	$check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
	if ($check->num_rows == 1) {

		$get = $check->fetch_assoc();
		$activatedornot = $get['activated'];
		if($activatedornot == '1'){
			exit("ERROR 5718 No User exits. <a href = 'profile.php?u=$username'>Your profile</a>");
		}
		$adminornot = $get['admin'];
		if($adminornot == '1'){
			$adminProfile = true;
		}
		else{
			$adminProfile = false;
		}
		if(($adminProfile) && ($profileUser != "ssdf")){
			$staff = true;
		}
		else{
			$staff = false;
		}
		$firstname = $get['first_name'];
		$grade = $get['grade'];
		if($grade == 9){
			$grade = "Freshman";
		}else if($grade == 10){
			$grade = "Sophomore";
		}else if($grade == 11){
			$grade = "Junior";
		}else if($grade == 12){
			$grade = "Senior";
		}
		$lastname = $get['last_name'];
		$email = $get['email'];
		$signupdate= $get['sign_up_date'];
		$profilepic = $get['profile_pic'];
		$bio = $get['bio'];
		$sex = $get['sex'];
		$interests = $get['interests'];
		$dob = $get['dob'];
		$friends = $get['friend_array'];
		$hates = $get['hates'];
	} else {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/index.php\">";
		exit();
	}

}

if($profileUser == ""){
	echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/php/profile.php?u=$username\">";
}
if (isset($_POST['addfriend'])) {
	$friendRequest = $_POST['addfriend'];

	$user_to = $profileUser;
	$user_from = $username;

	$sql = "";

	$insert = $conn->query("INSERT INTO friend_requests VALUES ('', '$user_from', '$user_to')");
}
if (isset($_POST['sayhi'])) {
	$sayhi = $_POST['sayhi'];
	$hi = $conn->query("SELECT * FROM sayhi WHERE user_from=$username AND user_to=$profileUser");
	if ($hi->num_rows == 0) {
		$conn->query("INSERT INTO sayhi VALUES ('', '$username', '$profileUser', '0')");
	}
}
$yourcheck = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($yourcheck->num_rows == 1) {

	$yourget = $yourcheck->fetch_assoc();
	$youractivatedornot = $yourget['activated'];
	if($youractivatedornot == '1'){
		exit("ERROR 5718 No User exits. <a href = 'profile.php?u=$username'>Your profile</a>");
	}
	$youradminornot = $yourget['admin'];
	if($adminornot == '1'){
		$adminProfile = true;
	}
	else{
		$adminProfile = false;
	}
	if(($adminProfile) && ($profileUser != "ssdf")){
		$staff = true;
	}
	else{
		$staff = false;
	}
	$firstname = $get['first_name'];
	$grade = $get['grade'];
	if($grade == 9){
		$grade = "Freshman";
	}else if($grade == 10){
		$grade = "Sophomore";
	}else if($grade == 11){
		$grade = "Junior";
	}else if($grade == 12){
		$grade = "Senior";
	}
	$lastname = $get['last_name'];
	$email = $get['email'];
	$signupdate= $get['sign_up_date'];
	$profilepic = $get['profile_pic'];
	$bio = $get['bio'];
	$sex = $get['sex'];
	$interests = $get['interests'];
	$dob = $get['dob'];
	$friends = $get['friend_array'];
	$hates = $get['hates'];
}

?>
<?php 
/*if($profileUser == $_SESSION['user_login']){
echo ' (This is you!)';
}
echo $ip;*/
?>
<?php 
$sql = "SELECT * FROM friend_requests WHERE user_from='$username'&&user_to='$profileUser'";
$selectFriendRequest = $conn->query("SELECT * FROM friend_requests WHERE user_from='$username'&&user_to='$profileUser'");

/* if($admin || $profileUser == $username){
echo "<a href = 'deletemem.php?u=$profileUser' class = 'btn btn-danger'>Delete Profile</a>"; 
}*/
if($username){

	$friendsArray = "";
	$countFriends = 0;
	$friendsArray12 = "";
	$addAsFriend = "";
	$sql = "SELECT friend_array FROM users WHERE username='$profileUser'";
	$selectFriendsQuery = $conn->query($sql);
	$friendRow = $selectFriendsQuery->fetch_assoc();
	$friendString = $friendRow['friend_array'];
	$friendArray = [];
	$countFriends = 0;

	if ($friendString != "") {
		$friendArray = explode(",",$friendString);
		$countFriends = count($friendArray);
	}
	$friendArray12 = array_slice($friendArray, 0, 9);

	$i = 0;
	if (in_array($username,$friendArray)) {
		$addAsFriend = '<form class = "profile-options" method = "POST" action = "#"><input class = "btn btn-info " type="submit" name="removefriend" value="UnFriend"></form>';
	} else {
		$addAsFriend = '';
		if ($username != $profileUser && $selectFriendRequest->num_rows == 0) {
			$addAsFriend = '<form class = "profile-options" method = "POST" action = "#"><input class = "btn btn-info " type="submit" name="addfriend" value="Add Friend"></form>';
		}	
	}

	if (@$_POST['removefriend']) {
//Friend array for logged in user
		$add_friend_check = $conn->query("SELECT friend_array FROM users WHERE username='$profileUser'");
		$get_friend_row = $add_friend_check->fetch_assoc();
		$friend_array = $get_friend_row['friend_array'];
		$friend_array_explode = explode(",",$friend_array);
		$friend_array_count = count($friend_array_explode);
		$friend_array1 = []; $j = 0;
		for ($i=0; $i < $friend_array_count; $i++) {
			if ($friend_array_explode[$i] != $username) {
				$friend_array1[$j++] = $friend_array_explode[$i];
			}
		}
		$friend1 = join(',',$friend_array1);

//Friend array for user who owns profile
		$add_friend_check_username = $conn->query("SELECT friend_array FROM users WHERE username='$username'");
		$get_friend_row_username = $add_friend_check_username->fetch_assoc();
		$friend_array_username = $get_friend_row_username['friend_array'];
		$friend_array_explode_username = explode(",",$friend_array_username);
		$friend_array_count_username = count($friend_array_explode_username);
		$friend_array2 = []; $j = 0;
		for ($i=0; $i < $friend_array_count_username ; $i++) {
			if ($friend_array_explode_username[$i] != $profileUser) {
				$friend_array2[$j++] = $friend_array_explode_username[$i];
			}
		}
		$friend2 = join(',',$friend_array2);


		$sql = "UPDATE users SET friend_array='$friend1' WHERE username='$profileUser'";
//echo $sql;
		$removeFriendQuery = $conn->query($sql);
		$sql = "UPDATE users SET friend_array='$friend2' WHERE username='$username'";
//echo $sq
		$removeFriendQuery_username = $conn->query("$sql");
		echo "Friend Removed ...";
	}
}
/* //if($selectFriendRequest->num_rows == 1){
$msgtouser = 'You have a Pending friend Request to ' . $firstname. '. ' . 'Click to <a href = "#">Send Message</a>';
$alertAbout = 'alert-info';
}*/

?>
<style>

	.main-body{
		width: 850px;
		position: relative;
		left: 10%;
	}
	.full-body {
		width:100%;
		background-color: #e2e8eb;
	}

	.banner-img{
		width: 850px;
		height: 200px;
		margin-top: 0px;
		z-index: 99;

	}
	.profilepic{
		max-height: 180px;
		min-height: 100px;
		width: 150px;
		position: absolute;
		top: -150px;
		left: 50px;
		border: 1px solid white;
	}
	.user-name{
		position: absolute;
		top: -120px;
		left: 270px;
		z-index: 999;
		color: white;
	}
	.profile-options{
		display: inline;
	}
	.profileOptions{
		position: relative;
		top: 35px;
	}
	.intro{
		width: 300px;
		background-color: white;
		padding: 20px;
		position: absolute;
		top: 380px;
		border: 1px solid #f1f1f1;
		box-shadow: 1px 1px 4px #A79696;

	}
	.friends{
		width: 300px;
		height: 300px;
		padding: 5px;
		position: absolute;
		top: 60px;
		border: 1px solid #f1f1f1;
		box-shadow: 1px 1px 4px #A79696;
		background-color: white;

	}
	.profile-options{
		display: inline;

	}
	.profile-options:hover{
		text-decoration: none;
		color: grey;
	}
	.profileOptions{
		position: relative;
		top: 35px;
	}
	.msg-options-box{
		width: 269px;
		height: 50px;
		background-color: #cccccc;
		position: relative;
		left: 340px;
		top: -310px;
		font-size: 16px;
		padding: 10px;
		color: grey;
		border: 1px solid grey;

	}
	.msg-options{
		margin-right: 18px;
		text-decoration: none !important;
		color: black;


	}
	.msg-options:hover{
		color: black;
	}
	.status-box{
		position: relative;
		top: -10px;
		left: -10px;
		height: 50px;
		width: 90px;
		padding: 14px;
		padding-left: 22px;
		background-color: white;
		border: 1px solid grey;
	}
	.photo-box{
		position: relative;
		top: -60px;
		left: 79px;
		height: 50px;
		width: 90px;
		padding: 14px;
		padding-left: 22px;
		border: 1px solid grey;
	}
	.videos-box{
		position: relative;
		top: -110px;
		left: 168px;
		height: 50px;
		width: 90px;
		padding: 14px;
		padding-left: 22px;
		border: 1px solid grey;
	}
	#post{

		width:500px; 
		height:100px;
		background-color: white;
		position: relative;
		top: -111px;
		left: -11px;
		resize: none;
		color: black;
		padding: 8px;
		font-family: Verdana;
		box-shadow: 1px 1px 4px #A79696;
	}
	#after-msg-box{
		position: relative;
		top: -111px;
		left: -11px;
	}
	.option{
		background-color: white;
		height: 60px;
		width: 230px;
		padding: 10px;
		border: 1px solid grey;
		position: relative;
		top: 5px;
		left: 16px;
		z-index:20;
	}
	.option-sel{
		background-color: #777777;
		color: white;
		height: 40px;
		width: 210px;
		padding: 10px;
		border: 3px;
		position: relative;
		top: -1px;
		font-weight: bold;
	}
	.share-btn{
		background-color: #99ccff;
		color: white;
		height: 41px;
		width: 130px;
		font-size: 20px;
		font-family: verdana;
		border: 1px solid black;
		position: absolute;
		top: -2px;
		left: 369px;
		box-shadow: 1px 1px 4px #A79696;
	}
	#privacy-area{
		background-color: #dddddd;
		height: 40px;
		width: 500px;
		position: relative;
		top: -6px;
		border: 1px solid black;
	}
	#sel-public:hover{
		background-color: #0066cc;
		color: #f2f4f6;
	}
	#sel-f:hover{
		background-color: #0066cc;
		color: #f2f4f6;
	}
	#sel-fof:hover{
		background-color: #0066cc;
		color: #f2f4f6;
	}
	.drop-gly{
		position: absolute;
		top: -15px;
		top: 12px;
		left: 175px;
		color: white;
	}
	.drop-helper{
		position: absolute;
		top: 32px;
		left: 10px;
		color: #777;
	}
	.profile-post{
		background-color: white;
		position: relative;
		top: -120px;
		width: 500px;
		left: 340px;
		padding: 20px;
		margin-bottom: 15px;
		/*border: 1px solid #AAAAAA;*/
		box-shadow: 1px 1px 4px #A79696;
	}
	.posted-by-img{
		width: 50px;
		height: 50px;
		border-radius: 45px;
	}
	.samepostedby{
		margin: 10px;
		position: relative;
		top: -6px;
		font-size: 16px;
		text-decoration: none !important;
		color: black;
	}
	.posted-by-name{
		margin: 10px;
		position: relative;
		top: -6px;
		font-size: 16px;
		text-decoration: none !important;
		color: black;
	}
	.posted-to-name{
		margin: 10px;
		position: relative;
		top: -6px;
		font-size: 16px;
		text-decoration: none !important;
		color: black;
	}
	.arrow{
		margin: 5px;
		position: relative;
		top: -4px;
		font-size: 16px;
	}
	.time{
		position: relative;
		top: -20px;
		left: 63px;
	}
	.comment-inputs{
		width: 450px;
		height: 50px;
		position: relative;
		top: -135px;
		left: 390px;
		border: 0;
		padding-left: 15px;
		font-size: 15px;
		background-color: #fcfcfc;
		outline-width: 0;
		box-shadow: 1px 1px 2px #A79696;
		font-family: Verdana;
	}
	.comment-input-pic{
		width: 50px;
		height: 50px;
		position: absolute;
		top: -135px;
		left: 340px;
		box-shadow: 1px 1px 2px #A79696;
	}	
	.comment-body{
		background-color: #f9f9f9;
		width: 500px;
		position: relative;
		top: -135px;
		left: 340px;


		box-shadow: 1px 1px 2px #A79696;
	}
	.comments-img{
		width: 50px;
		height: 50px;
		padding: 5px;
		position: relative;
		top: 3px;
		left: 10px;
		border-radius: 45px;
	}
	.commentPosted{
		padding-left: 10px;
		font-size: 13px;
		margin-top: -13px;
		position: relative;
		top: 18px;
	}
	.comment-area{
		width: 400px;
		position: relative;
		left:60px;
		top: -35px;
	}
	.post-privacy-info{
		color: #bbbbbb;

		font-size: 11px;
		position: absolute;
		top: 35px;
		left: 60px;
	}
	.photoOrVideo{
		z-index: 1;
		width: 500px;
		position: relative;
		top: -117px;
		left: -11px;

		background-color: #444444;
	}
	.photoFile{
		padding: 15px;
		color: white;
		font-size: 18px;

	}
	.photo-link{
		color: white;
		padding: 15px;
		padding-right: 3px;;
	}
	.photoLinkInput{
		width: 400px;
		margin-bottom: 15px;
		padding-left: 10px;
		border-radius: 90px;
		border: 1px solid white;
		color: black;
	}
	.photoLinkInput:focus{
		background-color: #555555;
		color: white;
		border-radius: 5px;
	}
	.videoFile{
		padding: 15px;
		color: white;
		font-size: 18px;
	}
	.video-link{
		color: white;
		padding: 15px;
		padding-right: 3px;;
	}
	.videoLinkInput{
		width: 350px;
		margin-bottom: 15px;
		padding-left: 10px;
		border-radius: 90px;
		border: 1px solid white;
		color: black;
	}
	.videoLinkInput:focus{
		background-color: #555555;
		color: white;
		border-radius: 5px;
	}
	.video-info{
		position: absolute;
		top: 20px;
		right: 50px;
		color: white;
	}
	.posted-pic{
		max-height: 500px;
		max-width: 450px;
	}
	.left-bar{
		position: absolute;
		left: 890px;
		top: 100px;

	}
	.btn-options{
		margin: 4px;
		margin-left:  10px;

	}
</style>



<div id="username" style="display:none"><?php echo $profileUser; ?></div>
<div class="full-body">
	<div class="main-body">
		<div class = "left-bar">
			<?php

			include "left-sidebar.php";

			?>
		</div>
		<img src = "http://www.limocart.com/img/banner_img3.jpg" class = "banner-img" />
		<div style = "position: relative;">
			<img src = "<?php echo $profilepic; ?>" class = "profilepic" />
		</div>
		<div style = "position: relative;">
			<h2 class = "user-name"><?php echo $firstname."<br>".$lastname; ?></h2>
		</div>
		<div class = "profileOptions">
			<?php echo $addAsFriend; ?><br>
			<img src = "../img/business.png"></img><input class = "btn btn-primary btn-options" onclick = "location.href='about.php?u=<?php echo $profileUser ?>'" type="submit" value="About <?php echo $firstname; ?>"><br>
			<form class = "profile-options" method = "POST" action = "profile.php?u=$profileUser"><img src = "../img/people.png"></img><input class = "btn btn-primary btn-options" type="submit" value="Invite to Join My Group"></form><br>
			<form class = "profile-options" method = "POST" action = "message.php?u=<?php echo $profileUser ?>"><img src = "../img/web.png"></img><input name = "message" class = "btn btn-primary btn-options" type="submit" value="Send Message"></form><br>

			<form class = "profile-options" method = "POST" action = "#"><img src = "../img/interface.png"></img><input class = "btn btn-primary btn-options" type="submit"  value="Open Chatbox"></form><br>
			<!--<form class = "profile-options" method = "POST" action = "#"><img src = "../img/cup.png"></img><input class = "btn btn-primary btn-options" type="submit" value="Give a Trophy"></form><br>-->
			<form class = "profile-options" method = "POST" action = "#"><img src = "../img/social-media.png"></img><input class = "btn btn-primary btn-options" type="submit"  value="Follow <?php echo $firstname; ?>"></form><br>
			<form class = "profile-options" method = "POST" action = "photos.php?u=<?php echo $profileUser ?>"><img src = "../img/photo.png"></img><input class = "btn btn-primary btn-options" type="submit"  value="View Photos"></form><br>
			<form class = "profile-options" method = "POST" action = "#"><img src = "../img/articles.png"></img><input class = "btn btn-primary btn-options" type="submit"  value="View Articles"><br></form>
			<form class = "profile-options" method = "POST" action = "#"><img src = "../img/hi.png"></img><input class = "btn btn-primary btn-options" type="submit" name = "sayhi" value="Say Hi!"></form><br>
		</div>

		<div style = "position: relative;">
			<div class = "friends">
				<b>Friends</b>
				<div class="friends-list"> 

					<?php
					if ($countFriends != 0) {
						foreach ($friendArray12 as $value) {
							$i++;
							$getFriendQuery = $conn->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
							$getFriendRow = $getFriendQuery->fetch_assoc();
							$friendUsername = $getFriendRow['username'];
							$friendProfilePic = $getFriendRow['profile_pic'];

							if ($friendProfilePic == "") {
								echo "<a href='profile.php?u=$friendUsername'><img src='https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg' height='85' width='85' style='margin-right: 10px; margin-bottom: 5px;'></a>";
							}
							else{
								echo "<a href='profile.php?u=$friendUsername'><img src='$friendProfilePic' height='85' width='85' style='margin-right: 10px; margin-bottom: 5px;'></a>";
							}
						}
					}else{
						echo $profileUser. " has no friends yet.";
					}

/*if (($_POST['post']) || ($_POST['post'] && isset($_FILES['pictureUpload'])) || ($_POST['post'] && isset($_FILES['videoUpload']))){
$textPosted = $_POST['post'];
if (((@$_FILES["pictureUpload"]["type"]=="image/jpeg") || (@$_FILES["pictureUpload"]["type"]=="image/png") || (@$_FILES["pictureUpload"]["type"]=="image/gif"))&&(@$_FILES["pictureUpload"]["size"] < 10485760)) {

$rand_dir_name = $username;


if (file_exists("../userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"])){
move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"../userdata/profile_pics/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
$profile_pic_name = @$_FILES["pictureUpload"]["name"];
$sql = "UPDATE users SET profile_pic='/bruinskave../userdata/profile_pics/$rand_dir_name/$profile_pic_name' WHERE username='$username'";

$profile_pic_query = $conn->query($sql);
}
else{
mkdir("../userdata/profile_pics/$rand_dir_name");
move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"../userdata/profile_pics/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
$profile_pic_name = @$_FILES["pictureUpload"]["name"];
$sql = "UPDATE users SET profile_pic='/bruinskave../userdata/profile_pics/$rand_dir_name/$profile_pic_name' WHERE username='$username'";

$profile_pic_query = $conn->query($sql);
}
}*/
if (isset($_POST['post'])) {
	$post = @$_POST['post'];
	if($post != ""){
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$added_by = $username;
		$user_posted_to = $profileUser;
		$time_added = date("h:i:sa");

		$sqlcommand = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '', '', '')";
		$query = $conn->query($sqlcommand) or die(mysql_error());

	}
}
if (isset($_FILES['pictureUpload'])) {
	$post = '';
	$post = $_POST['photopost'];
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$user_posted_to = $profileUser;
	$time_added = date("h:i:sa");


	if (((@$_FILES["pictureUpload"]["type"]=="image/jpeg") || (@$_FILES["pictureUpload"]["type"]=="image/png") || (@$_FILES["pictureUpload"]["type"]=="image/gif"))&&(@$_FILES["pictureUpload"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("../userdata/albums/$rand_dir_name/".@$_FILES["pictureUpload"]["name"])){

			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"../userdata/albums/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '/bruinskave../userdata/albums/$rand_dir_name/$profile_pic_name', '', '')";
			$profile_pic_query = $conn->query($sql);
		}

		else {

			mkdir("../userdata/albums/$rand_dir_name");
			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"../userdata/albums/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '/bruinskave../userdata/albums/$rand_dir_name/$profile_pic_name', '', '')";

			$profile_pic_query = $conn->query($sql);
		}


	}
}
if(isset($_POST['photolink'])){

	$post = '';
	$post = @$_POST['photopost'];
	$photolink = $_POST['photolink'];

	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$user_posted_to = $profileUser;
	$time_added = date("h:i:sa");

	$sqlcommand = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '$photolink', '', '')";
	$query = $conn->query($sqlcommand) or die(mysql_error());


}
if (isset($_FILES['videoUpload'])) {
	$post = $_POST['videopost'];
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$user_posted_to = $profileUser;
	$time_added = date("h:i:sa");


	if (((@$_FILES["videoUpload"]["type"]=="video/mp4") || (@$_FILES["videoUpload"]["type"]=="video/webm") || (@$_FILES["videoUpload"]["type"]=="video/ogg"))&&(@$_FILES["videoUpload"]["size"] < 10485760)) {
		$rand_dir_name = $username;


		if (file_exists("../userdata/videos/$rand_dir_name/".@$_FILES["videoUpload"]["name"])){
			move_uploaded_file(@$_FILES["videoUpload"]["tmp_name"],"../userdata/videos/$rand_dir_name/".$_FILES["videoUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["videoUpload"]["name"];
			$profile_pic_name = @$_FILES["videoUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '', '/bruinskave../userdata/videos/$rand_dir_name/$profile_pic_name', '')";
			$profile_pic_query = $conn->query($sql);
		} else {
			mkdir("../userdata/videos/$rand_dir_name");
			move_uploaded_file(@$_FILES["videoUpload"]["tmp_name"],"../userdata/videos/$rand_dir_name/".$_FILES["videoUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["videoUpload"]["name"];
			$profile_pic_name = @$_FILES["videoUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '', '/bruinskave../userdata/videos/$rand_dir_name/$profile_pic_name', '')";

			$profile_pic_query = $conn->query($sql);
		}
	}
}
if(isset($_POST['videolink'])){

	$post = '';
	$post = @$_POST['videopost'];
	$url = $_POST['videolink'];
	$url_parts = split('[\?\&]',$url);
	$v_parts = split('\=',$url_parts[1]);
	$video_code = $v_parts[1];
	$videolink = "https://www.youtube.com/embed/$video_code";
	if($url != '' || $url != NULL) {
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$added_by = $username;
		$user_posted_to = $profileUser;
		$time_added = date("h:i:sa");

		$sqlcommand = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$added_by', '$user_posted_to', '$time_added', '0', 'user', '', '', '', '', '', '$videolink')";
		$query = $conn->query($sqlcommand) or die(mysql_error());
	}

}
?>
</div>
</div>
</div>
<div style = "position: relative;">
	<div class = "intro">
		<h3>Intro</h3>
		<div class="aboutme">
			<p><strong>Bio:</strong>
				<?php echo $bio ?>
			</p>
			<p><strong>Joined:</strong>
				<?php echo $signupdate ?>
			</p>
			<p><strong>Gender:</strong>
				<?php echo $sex ?>
			</p>
			<p><strong>Interests:</strong>
				<?php echo $interests ?>
			</p>
			<p><strong>Hates:</strong>
				<?php echo $hates ?>
			</p>
			<p><strong>Date of Birth:</strong>
				<?php echo $dob ?>
			</p>
		</div>
	</div>
</div>
<div style = "position: relative;">
	<div class = "intro">
		<h3>Intro</h3>
		<div class="aboutme">
			<p><strong>Bio:</strong>
				<?php echo $bio ?>
			</p>
			<p><strong>Joined:</strong>
				<?php echo $signupdate ?>
			</p>
			<p><strong>Gender:</strong>
				<?php echo $sex ?>
			</p>
			<p><strong>Interests:</strong>
				<?php echo $interests ?>
			</p>
			<p><strong>Hates:</strong>
				<?php echo $hates ?>
			</p>
			<p><strong>Date of Birth:</strong>
				<?php echo $dob ?>
			</p>
		</div>
	</div>
</div>
<div style = "position: relative; width: 0px;">
	<div class = "msg-options-box">
		<div id = "status-box" class = "status-box"><a  class = "msg-options">Status</a></div>
		<div id = "photo-box" class = "photo-box"><a class = "msg-options">Photo</a></div>
		<div id = "videos-box" class = "videos-box"><a class = "msg-options">Videos</a></div>
		<form action="#" method="POST" enctype="multipart/form-data">
			<div class = "msg-box" id = "msg-box">

			</div>
			<div id="after-msg-box">
				<div id="privacy-area">
					<div class = "dropdown">

						<div class = "option-sel toggle-options" id = "option-sel"><span id = "sel-pub"><span class = "glyphicon glyphicon-globe"/></span> <span id = "privacy-selected">Public</span></div><span class = "drop-gly glyphicon toggle-options glyphicon-chevron-down" ></span><span class = "toggle-options drop-helper glyphicon glyphicon-chevron-down" ></span>
						<div style = "" class = "dropdown-options">
							<div class = "option" id = "sel-public"><span id = "pub"><span class = "glyphicon glyphicon-globe"/></span> Public <br><span class = "post-privacy-info">Any Student Can See</span></div>
							<div class = "option" id = "sel-f"><span id = "f"><span class = "glyphicon glyphicon-user"/></span> Friends <br><span class = "post-privacy-info">Your Friends Can See</span></div>
							<div class = "option" id = "sel-fof"><span id = "fof" class = "glyphicon glyphicon-eye-open" ></span> Friends' Friends <br><span class = "post-privacy-info">Your Friends of Friends Can See</span></div>
						</div>
					</div>
					<input type = "submit" name = "post-submit" class = "share-btn" Value = "Share">
				</div>
			</div>
		</div>
	</form>
	<script>

		$(".dropdown-options").hide();
		$(document).ready(function(){
			$(".toggle-options").click(function(){
				$(".dropdown-options").toggle();
			});
		});

		$("#sel-public").click(function(){
			document.getElementById("option-sel").innerHTML = '<span id = "sel-pub"><span class = "glyphicon glyphicon-globe"/></span> <span id = "privacy-selected">Public</span>';
			$(".dropdown-options").hide();
		});
		$("#sel-f").click(function(){
			document.getElementById("option-sel").innerHTML = '<span id = "sel-pub"><span class = "glyphicon glyphicon-user"/></span> <span id = "privacy-selected">Friends</span>';
			$(".dropdown-options").hide();
		});

		$("#sel-fof").click(function(){
			document.getElementById("option-sel").innerHTML = '<span id = "sel-pub"><span class = "glyphicon glyphicon-eye-open"/></span> <span id = "privacy-selected">Friends\' Friends</span>';
			$(".dropdown-options").hide();
		});
		postMode="status";
		function makeSpaceForPhotoVideoOptions() {
			$(".profile-post").css("top", "-45px");
			$(".comment-body").css("top", "-60px");
			$(".comment-inputs").css("top", "-61px");
			$(".comment-input-pic").css("top", "-61px");
			$("#post").css("height", "75px");

		}
		function removeSpaceForPhotoVideoOptions() {
			$(".profile-post").css("top", "-120px");
			$(".comment-body").css("top", "-135px");
			$(".comment-inputs").css("top", "-135px");
			$(".comment-input-pic").css("top", "-135px");
			$("#post").css("height", "100px");

		}
		$('#msg-box').load("status-profile.php");
		$("#status-box").click(function(){
			$('#msg-box').load("status-profile.php");
			removeSpaceForPhotoVideoOptions();

			$("#status-box").css("background-color","white");
			$("#photo-box").css("background-color","#cccccc");
			$("#videos-box").css("background-color","#cccccc");
			$("#status-box").css("border","1px solid grey");
			$("#photo-box").css("border","none");
			$("#videos-box").css("border","none");
			$("#post").attr("placeholder", "Write on Timeline...");

		});
		$("#photo-box").click(function(){
			$('#msg-box').load("photo-profile.php");
			makeSpaceForPhotoVideoOptions();
			postMode="photo";
			$("#status-box").css("background-color","#cccccc");
			$("#photo-box").css("background-color","white");
			$("#videos-box").css("background-color","#cccccc");
			$("#photo-box").css("border","1px solid grey");
			$("#status-box").css("border","none");
			$("#videos-box").css("border","none");
			$("#post").attr("placeholder", "Tell about the Picture...");

		});
		$("#videos-box").click(function(){
			$('#msg-box').load("video-profile.php");
			makeSpaceForPhotoVideoOptions();
			postMode="video";
			$("#status-box").css("background-color","#cccccc");
			$("#photo-box").css("background-color","#cccccc");
			$("#videos-box").css("background-color","white");
			$("#videos-box").css("border","1px solid grey");
			$("#status-box").css("border","none");
			$("#photo-box").css("border","none");
			$("#post").attr("placeholder", "Tell about the Video...");
		});
	</script>

</div>


<div id="reload-post-before"></div>
</div>
<div id = "end">
	<div id="loading-img" style = "position: relative;">
		<img  src = "../img/loading.gif" width = "200px" style = "position: absolute; top: -100px; left:600px;"/>
	</div>
</div>

</div>
</div>
<div style="display:none" id="post_offset">0</div>

<script>
	all_posts_loaded = false;
	loading_currently = false;
	function load_more_post() {
//alert("load_more_posts() called with all_posts_loaded="+all_posts_loaded);
if (!all_posts_loaded && !loading_currently)  {
	loading_currently = true;
	offset = Number($("#post_offset").text());
	username = <?php echo '"'.$profileUser.'"'; ?>;
	posturl = "/bruinskave/php/post.php?u="+username+"&o="+offset;

	$.ajax({url: posturl, success: function(result){
		$("#reload-post-before").before(result);
		$("#post_offset").text(20+offset);
		loading_currently = false;
		if ($("#last_post").length > 0) {
			all_posts_loaded = true;
		}
	}});
}
}	
$(function() {
	$("#loading-img").hide();
	load_more_post();
	$("#loading-img").show();
//alert('end reached');

$(window).bind('scroll', function() {
	if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

//alert('end reached');
load_more_post();
$("#loading-img").show();
}
});
});


</script>


</body>

</html>