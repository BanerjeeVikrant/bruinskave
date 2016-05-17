<?php include 'connect.php';?>
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

<?php 
$offset = $_GET['o'];
	 $getpic = $conn->query("SELECT * FROM photos WHERE added_by='$profileUser' ORDER BY id DESC LIMIT $offset,21");
	 if ($getpic->num_rows > 0) {
	     while ($row = $getpic->fetch_assoc()) {
	     	$id = $row['id'];
	     	$link = $row['link'];
	     	$date = $row['date'];
	     	$time = $row['time'];
	     	$hidden = $row['hidden'];
	     	$hidden_by = $row['hidden_by'];
	        
	             echo "
	             <div class='image-wrapper' style = 'background-image: url($link)'></div>
	             ";
	        
	     }
	     
	 }  
?>