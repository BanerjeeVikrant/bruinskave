<?php
include "php/connect.php";
?>
<?php
$classmatesString = $_GET['str'];
if ($classmatesString != "") {
		$classmatesArray = explode(",",$classmatesString);
		$countClassmates = count($classmatesArray);
}
?>
<div>
<?php
	if ($countClassmates != 0) {
		foreach ($classmatesArray as $value) {
			$getClassmateQuery = $conn->query("SELECT * FROM users WHERE username='$value' LIMIT 1");
			$getClassmateRow = $getClassmateQuery->fetch_assoc();
			$classmateUsername = $getClassmateRow['username'];
			$classmateFirst = $getClassmateRow['first_name'];
			$classmateLast = $getClassmateRow['last_name'];
			$classmateProfilePic = $getClassmateRow['profile_pic'];

			if ($classmateProfilePic == "") {
				echo "<a href='php/profile.php?u=$classmateUsername'><img src='https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg' height='85' width='85' style='margin-right: 10px; margin-bottom: 5px;'></a>";
			}
			else{
				echo "<a href='php/profile.php?u=$classmateUsername'><img src='$classmateProfilePic' height='85' width='85' style='margin-right: 10px; margin-bottom: 5px;'></a>";
			}
		}
	}else{
		echo $profileUser. " has no friends yet.";
	}
?>
</div>