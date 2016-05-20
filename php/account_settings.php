<?php
include "header.php";
include "connect.php";
if($username){

	$check = $conn->query("SELECT * FROM users WHERE username='$username'");
	if ($check->num_rows == 1) {
		$get = $check->fetch_assoc();
		$username = $get['username'];
		$firstname = $get['first_name'];
		$lastname = $get['last_name'];
		$email = $get['email'];
		$signupdate= $get['sign_up_date'];
		$profilepic = $get['profile_pic'];
		$bio = $get['bio'];
		$sex = $get['sex'];
		$interests = $get['interests'];
		$dob = $get['dob'];
		$friends = $get['friend_array'];
		$relationship = $get['relationship'];
		$interestedin = $get['interestedin'];
		$midschool = $get['ms'];
		$elemschool = $get['es'];
		$talent = $get['talent'];
		$favquote = $get['favquote'];
		$hates = $get['hates'];
			
	} 

}else{
	die("You must be <a href = '/v2/socialnetwork/'>logged in.</a>");
}
?>
<?php
	$changepsw = @$_POST['changepsw'];

	
	
	$old_password = strip_tags(@$_POST['oldpassword']);
	$new_password = strip_tags(@$_POST['newpassword']);
	$repeat_password = strip_tags(@$_POST['newpassword2']);

	  if ($changepsw) {
	  //If the form has been submitted ...
	
	  $password_query = $conn->query("SELECT * FROM users WHERE username='$username'");
	  if($password_query->num_rows){
	  	  while ($row = $password_query->fetch_assoc()) {
	        $db_password = $row['password'];
	        
	        //md5 the old password before we check if it matches
	        $old_password_md5 = md5($old_password);
	        
	        //Check whether old password equals $db_password
	        if ($old_password_md5 == $db_password) {
	         //Continue Changing the users password ...
	         //Check whether the 2 new passwords match
	         if ($new_password == $repeat_password) {
	            if (strlen($new_password) <= 4) {
	             echo "Sorry! But your password must be more than 4 character long!";
	            }
	            else
                {
	
	            //md5 the new password before we add it to the database
	            $new_password_md5 = md5($new_password);
	           //Great! Update the users passwords!
	           $password_update_query = $conn->query("UPDATE users SET password='$new_password_md5' WHERE username='$username'");
	           echo "Success! Your password has been updated!";
	
	            }
	         }
	         else
	         {
	          echo "Your two new passwords don't match!";
	         }
	        }
	        else
	        {
	         echo "The old password is incorrect!";
	        }
	  }
	   }
	  else
	  {
	   echo "";
	  }
	  }
	
	
	
	  $updateinfo = @$_POST['updateinfo'];	
	  //First Name, Last Name and About the user query

	
	  //Submit what the user types into the database
	  if ($updateinfo) {
		$result = $conn->query("SELECT * FROM users WHERE username='$username'");
		$row = $result->fetch_assoc();
		$username = $get['username'];
		$firstname = $get['first_name'];
		$lastname = $get['last_name'];
		$email = $get['email'];
		$signupdate= $get['sign_up_date'];
		$profilepic = $get['profile_pic'];
		$bio = $get['bio'];
		$sex = $get['sex'];
		$interests = $get['interests'];
		$dob = $get['dob'];
		$friends = $get['friend_array'];
		$relationship = $get['relationship'];
		$interestedin = $get['interestedin'];
		$midschool = $get['ms'];
		$elemschool = $get['es'];
		$talent = $get['talent'];
		$favquote = $get['favquote'];
		$hates = $get['hates'];
			
		
		if ($_POST['fname']) {
			$firstname = strip_tags(@$_POST['fname']);
		}
		if ($_POST['lname']) {
			$lastname = strip_tags(@$_POST['lname']);
		}
		if ($_POST['aboutyou']) {
			$bio = strip_tags(@$_POST['aboutyou']);
		}
		if ($_POST['dob']) {
			$dob = strip_tags(@$_POST['dob']);
		}
		if ($_POST['sex']) {
			$sex = strip_tags(@$_POST['sex']);
		}
		if ($_POST['email']) {
			$email = strip_tags(@$_POST['email']);
		}
		if ($_POST['relationship']) {
			$relationship = strip_tags(@$_POST['relationship']);
			
			
			if($relationship == 'No Change'){
				$relationship = $get['relationship'];
				
			}
			
		}
		if ($_POST['interestedin']) {
			$interestedin = strip_tags(@$_POST['interestedin']);
			
			if($interestedin == 'No Change'){
				$interestedin = $get['interestedin'];
				
			}
		}
		if ($_POST['midschool']) {
			$midschool = strip_tags(@$_POST['midschool']);
		}
		if ($_POST['elemschool']) {
			$elemschool = strip_tags(@$_POST['elemschool']);
		}
		if ($_POST['favquote']) {
			$favquote = strip_tags(@$_POST['favquote']);
		}
		if ($_POST['talent']) {
			$talent = strip_tags(@$_POST['talent']);
		}
		if ($_POST['hates']) {
			$hates = strip_tags(@$_POST['hates']);
		}
	
		//Submit the form to the database
		$sql = "UPDATE users SET first_name='$firstname', last_name='$lastname', bio='$bio', email='$email', interests='$interests', sex='$sex', dob='$dob', ms='$midschool', es='$elemschool',  relationship='$relationship', interestedin='$interestedin', talent='$talent', favquote='$favquote', hates='$hates' WHERE username='$username'";
		$info_submit_query = $conn->query($sql);
		echo "Your profile info has been updated!";
	  }
	  //Check whether the user has uploaded a profile pic or not
	  $check_pic = $conn->query("SELECT profile_pic FROM users WHERE username='$username'");
	  $get_pic_row = $check_pic->fetch_assoc();
	  $profile_pic_db = $get_pic_row['profile_pic'];
	  if ($profile_pic_db == "") {
	  	$profile_pic = "/v2/socialnetwork/img/default_pic.jpg";
	  }
	  else{
		$profile_pic = $profile_pic_db;
	  }
	  //Profile Image upload script
	  if (isset($_FILES['profilepic'])) {
	  
	   if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif"))&&(@$_FILES["profilepic"]["size"] < 10485760)) {
	   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	   $rand_dir_name = $username;
	   
	 
	   if (file_exists("../userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"])){
		move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"../userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
		//echo "Uploaded and stored in: userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
		$profile_pic_name = @$_FILES["profilepic"]["name"];
		$sql = "UPDATE users SET profile_pic='/bruinskave/userdata/profile_pics/$rand_dir_name/$profile_pic_name' WHERE username='$username'";
		
		$profile_pic_query = $conn->query($sql);
	   }
	  else{
	  	mkdir("../userdata/profile_pics/$rand_dir_name");
	    	move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"../userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
		//echo "Uploaded and stored in: userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
		$profile_pic_name = @$_FILES["profilepic"]["name"];
		$sql = "UPDATE users SET profile_pic='/bruinskave/userdata/profile_pics/$rand_dir_name/$profile_pic_name' WHERE username='$username'";
		echo $sql;
		$profile_pic_query = $conn->query($sql);
	   }
	  }
	  else{
	      echo "Invailid File! Your image must be no larger than 10MB and it must be either a .jpg, .jpeg, .png or .gif";
	  }
  }
	
