<?php 
include "php/connect.php";
include "php/header.php";
?>
<?php
if(isset($_GET['id'])){
	$classId = $_GET['id']; 
	$tmp_arr = explode('-', $classId);
	$classPer = $tmp_arr[1];
}else{
	// do somthing
}
if($classPer == 0){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code0 = '$classId'"); 
}
else if($classPer == 1){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code1 = '$classId'"); 
}
else if($classPer == 2){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code2 = '$classId'"); 
}
else if($classPer == 3){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code3 = '$classId'"); 
}
else if($classPer == 4){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code4 = '$classId'"); 
}
else if($classPer == 5){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code5 = '$classId'"); 
}
else if($classPer == 6){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code6 = '$classId'"); 
}
else if($classPer == 7){
	$getClass = $conn->query("SELECT * FROM teacher WHERE code7 = '$classId'"); 
}

if ($getClass->num_rows == 1) {

	$get = $getClass->fetch_assoc();
	$id = $get['id'];
	$cSub = "p" . $classPer;
	$cMates = "classmates" . $classPer;
	$classSub = $get[$cSub];
	$classmatesString = $get[$cMates];
	$banner = $get['banner'];


	$classTeacherImg = $get['profile_pic'];
	$classTeacher = $get['firstname'] . " " . $get['lastname'];

}
if (isset($_POST['post'])) {
	$post = @$_POST['post'];
	if($post != ""){
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$time_added = date("h:i:sa");

		$sqlcommand = "INSERT INTO classroom_posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '', '', '')";
		$query = $conn->query($sqlcommand) or die(mysql_error());

	}
}

