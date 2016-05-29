<?php include 'php/connect.php';?>
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}


?>
<?php
if (isset($_GET['id'])) {
	$classroomId = $_GET['id'];
}
$offset = $_GET['o'];
$checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
	if ($checkme->num_rows == 1) {
	
		$getuser = $checkme->fetch_assoc();
		
		$yourfirstname = $getuser['first_name'];
		$yourgrade = $getuser['grade'];
		if($yourgrade == 9){
			$yourgrade = "Freshman";
		}else if($yourgrade == 10){
			$yourgrade = "Sophomore";
		}else if($yourgrade == 11){
			$yourgrade = "Junior";
		}else if($yourgrade == 12){
			$yourgrade = "Senior";
		}
		$yourlastname = $getuser['last_name'];
		$youremail = $getuser['email'];
		$yoursignupdate= $getuser['sign_up_date'];
		$yourprofilepic = $getuser['profile_pic'];
		$yourbio = $getuser['bio'];
		$yoursex = $getuser['sex'];
		$yourinterests = $getuser['interests'];
		$yourdob = $getuser['dob'];
		$yourfriends = $getuser['friend_array'];
		$yourhates = $getuser['hates'];
		
	}

$sql = "SELECT * FROM classroom_posts WHERE to_class='$classroomId' ORDER BY id DESC LIMIT $offset,20";
$getposts = $conn->query($sql);// or die(mysql_error());
if($getposts->num_rows > 0) {
	while ($row = $getposts->fetch_assoc()) {
		$id = $row['id'];
		$hidden = $row['hide'];
		if($hidden == '1'){
			continue;
		}
		$body = $row['body'];	
		/* //$body = identifyTagsInMsg($body);*/
		$pic = '';
		$vid = '';
		
		$picture_added = $row['picture'];
		$video_link = $row['youtubevideo'];
		$video_added = $row['video'];
		if($picture_added != NULL || $picture_added != ""){
			$pic = "<img src = '$picture_added' class = 'posted-pic'></img>";
		}else if($video_added != NULL || $video_added != ""){
			$vid = "<video width='450' style = 'max-height: 500px;' controls>
			  <source src='$video_added' type='video/mp4'>
			  Your browser does not support HTML5 video.
			</video>";
		}
		$date_added = $row['date_added'];
		$added_by = $row['from'];
		$time_added = $row['time_added'];
		$username_posted_to = $row['to_class'];
		$commentsid = $row['commentsid'];
		
		$sql = "SELECT * FROM users WHERE username='$added_by'"; 
		$result = $conn->query($sql);
		$pic_row  = $result->fetch_assoc();
		$userpic =  $pic_row['profile_pic'];
		$userfirstname = $pic_row['first_name'];
		$userlastname = $pic_row['last_name'];
		$topName = '';
		if($username == $classroomId){
			$hide = "<a href = 'deleteposts.php?p=$id' class = 'glyphicon glyphicon-remove'></a>";
		}
		if($added_by != $classroomId){
			$topName = "<a href = '/bruinskave/php/profile.php?u=$added_by' class = 'posted-by-name'>$userfirstname $userlastname</a>
			<span class = 'glyphicon glyphicon-triangle-right arrow'>
			</span><a href = '/bruinskave/php/profile.php?u=$added_by' class = 'posted-to-name'>$userfirstname $userlastname</a>";
		} else{
			$topName = "<a href = '/bruinskave/
			php/profile.php?u=$added_by' class = 'samepostedby'>$userfirstname $userlastname</a>";
		}
	
		$commentsArray = [];
		
		if ($commentsid != "") {
			$commentsArray = explode(",",$commentsid);
		}
		echo "
			<div class = 'profile-post'>
				<div style = 'position: relative;'>
				<div class = 'glyphicon glyphicon-menu-down post-options' style = 'position: absolute; left: 520px;'>
					<div class = 'postoptions-div' style = 'display: none; position: absolute;top: 19px;left:-113px;background-color: #F3F3F3;width: 126px;height: 90px;'>
				
						<div class = 'hide-post post-work' style = ''> <span class = 'glyphicon glyphicon-lock'></span> Hide</div>
						<div class = 'delete-post post-work' style = ''> <span class = 'glyphicon glyphicon-remove'></span> Delete</div>
						<div class = 'report-post post-work' style = ''> <span class = 'glyphicon glyphicon-flag'></span> Report</div>
					</div>
				</div>
				</div>
				<img class = 'posted-by-img' src = '$userpic' />
				<span class = 'topName'>
				$topName<br>
				<span class = 'time'>$time_added<span>, </span>$date_added</span>
				</span>
				<p class = 'msg-body'>$body</p>
				$pic
				$vid
				
			</div>
			<div class = 'comments-box'>";
				echo "	
				</div>
				<textarea style = 'display: none;' id = 'comments-send'></textarea>
				<div class = 'comments-input'>
					<div style = 'position: relative;'>
					<img class = 'comment-input-pic' src = '$yourprofilepic'></img>
					</div>
					<form method = 'POST' class='post-comment'>
					  <input type = 'text' name = 'comment' placeholder = 'Write a Comment&hellip;' class = 'comment-inputs' />
					  <input type = 'text' name = 'id' value = '$id' style = 'display: none;' />
					  <input type = 'submit' id = 'commentid' name = 'commentid' style = 'display: none;'/>	
					</form>		
				</div>";
	}	
} else {
		echo "	
			<div style = 'position: relative;'>
			<div class = 'profile-post' id='last_post' style ='position: absolute;'>
				<span><span class  = 'glyphicon glyphicon-share-alt'></span> No more Feeds!<span>
			</div>
			</div><script>document.getElementById('loading-img').remove();</script>
		";
}
?>
<script>
var stopCommentPosting = false;
$('.post-comment').submit(function(e){
    if (stopCommentPosting) {
    	return;
    }
    stopCommentPosting = true;
    e.preventDefault();
    var url="post-comment.php",
        data=$(this).closest('.post-comment').serialize();
    var curr_position = $(this).closest('.post-comment');
 /*   var comment_html1 = <?php echo '"'."
    			<div style = 'position: relative;'>			
				<div class = 'comment-body'>
					<img src = '$yourprofilepic' class = 'comments-img'></img>
					<div class = 'comment-area'>
						<div style = 'position: relative;'>
						<div class = 'commentPosted'>
							<a href = '/bruinskave/php/profile.php?u=$username '>$username </a>&nbsp;&nbsp;&nbsp;".'"'; ?>;
    var comment_html2 = <?php echo '"'."						
						</div>
						<div style = 'position: relative;'>
							
						</div>
						</div>
					</div>
				</div>
			</div>".'"'; ?>;
*/
     var comment_html1 = "<div style = 'position: relative;'><div class = 'comment-body'><img src = '"+ "<?php echo $yourprofilepic; ?>" + "' class = 'comments-img'></img>";
    //var comment_html1 = "<div style = 'position: relative;'><div class = 'comment-body'>";
    var comment_html2 = "<div style = 'position: relative;'><div class = 'comment-like' style = 'position:absolute; top: -3px;'></div></div></div></div>";
    $.ajax({
        url:url,
        type:'post',
        data:data,
        success:function(commentText){
        	if(commentText == ""){
        		return;
        	}
		var commenttxt = "<div class = 'commentPosted' style='position: relative;top: -35px;left: 60px;'><a style='position: relative;top: 0px; left: 0px;' href = '/bruinskave/php/profile.php?u=<?php echo $username; ?>'><?php echo $username; ?></a>&nbsp;&nbsp;&nbsp;" + commentText + "</div>";
            curr_position.parent().before(comment_html1+commenttxt+comment_html2);
            
            $(".comment-inputs").val("");
            stopCommentPosting = false;
            
        }
    });
});
var postoptionOpen = false;

$(".post-options").click(function() {
	if(postoptionOpen == false){
		$(this).find(".postoptions-div").css("display", "block");
		postoptionOpen = true;
	}
	else if (postoptionOpen == true){
		$(this).find(".postoptions-div").css("display", "none");
		postoptionOpen = false;
	}
});

	
</script>