?>
<style>
	.main-body{
		width: 850px;
		position: relative;
		left: 10%;
		background-color: #E4E8EB;
	}
	.full-body {
		width:100%;
		background-color: #E4E8EB;
	}
	.proimg {
		
	} 
	.img-change{
		position: relative;
		top: 20px;
		width: 280px;
		padding: 30px;
		background-color: white;
		border: 1px solid grey;
		border-radius: 8px;
		
	}
	.changepsw-box{
		width: 280px;
		height: 300px;
		background-color: white;
		position: absolute;
		top: 50px;
		padding: 20px;
		border: 1px solid grey;
		border-radius: 8px;
	}
	.boxinfo{
		font-weight: bold;
		
	}
	.relationship-box{
		width: 280px;
		height: 150px;
		background-color: white;
		position: relative;
		top: 380px;
		padding: 20px;
		border: 1px solid grey;
		border-radius: 8px;
	}
	.otherinfo-box{
		width: 280px;
		height: 345px;
		background-color: white;
		position: relative;
		top: 450px;
		padding: 20px;
		border: 1px solid grey;
		border-radius: 8px;
	}
	.basicinfo-box{
		background-color: white;
		height: 795px;
		width: 600px;
		position: absolute;
		top: -713px;
		left: 310px;
		padding: 30px;
		border: 1px solid grey;
		border-radius: 8px;
	}
	.btn-trick{
		position: relative;
		top: 10px;
		left: 20%;
	}
	.btn-all{
		position: relative;
		top: 50px;
		left: 30%;
	}
