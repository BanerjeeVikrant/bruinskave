<?php
include "connect.php";
include "header.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	$check = $conn->query("SELECT * FROM pages WHERE id='$id'");
	if ($check->num_rows == 1) {
		$get = $check->fetch_assoc();
		
		$name = $get['name'];
		$img = $get['img'];
		$banner = $get['banner'];
		$about = $get['about'];
		$followers = $get['followers'];
		$sa = $get['sa'];
		$a = $get['a'];
		$topic = $get['topic'];
		$founded = $get['founded'];
		$muted = $get['muted']; 
	}

}

$followersArray = "";
$saArray = "";
$aArray = "";

$countFollowers = 0;
$countsa = 0;
$counta = 0;

$FollowersArray20 = "";
$saArray12 = "";
$aArray12 = "";

$followersArray = [];
$saArray = [];
$aArray = [];

if ($followers != "") {
	$followersArray = explode(",",$followers);
	$countFollowers = count($followersArray);
}

if ($sa != "") {
	$saArray = explode(",",$sa);
	$countsa = count($saArray);
}


if ($a != "") {
	$aArray = explode(",",$a);
	$counta = count($aArray);
}


$followersArray20 = array_slice($followersArray, 0, 30);
$saArray12 = array_slice($saArray, 0, 12);
$aArray12 = array_slice($aArray, 0, 12);

?>
<style>
	.banner-img-page{
		width: 900px;
		height: 200px;
		position: relative;
		left: 100px;
	}
	.main-body{
		background-color: #e4e8eb;
	}
	.page-img-div{
	  	position: relative;
		
	}
	.page-img{
	  	max-width: 250px;
		min-width: 200px;
		position: absolute;
		top: -150px;
		left: 150px;
		max-height: 250px;
		min-height: 150px;
		border: 3px solid white;
		border-radius: 10px;
	}
	.followers-img{
		margin-right: 5px;
		margin-bottom: 5px;
		width: 50px;
		height: 50px;
	}
	.followers-box{
		background-color: white;
		border: 1px solid #aaaaaa;
		width: 300px;
		position: relative;
		top: 150px;
		left: 100px;
		padding: 11px;
		padding-left: 12px;
	}
	.box-tag{
		font-weight: bold;
		font-size: 20px;
		position: relative;
		top: -5px;
	}
	.sa-box{
	
		background: white;
		width: 300px;
		padding: 10px;
		position: relative;
		top: 100px;
		left: 100px;
		border: 1px solid grey;
	
	}
	.a-box{
		
		background-color: white;
		width: 300px;
		position: relative;
		top: 125px;
		left: 100px;
		padding: 10px;
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
        	top: 40px;
        	left: -10px;
        	height: 50px;
        	width: 90px;
        	padding: 14px;
        	padding-left: 22px;
        	background-color: white;
        }
        .photo-box{
        	position: relative;
        	top: -10px;
        	left: 81px;
        	height: 50px;
        	width: 90px;
        	padding: 14px;
        	padding-left: 22px;
        }
        .videos-box{
        	position: relative;
        	top: -60px;
        	left: 172px;
        	height: 50px;
        	width: 90px;
        	padding: 14px;
        	padding-left: 22px;
        }
        #post{
        	border: 1px solid black;
        	width:500px; 
        	height:100px;
        	background-color: white;
        	position: relative;
        	top: -61px;
        	left: -11px;
        	resize: none;
        	color: black;
        	padding: 8px;
        	font-family: Verdana;
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
		top: 55px;
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
		top: 49px;
		font-weight: bold;
        }
        .share-btn{
		background-color: #99ccff;
		color: white;
		height: 40px;
		width: 130px;
		font-size: 20px;
		font-family: verdana;
		border: 1px solid black;
		position: absolute;
		top: -1px;
		left: 369px;
        }
	#privacy-area{
		background-color: #dddddd;
		height: 40px;
		width: 500px;
		position: relative;
		top: 44px;
		border: 1px solid black;
	}
	#privacy-area .dropdown {
		display: none;
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
	.msg-options-box{
		position: absolute;
		left: 500px;
		top: -530px;
	}
	.photoOrVideo{
		z-index: 1;
		width: 500px;
		position: relative;
		top: -67px;
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
		top: 50px;
		right: 50px;
		color: white;
	}
	.posted-pic{
		max-height: 500px;
		max-width: 450px;
	}
	.page-heading{
		position: relative;
		top: -570px;
		font-size: 30px;
		font-family: verdana;
		font-weight: bold;
		left: 485px;
		color: #353A82;
	}
	.page-about{
		width: 500px;
		position: relative;
		top: -480px;
		left: 490px;
	}
	.page-topic{
	
		position: relative;
		top: -720px;
		left: 590px;
		font-size: 20px;
		color: #6D1817;	
	}
	.page-founded{
		
		position: relative;
		top: -675px;
		left: 490px;
		font-size: 18px;
		
	}
