<?php include "header.php"; ?>
<?php include "connect.php"; ?>


<?php
if (isset($_GET['u'])) {
	$findFriendsOf = $_GET['u'];
	
	$get = $conn->query("SELECT * FROM users WHERE username='$findFriendsOf'");
	$find = $get->fetch_assoc();
	$users_string = $find['friend_array'];
	$firstname = $find['first_name'];}

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
$hi = $conn->query("SELECT * FROM sayhi WHERE user_to='$username'");
$numrows = $hi->num_rows;
if ($numrows == 0) {
	echo "You have no Hies' at this time.";
	$user_from = "";
} else {
	while ($get_row = $hi->fetch_assoc()) {
		$id = $get_row['id']; 
		$user_to = $get_row['user_to'];
		$user_from = $get_row['user_from'];
	  
		echo '' . $user_from . ' said Hi! to you '.'<br />';
	

?>
<?php 
$index = 'hiback'.$user_from;
if (isset($_POST[$index])) {
	$sql = "INSERT INTO sayhi VALUES ('', '$user_to', '$user_from', '0')";
	echo "$sql<br/>";
	$conn->query($sql);
	$sql = "DELETE FROM sayhi WHERE user_to='$user_from' AND user_from='$user_to'";
	echo "$sql<br/>";
	$conn->query($sql);
	echo 'hied';
	echo '<meta http-equiv=\"refresh\" content=\"0; url=/v2/socialnetwork/php/myhies.php\">';	
}

?>
<form action="myhies.php" method="POST">
	<input type="submit" name="hiback<?php echo $user_from; ?>" value="Hi Back!" required> 
	
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