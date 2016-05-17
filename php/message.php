<?php include 'header.php';?>
<?php include 'connect.php';?>
<script src = "../js/wysiwyg.js"></script>
<?php
        if (isset($_GET['u'])) {
        	$uUser = $_GET['u'];
         	//check user exists
         	$sql = "SELECT * FROM users WHERE username='$uUser'";
        	$check = $conn->query($sql);
        	if ($check->num_rows == 1) {
        		$get = $check->fetch_assoc();
        		$firstname = $get['first_name'];
        		$lastname = $get['last_name'];
        		$email = $get['email'];
        		$grade = $get['grade'];
        		if($grade == 9){
        			$grade = "Freshman";
        			$yearsleft = 3;
        		}else if($grade == 10){
        			$grade = "Sophomore";
        			$yearsleft = 2;
        		}else if($grade == 11){
        			$grade = "Junior";
        			$yearsleft = 1;
        		}else if($grade == 12){
        			$grade = "Senior";
        			$yearsleft = 0;
        		}
        		$year = date("Y");
        		$yearof = $year + $yearsleft;
        		$signupdate= $get['sign_up_date'];
        		$profilepic = $get['profile_pic'];
        		$bio = $get['bio'];
        		$sex = $get['sex'];
        		$interests = $get['interests'];
        		$dob = $get['dob'];
        		$relationship = $get['relationship'];
        		$interestedin = $get['interestedin'];
        		$friends = $get['friend_array'];
        		$midschool = $get['ms'];
        		$elemschool = $get['es'];
        		$talent = $get['talent'];
        		$favquote = $get['favquote'];
        		$hates = $get['hates'];
        			
        	} else {
        		echo "ERROR 5718 NO USER FOUND";
        		exit();
        	}
        	
        }else{
        	
         	//check user exists
         	$sql = "SELECT * FROM users WHERE username='$username'";
        	$check = $conn->query($sql);
        	if ($check->num_rows == 1) {
        		$get = $check->fetch_assoc();
        		$firstname = $get['first_name'];
        		$lastname = $get['last_name'];
        		$email = $get['email'];
        		$grade = $get['grade'];
        		if($grade == 9){
        			$grade = "Freshman";
        			$yearsleft = 3;
        		}else if($grade == 10){
        			$grade = "Sophomore";
        			$yearsleft = 2;
        		}else if($grade == 11){
        			$grade = "Junior";
        			$yearsleft = 1;
        		}else if($grade == 12){
        			$grade = "Senior";
        			$yearsleft = 0;
        		}
        		$year = date("Y");
        		$yearof = $year + $yearsleft;
        		$signupdate= $get['sign_up_date'];
        		$profilepic = $get['profile_pic'];
        		$bio = $get['bio'];
        		$sex = $get['sex'];
        		$interests = $get['interests'];
        		$dob = $get['dob'];
        		$relationship = $get['relationship'];
        		$interestedin = $get['interestedin'];
        		$friends = $get['friend_array'];
        		$midschool = $get['ms'];
        		$elemschool = $get['es'];
        		$talent = $get['talent'];
        		$favquote = $get['favquote'];
        		$hates = $get['hates'];
        			
        	}
        
        }
        if (isset($_POST['send'])) {
                $subject = $_POST['subject-text'];
                $post = $_POST['post'];
        	$to_user = $_POST['to-text'];
        	$cc_user = $_POST['cc-text'];
        	$bcc_user = $_POST['bcc-text'];
        	$visible_to = $to_user;
        	if (isset($_POST['cc-text']) && $cc_user!='') {
        		$visible_to = "$visible_to,$cc_user";
        	}
        	if (isset($_POST['bcc-text']) && $bcc_user!='') {
        		$visible_to = "$visible_to,$bcc_user";
        	}
        	if($post != ""){
        		date_default_timezone_set("America/Los_Angeles");
        		$date_added = date("Y/m/d");
        		$added_by = $username;
        		$user_posted_to = $to_user;
        		$time_added = date("h:i:sa");
        		
        		$sqlcommand = "INSERT INTO formalMessages VALUES ('', '$post', '$subject', '$added_by', '$user_posted_to', '$cc_user', '$bcc_user','$date_added', '$time_added')";
        		$query = $conn->query($sqlcommand) or die(mysql_error());
        		$msgid = $conn->insert_id;
        		$visible_to_user_array = split(',',$visible_to);
        		foreach($visible_to_user_array as $visible_user) {
        			$sql = "INSERT INTO msgVisibility VALUES ('$visible_user', '$msgid','0')";
        			$conn->query($sql);
        		}
        		
        	}else{
        		echo "You must enter something before posting.";
        	}
        }
        
        ?>