</style>

<div class = "main-body">
	<img class = "banner-img-page" src = "<?php echo $banner; ?>"></img>
	
	<div class = "page-img-div">
		<img class = "page-img" src = "<?php echo $img; ?>"></img>
	</div>
	
</div>
<div style = "background-color: #e4e8eb;">
<div class = "sa-box">
<span class = "box-tag" >Founder(s)</span><br>
	<?php
		if ($countsa != 0) {
			foreach ($saArray12 as $value) {
				
				$getsaQuery = $conn->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
				$getsaRow = $getsaQuery->fetch_assoc();
				$saUsername = $getsaRow['username'];
				$saProfilePic = $getsaRow['profile_pic'];
				
				if ($saProfilePic == "") {
					echo "<a href='profile.php?u=$saUsername'><img class = 'followers-img' src='https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg'></a>";
				}
				else{
					echo "<a href='profile.php?u=$saUsername'><img class = 'followers-img' src='$saProfilePic' ></a>";
				}
			}
		}else{
			echo "No one follows ". $name . " yet.";
		}
	?>
</div>
<div class = "a-box">
<span class = "box-tag" >Manager(s)</span><br>
	<?php
		if ($counta != 0) {
			foreach ($aArray12 as $value) {
				
				$getaQuery = $conn->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
				$getaRow = $getaQuery->fetch_assoc();
				$aUsername = $getaRow['username'];
				$aProfilePic = $getaRow['profile_pic'];
				
				if ($saProfilePic == "") {
					echo "<a href='profile.php?u=$aUsername'><img class = 'followers-img' src='https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg'></a>";
				}
				else{
					echo "<a href='profile.php?u=$aUsername'><img class = 'followers-img' src='$aProfilePic' ></a>";
				}
			}
		}else{
			echo "No one follows ". $name . " yet.";
		}
	?>
</div>
<div class = "followers-box">
<span class = "box-tag" >Followers</span><br>
	<?php
		if ($countFollowers != 0) {
			foreach ($followersArray20 as $value) {
				
				$getFollowerQuery = $conn->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
				$getFollowerRow = $getFollowerQuery->fetch_assoc();
				$followerUsername = $getFollowerRow['username'];
				$followerProfilePic = $getFollowerRow['profile_pic'];
				
				if ($followerProfilePic == "") {
					echo "<a href='profile.php?u=$followerUsername'><img class = 'followers-img' src='https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg'></a>";
				}
				else{
					echo "<a href='profile.php?u=$followerUsername'><img class = 'followers-img' src='$followerProfilePic' ></a>";
				}
			}
		}else{
			echo "No one follows ". $name . " yet.";
		}
	?>
</div>
<span class = "page-heading"><?php echo $name; ?></span>
<div class = "page-about"><?php echo $about; ?></div>
<div class = "page-topic"><?php echo $topic; ?></div>
<div class = "page-founded">Page Created on <?php echo $founded; ?></div>
<div style = "position: relative;">
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
</div>
</body>
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
</html>