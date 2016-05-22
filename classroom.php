<?php 
	include "php/connect.php";
	include "php/header.php";
?>
<?php
if(isset($_GET['p'])){
	$p = $_GET['p']; 
}else{
	$p = 1;
}


?>
<style>

</style>
<div class = "top-section">
	<img src = "<?php echo $banner; ?>"></img>
	<span class = "classSub"><?php echo $classSub; ?></span>
	<span class = "classPer"><?php echo $classPer; ?></span>
</div>
<div class = "optionBar">
	<div class = "activityLog">Activities</div>
	<div class = "classmatesLog">Classmates</div>
	<div class = "playLog">Play</div>
	<div class = "resultsLog">Results</div>
	<div class = "AboutLog">About</div>
</div>
</body>
</html>