<style>

	.main-body{
		background-color: #E4E8EB;
	}
	.img-msg{
		
		width: 200px;
		position: absolute;
		top: 100px;
		left: 200px;
		
		max-height: 300px;
		
	}
	.form-text {
		width: 500px;
		position: relative;
		top: 50px;
		left: 450px;
		margin-bottom: 6px;
		height: 30px;
		padding-left: 15px;
		border: 1px solid #B5B9BB;
		border-radius: 5px;
	}
	.form-text:focus{
		border: 1px solid black;
	}
	#richTextField{	
		border:#000000 1px solid;
		width: 700px; 	
		height: 100px;
		background-color: white;
		
	}
	#wysiwyg_cp{
		padding:8px;
		width:700px;
		position: absolute;
		top: 330px;
		left: 300px;
	}
	#richTextField{
		position: absolute;
		top: 400px;
		left: 300px;
	}
	.btn-send{
		position: absolute;
		top: 550px;
		left: 600px;
	}
	.left-bar{
		position: absolute;
		left: 1050px;
		top: 100px;
	}

</style>
<div class="main-body">
	<div class = "left-bar">
		<?php
			include "left-sidebar.php";
		?>
	</div>
    <img class = "img-msg" src = "<?php echo $profilepic; ?>"></img>
    	
    <div class = "inputs">
    	<form method = "POST" action = "#">
    		<input type = "text" class = "to-user form-text" name = "to-text" placeholder = "message to:" value = "<?php echo $uUser; ?>" required /><br>
    		<input type = "text" class = "cc-user form-text" name = "cc-text" placeholder = "Send Copy to: (Seperate By Commas)" value = "" /><br>
    		<input type = "text" class = "bcc-user form-text" name = "bcc-text" placeholder = "Send Secret Copy to: (Seperate By Commas)" value = "" /><br>
<?php
    $subject = "";
    if (isset($_GET['s'])) {
        $subject = "Re:".$_GET['s'];
    }
    echo '    		<input type = "text" class = "subject-user form-text" name = "subject-text" placeholder = "Subject:" value = "'.$subject.'" required /><br>';
?>
    		
    		<div id="wysiwyg_cp" style="padding:8px; width:700px;" class = "btns">
	                    <div class="btn-group" data-toggle="buttons">
	                        <label class="btn btn-default" id = "bold">
	                        <input type="checkbox" onClick="boldActive(); iBold();" autocomplete="off" > <b>Bold</b>
	                        </label>
	                        <label class="btn btn-default" id = "underline">
	                        <input type="checkbox" onClick="underlineActive(); iUnderline();" autocomplete="off" > <u>Underline</u>
	                        </label>
	                        <label class="btn btn-default" id = "italic">
	                        <input type="checkbox" onClick="italicActive(); iItalic();" autocomplete="off" > <i>Italic</i>
	                        </label>
	                    </div>
	                    <input type="button" class = "btn btn-default" onClick="iFontSize()" value="Text Size">
	                    <input type="button" class = "btn btn-default" onClick="iForeColor()" value="Text Color">
	                    <input type="button" class = "btn btn-default btn-sm" onClick="iHorizontalRule()" value="HR">
	                    <input type="button" class = "btn btn-default btn-sm" onClick="iUnorderedList()" value="UL">
	                    <input type="button" class = "btn btn-default btn-sm" onClick="iOrderedList()" value="OL">
	                    <input type="button" class = "btn btn-default btn-sm" onClick="iLink()" value="Link">
	                    <input type="button" class = "btn btn-default btn-sm" onClick="iUnLink()" value="UnLink">
	                    <input type="button" class = "btn btn-default btn-sm" onClick="iImage()" value="Image">
	          </div>
	                <!-- Hide(but keep)your normal textarea and place in the iFrame replacement for it -->
	                <textarea style="display:none;" name="post" id="post" cols="2" rows="70"></textarea>
	                <iframe name="richTextField" id="richTextField"></iframe>
	                <!-- End replacing your normal textarea -->
	                <input type = "submit" onclick = "javascript: transferText();" class = "btn btn-primary btn-send" name = "send" />
                                       
    		
    	</form>
    </div>
    
</div>
<script>
    function boldActive(){
    	if(document.getElementById("bold").className == "btn btn-default"){
    		document.getElementById("bold").className = "btn btn-default active";
    	}
    	else if(document.getElementById("bold").className == "btn btn-default active"){
    		document.getElementById("bold").className = "btn btn-default";
    	}
    }   
    function underlineActive(){
    	if(document.getElementById("underline").className == "btn btn-default"){
    		document.getElementById("underline").className = "btn btn-default active";
    	}
    	else if(document.getElementById("underline").className == "btn btn-default active"){
    		document.getElementById("underline").className = "btn btn-default";
    	}
    } 
    function italicActive(){
    	if(document.getElementById("italic").className == "btn btn-default"){
    		document.getElementById("italic").className = "btn btn-default active";
    	}
    	else if(document.getElementById("italic").className == "btn btn-default active"){
    		document.getElementById("italic").className = "btn btn-default";
    	}
    } 	
</script>
<script>
    function transferText(){
        var origText = window.frames['richTextField'].document.body.innerHTML;
        origText = origText.replace(/&nbsp;/g,' ');
        document.getElementById("post").value = origText.replace(/\<img/,'<img width="200px"');
    }
    function iFrameOn(){
	richTextField.document.designMode = 'On';
    }
    
</script>
</body>
</html>