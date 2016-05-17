<?php include 'header.php';?>
<?php include 'connect.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<?php
if (isset($_GET['users'])) {
	$users_string = $_GET['users'];
	$users = split(',',$users_string);
	if (count($users) == 0) {
		echo "<meta http-equiv=\"refresh\" content=\"0; url=/v2/socialnetwork/index.php\">";
		exit();
	}

}

?>
    <style>
       
        
        .profilepic {
            margin-left: 30px;
        }
        
        .aboutme {
            width: 270px;
            margin-top: 15px;
            margin-left: 10px;
        }
        .memberheading{
        	font-size: 25px;
        	
        }
        .ar-hr{
        	border-bottom: 3px dashed grey;
        }
        .info-box{
        	position: absolute;
        	top: 20px;
        	left: 200px;
        }
        .mem{
        	padding: 10px;
        	border-bottom: 2px solid black;
        }
  
    </style>


    <div id="username" style="display:none"><?php echo $username; ?></div>
    <div class="main-body">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
                <?php include 'left-sidebar.php';?>
            </div>
            <script src = "../js/main.js"></script>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
                <div class="side-body" style="overflow:auto;">
                    <span class = "page-info">Search Result</span>
                    <div class="inner-side-body" style="overflow:auto;">
<div class = "ar-hr"><span class = "memberheading">Members</span></div>
                        <div class="search results">
<?php            	
foreach ($users as $username) {
 	//check user exists
	$check = $conn->query("SELECT * FROM users WHERE username='$username'");
	if ($check->num_rows == 1) {
		$get = $check->fetch_assoc();
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
		$interests = $get['interests'];
?>
                    	<div class = "propic-box">
                    	<div style = "position:relative;" class = "mem">
                    		<div><a href = "/v2/socialnetwork/php/profile.php?u=<?php echo $username ?>"><img src = "<?php echo $profilepic ?>" width = "100px" height = "100px" /></a>
                    		<div><span class = "user"><a href = "/v2/socialnetwork/php/profile.php?u=<?php echo $username ?>"><?php echo $username; ?></a></span></div>
                    		
	                    		<div class = "info-box">
		                    		<div>
		                    			<span>Currently: <?php echo $grade; ?></span>
		                    		</div>
		                    		<div>
		                    			<span>Name: <?php echo $firstname . ' ' . $lastname; ?></span>
		                    		</div>
		                    		<div>
		                    			<span>Joined: <?php echo $signupdate; ?></span>
		                    		</div>
		                    		<div>
		                    			<span>Interests: <?php echo $interests; ?></span>
		                    		</div>
		                    	</div>
	                    	</div>
                    		</div>
                    		
                    		
                    	</div>
<?php
			
	} 
}
?>
	
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "../bottom.php" ?>
<script>
</script>
</body>

</html>