if (isset($_FILES['pictureUpload'])) {
	$post = '';
	$post = $_POST['photopost'];
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = date("h:i:sa");


	if (((@$_FILES["pictureUpload"]["type"]=="image/jpeg") || (@$_FILES["pictureUpload"]["type"]=="image/png") || (@$_FILES["pictureUpload"]["type"]=="image/gif"))&&(@$_FILES["pictureUpload"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/albums/$rand_dir_name/".@$_FILES["pictureUpload"]["name"])){

			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"userdata/albums/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];

			$sql = "INSERT INTO classroom_posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '/bruinskave/userdata/albums/$rand_dir_name/$profile_pic_name', '', '')";
			$profile_pic_query = $conn->query($sql);
		}

		else {

			mkdir("userdata/albums/$rand_dir_name");
			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"userdata/albums/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];
			$sql = "INSERT INTO classroom_posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '/bruinskave/userdata/albums/$rand_dir_name/$profile_pic_name', '', '')";

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
	//$user_posted_to = $profileUser;
	$time_added = date("h:i:sa");

	$sqlcommand = "INSERT INTO classroom_posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '$photolink', '', '')";
	$query = $conn->query($sqlcommand) or die(mysql_error());


}
if (isset($_FILES['videoUpload'])) {
	$post = $_POST['videopost'];
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = date("h:i:sa");


	if (((@$_FILES["videoUpload"]["type"]=="video/mp4") || (@$_FILES["videoUpload"]["type"]=="video/webm") || (@$_FILES["videoUpload"]["type"]=="video/ogg"))&&(@$_FILES["videoUpload"]["size"] < 10485760)) {
		$rand_dir_name = $username;


		if (file_exists("userdata/videos/$rand_dir_name/".@$_FILES["videoUpload"]["name"])){
			move_uploaded_file(@$_FILES["videoUpload"]["tmp_name"],"userdata/videos/$rand_dir_name/".$_FILES["videoUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["videoUpload"]["name"];
			$profile_pic_name = @$_FILES["videoUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '', '/bruinskave/userdata/videos/$rand_dir_name/$profile_pic_name', '')";
			$profile_pic_query = $conn->query($sql);
		} else {
			mkdir("userdata/videos/$rand_dir_name");
			move_uploaded_file(@$_FILES["videoUpload"]["tmp_name"],"userdata/videos/$rand_dir_name/".$_FILES["videoUpload"]["name"]);
//echo "Uploaded and stored in: userdata/albums/$rand_dir_name/".@$_FILES["videoUpload"]["name"];
			$profile_pic_name = @$_FILES["videoUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '', '/bruinskave/userdata/videos/$rand_dir_name/$profile_pic_name', '')";

			$profile_pic_query = $conn->query($sql);
		}
	}
}
/*if(isset($_POST['videolink'])){

	$post = '';
	$post = @$_POST['videopost'];
	$url = $_POST['videolink'];
	$url_parts = explode('[\?\&]',$url);
	$v_parts = explode('\=',$url_parts[1]);
	$video_code = $v_parts[1];
	$videolink = "https://www.youtube.com/embed/$video_code";
	if($url != '' || $url != NULL) {
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$added_by = $username;
		$user_posted_to = $profileUser;
		$time_added = date("h:i:sa");

		$sqlcommand = "INSERT INTO posts VALUES ('', '$username', '$classId', '$post', '', '$date_added', 'time_added', '0', '', '', '$videolink')";
		$query = $conn->query($sqlcommand) or die(mysql_error());
	}

}*/
?>
<style>
	body{
		overflow-x: hidden;
	}
	#color_manager{
		background: #e2e8eb;
	}
	.top-section{
		width: 100%;
		height: 250px;
		background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(<?php echo $banner; ?>);
		background-repeat: no-repeat;
		background-size: 100%;
	}
	.classSub{
		color:white;
		font-size:33px;
		font-family: verdana;
		font-weight: bold;
	}
	.classPer{
		color:white;
		font-size:23px;
		font-family: verdana;
	}
	.top-info{
		position:relative;
		left: calc((100vw / 2) - 50vw);
		width: 100vw;
		text-align: center;
		top: 100px; 

	}
	.aboutTeacher{
		text-align: center;
	}
	.classTeacherImg{
		width: 40px;
		height: 40px;
		border-radius: 45px;

	}
	.classTeacher{
		font-size: 18px;
		color: white;
		margin-left: 5px;
	}
	.optionBar{
		height: 60px;
		background: #264867;
	}
	.tabs{
		display: inline-block;
		font-size: 22px;
		color: white;
		position: relative;
		left:calc((100vw/2) - 260px);
		height: 60px;
		padding: 12px;
		font-family: verdana;
		cursor: pointer;
	}
	.tabs:hover{
		background-color: #e2e8eb;
		color: #264867;
	}
	.posted-pic{
		max-height: 700px;
		max-width: 550px;
	}
</style>
<div id="color_manager">
	<div class = "top-section">
		<div class = "top-info">
			<span class = "classSub"><?php echo $classSub; ?></span>
			<span class = "classPer">Period <?php echo $classPer; ?></span>
			<div class = "aboutTeacher">
				<img class = "classTeacherImg" src="<?php echo $classTeacherImg; ?>">
				<span class = "classTeacher"><?php echo $classTeacher; ?></span>
			</div>
		</div>
	</div>
	<div class = "optionBar">
		<div class = "activityLog tabs">Activities</div>
		<div class = "classmatesLog tabs">Classmates</div>
		<div class = "playLog tabs">Play</div>
		<div class = "resultsLog tabs">Results</div>
		<div class = "AboutLog tabs">About</div>
	</div>
	<div id="show_sel">
		<?php include "activitylog.php" ?>
	</div>
</div>
</div>
<script>
$(document).ready(function(){

	$(".activityLog").css("background-color", "#e2e8eb");
	$(".activityLog").css("color", "#264867");

    $('.classmatesLog').click(function(){
         $("#show_sel").load("classmateslog.php?str=<?php echo $classmatesString; ?>");
         alert("classmateslog.php?str=<?php echo $classmatesString; ?>");
    });

});
</script>
</body>
</html>