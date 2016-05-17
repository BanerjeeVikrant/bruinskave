<?php include "header.php"; ?>
<?php include "connect.php"; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<?php
if (isset($_GET['u'])) {
	$findFriendsOf = $_GET['u'];
	
	$get = $conn->query("SELECT * FROM users WHERE username='$findFriendsOf'");
	$find = $get->fetch_assoc();
	$users_string = $find['friend_array'];
	$firstname = $find['first_name'];
	$users = split(',',$users_string);
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
                    <span class = "page-info">Your Friend Requests</span>
                    <div class="inner-side-body" style="overflow:auto;">
			<?php
//Find Friend Requests
$friendRequests = $conn->query("SELECT * FROM friend_requests WHERE user_to='$username'");
$numrows = $friendRequests->num_rows;
if ($numrows == 0) {
	echo "You have no friend Requests at this time.";
	$user_from = "";
} else {
	while ($get_row = $friendRequests->fetch_assoc()) {
		$id = $get_row['id']; 
		$user_to = $get_row['user_to'];
		$user_from = $get_row['user_from'];
	  
		echo '' . $user_from . ' wants to be friends'.'<br />';
	

?>
<?php 
if (isset($_POST['acceptrequest'.$user_from])) {
	//Get friend array for logged in user
	$get_friend_check = $conn->query("SELECT friend_array FROM users WHERE username='$username'");
	$get_friend_row = $get_friend_check->fetch_assoc();
	$friend_array = $get_friend_row['friend_array'];
	$friendArray_explode = explode(",",$friend_array);
	$friendArray_count = count($friendArray_explode);
	
	//Get friend array for person who sent request
	$get_friend_check_friend = $conn->query("SELECT friend_array FROM users WHERE username='$user_from'");
	$get_friend_row_friend = $get_friend_check_friend->fetch_assoc();
	$friend_array_friend = $get_friend_row_friend['friend_array'];
	$friendArray_explode_friend = explode(",",$friend_array_friend);
	$friendArray_count_friend = count($friendArray_explode_friend);
	
	
	if ($friendArray_count) {
		if ($friend_array == "") {
			$friend_array = $user_from;
		}  else {
			$friend_array = "$friend_array,$user_to";
		}
		$sql = "UPDATE users SET friend_array='$friend_array' WHERE username='$username'";
		$add_friend_query = $conn->query($sql);
	}
	if ($friendArray_count_friend) {
		if ($friend_array_friend == "") {
			$friend_array_friend = $user_to;
		}  else {
			$friend_array_friend = "$friend_array_friend,$user_to";
		}
		$sql = "UPDATE users SET friend_array='$friend_array_friend' WHERE username='$user_from'";
		$add_friend_query = $conn->query($sql);
	}
	/*if ($friendArray_count >= 1) {
		if ($friend_array == "") {
			$friend_array = $user_from;
		}  else {
			$friend_array = "$friend_array,$user_to";
		}
		$sql = "UPDATE users SET friend_array='$friend_array' WHERE username='$username'";
		$add_friend_query = $conn->query($sql);
		echo $sql;
	}
	if ($friendArray_count_friend >= 1) {
		$add_friend_query = $conn->query("UPDATE users SET friend_array=CONCAT(friend_array,',$user_to') WHERE username='$user_from'");
	}*/
	$delete_request = $conn->query("DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'");
	echo 'Friend added.';
	echo "<meta http-equiv=\"refresh\" content=\"0; url=/v2/socialnetwork/php/friend_requests.php\">";
		
}
if (isset($_POST['ignorerequest'.$user_from])) {
	$delete_request = $conn->query("DELETE FROM friend_requests WHERE user_to='$user_to'&&user_from='$user_from'");
	echo "<meta http-equiv=\"refresh\" content=\"0; url=/v2/socialnetwork/php/friend_requests.php\">";
}
?>
<form action="friend_requests.php" method="POST">
	<input type="submit" name="acceptrequest<?php echo $user_from; ?>" value="Accept Request">
	<input type="submit" name="ignorerequest<?php echo $user_from; ?>" value="Ignore Request">
</form>

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
<?php include "../bottom.php" ?>
<script>
</script>
</body>

</html>