</style>
    
		
<div id="username" style="display:none"><?php echo $profileUser; ?></div>
    <div class="full-body">
	<div class="main-body">
		<div class = "img-change">
			<form action="" method="POST" enctype="multipart/form-data">
				<img src="<?php echo $profile_pic; ?>"  class = "proimg" width = "200px" /><br><br>
				<input type="file" name="profilepic" />
				<input type="submit" name="uploadpic" class = "btn btn-primary btn-trick" value="Upload Image">
			</form>
		</div>
		<div style = "position: relative; ">
				
			   <div class = "changepsw-box">
			   <span class = "boxinfo">Change Password:</span>
		            <form action="account_settings.php" method="POST">
		                
		                <p>Old password: <input type="password" name="oldpassword" id="oldpassword" class = "form-control" placeholder="Old Psw" class="password-settings" z-index = "1" /></p>
		                <p>New password: <input type="password" name="newpassword" id="newpassword" class = "form-control" placeholder="New Psw" class="password-settings" z-index = "1" /></p>
		                <p>Repeat New password: <input type="password" name="newpassword2" id="newpassword2" class = "form-control" placeholder="Repeat New Psw" class="password-settings" z-index = "1" /></p>
		                
				<input type="submit" id="changepsw" name="changepsw" value="Change Password" class=" btn btn-primary btn-trick changepsw" />
		               
			    </form>
			   </div>
		</div>
			
		             <div style ="position: relative;  z-index: 0; height: 100px;">	
		                <div class = "relationship-box" style = " z-index: 5;">
		                   <span class = "boxinfo">Relationship:</span>
		                   <div class = "selDiv">
			                <p>Relationship: <select id="relationship" name = "relationship" class = "relationship">
			                		   <option>No Change</option>
						           <option value = "single">Single</option>
						           <option value = "ina" >In a relation</option>
						           <option value = "complicated" >Its Complicated</option>
						           <option value = "idc">I don t Care</option>
						         </select>
			                </p>
			           </div>
			           <div>
			                <p>Interested In: <select id="interestedin" name = "interestedin" class = "interestedin">
			                		   <option>No Change</option>
						           <option>Boys</option>
						           <option>Girls</option>
						           <option>Myself</option>
						         </select>
			                </p>
			            
			           </div>
					<form action="account_settings.php" method="POST">
						<input type="submit" id="updateinfo" name="updateinfo" class = "btn btn-xl btn-trick btn-primary" value="Save Changes" class="updateinfo" />
					</form>
				   </div>
		             </div>
		             <div style = "position: relative; z-index: -1;">
		                <div class = "otherinfo-box">
		                	
			                <p>Middle S.: <input type="text" name="midschool" id="midschool" class="form-control midschool box" value = "<?php echo $midschool; ?>" placeholder="MS Name" /></p>
			                <p>Elementary S.: <input type="text" name="elemschool" id="elemschool" class="form-control elemschool box" value = "<?php echo $elemschool; ?>" placeholder="ES Name" /></p>
			                <p>Pro at:<input type="text" name="talent" id="talent" class="form-control talent box" value = "<?php echo $talent; ?>" placeholder="Eating!!!" /></p>
			                <p>Fav. Quote: <textarea input type="text" name="favquote" id="favquote" class="form-control favquote box" placeholder="'Don't worry be Happy!'" ><?php echo $favquote; ?></textarea></p>
			                <form action="account_settings.php" method="POST">
					  	<input type="submit" id="updateinfo" name="updateinfo" class = "btn btn-xl btn-trick btn-primary" value="Save Changes" class="updateinfo" />
					</form>
			           
		                </div>
		             </div>
		             <div style = "position: relative;" >
		             	<div class = "basicinfo-box">
			    		
			    	  
			                <p>First Name: <input type="text" name="fname" id="fname" class="form-control fname box" placeholder="New Name?!" value = "<?php echo $firstname; ?>" /></p>
			                <p>Last Name: <input type="text" name="lname" id="lname" class="form-control lname box" placeholder="Last Name" value = "<?php echo $lastname; ?>" /></p>
			                <p>Email: <input type="email" name="email" id="email" class="form-control email box" placeholder="School Email" value = "<?php echo $email; ?>"/></p>
			                <p>Date of Birth: <input type="text" name="dob" id="dob" class="form-control dob box" placeholder="MM/DD/YYYY" value = "<?php echo $dob; ?>" /></p>
			                <p>Gender: <input type="text" name="sex" id="sex" class="form-control sex box" placeholder="I am a..." value = "<?php echo $sex; ?>" /></p>
			                <p>Interests: <input type="text" name="interests" id="interests box" class="form-control interests" placeholder="Ice Skating, driving..." value = "<?php echo $interests; ?>" /></p>
			                <p>Hates: <input type="text" name="hates" id="hates box" class="form-control interests" placeholder="Running mile, Eating heathy.." value = "<?php echo $hates; ?>" /></p>
			                <p>About you:</p>
		                	<textarea name="aboutyou" class = "form-control" id="aboutyou" rows="7" cols="60"><?php echo $bio; ?></textarea>
					<form action="account_settings.php" method="POST">
					  	<input type="submit" id="updateinfo" name="updateinfo" class = "btn btn-all btn-success btn-lg" value="Save All Changes" class="updateinfo" />
					</form>
		                </div>
		             </div>
		           
	</div>
    </div>
</body>

</html>