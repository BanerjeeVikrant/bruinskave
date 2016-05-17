<?php include "connect.php" ?>
<?php include "header.php" ?>

<style>
    
	.main-album-body {
		width: 1000px;
		margin-left: 85px;
		padding-top: 20px;
	}
	.image-wrapper {
		display:inline-block;
		width: 280px;
		height: 280px;
		margin: 5px;
		border: 1px solid;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center center; 
	
	}
	.profilepic{
		max-height: 180px;
		min-height: 100px;
		width: 150px;
		position: absolute;
		top: -150px;
		left: 150px;
		border: 1px solid white;
	}
	.user-name{
		position: absolute;
		top: -120px;
		left: 370px;
		z-index: 999;
		color: white;
		
	}
	.banner-img{
		width: 900px;
		height: 200px;
		z-index: 99;
		margin-left: 75px;
		
	}

</style>
<?php 
if (isset($_GET['u'])) {
        $profileUser = $_GET['u'];
        
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
                echo "<meta http-equiv=\"refresh\" content=\"0; url=/v2/socialnetwork/index.php\">";
                exit();
        }
        
}
?>
<div style = "background-color: #e2e8eb;">
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
			<h2 class = "user-name"><?php echo $firstname."'s<br> &nbsp; &nbsp;&nbsp;&nbsp;" ?> Photos</h2>
		</div>
		<div class = "main-album-body">
		<div id="reload-post-before"></div>
		</div>
		<div id = "end">
                <div id="loading-img" style = "position: relative;">
                <img  src = "../img/loading.gif" width = "200px" style = "position: absolute; top: -100px; left:500px;"/>
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
    			posturl = "/v2/socialnetwork/php/getpic.php?u="+username+"&o="+offset;
    		
			$.ajax({url: posturl, success: function(result){
			        $("#reload-post-before").before(result);
			        $("#post_offset").text(21+offset);
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
		       // alert('end reached');
		        load_more_post();
		        $("#loading-img").hide();
    		$(window).bind('scroll', function() {
		    if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {
		    	$("#loading-img").show();
		        //alert('end reached');
		        load_more_post();
		        $("#loading-img").hide();
		    }
		});
    	});

	
    </script>

    

</div>
</body>

</html>