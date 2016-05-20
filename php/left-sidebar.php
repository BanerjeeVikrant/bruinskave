

<style>
.links-sidebar{
	background-color: white;
	width: 200px;
	height: 40px;	
	padding-top: 10px;
	border-bottom: 1px solid #aaa;
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	font-family: verdana;
	font-size: 16px;
}
#s{
	width: 100px;
	height: 30px;
	font-size: 15px;
}

.textlinks-sidebar{
	padding-left: 20px;
	
}
.a-links-sidebar{
	text-decoration: none !important;
	color: black;
	
}
.links-sidebar:hover{
	background-color: #4f3317;
	color: white;
}   

#searchSubmit{
	position: relative;
	top: 10px;
	bottom: 5px;
	left: 60px;
}
	

             
</style>
                
                <div class="sidebar">
 
                    <div class="input">
                        <input type="text" class="search form-control" id="s" placeholder="Search&hellip;" />
                    </div>
                    
                    <input type="submit" id="searchSubmit" class="btn btn-primary" autocomplete="off" value="Search" />
    
                    <div class="side-links">
                        <a class = "a-links-sidebar" href="profile.php?u=<?php echo $username ?>"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Profile</span></div></a>
                        <a class = "a-links-sidebar" href="../home.php"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Newfeed</span></div></a>
                        <a class = "a-links-sidebar" href="findfriends.php?u=<?php echo $username ?>"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Friends</span></div></a>
                        <a class = "a-links-sidebar" href="friend_requests.php"><div class = "links-sidebar"><span class = "textlinks-sidebar">Friend Requests</span></div></a>
                        <a class = "a-links-sidebar" href="my_msg.php"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Inbox</span></div></a>
                        <a class = "a-links-sidebar" href="account_settings.php"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Settings</span></div></a>
                        <a class = "a-links-sidebar" href="#"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Messenger</span></div></a>
                        <a class = "a-links-sidebar" href="#"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Groups</span></div></a>
                        <a class = "a-links-sidebar" href="#"><div class = "links-sidebar"><span class = "textlinks-sidebar">Random Hi's</span></div></a>
                        <a class = "a-links-sidebar" href="#"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Pages</span></div></a>
                        <a class = "a-links-sidebar" href="#"><div class = "links-sidebar"><span class = "textlinks-sidebar">My Privacy</span></div></a>
                    </div>
                </div>
                
                <script>
                usrArr = [<?php
                    $sql = "SELECT username,first_name,last_name FROM users WHERE 1";
                    $result = $conn->query($sql);
                    $rowCnt = $result->num_rows;

                    for ($i=0; $i < $rowCnt; $i++) {
                    	$row = $result->fetch_assoc();
                    	if ($i != 0) { echo ","; }
                    	echo '["'.$row['first_name'].'","'.$row['last_name'].'","'.$row['username'].'"]';
                    }
                ?>];
                function matchingUsers(search_str) {
                	var usrs = [];
                		
                	if (search_str.length > 0) {
                		for (i = 0; i < usrArr.length; i++) { 
                		    // alert("Name: "+ usrArr[i][0]+" "+usrArr[i][1] +"starts with "+search_str+":"+usrArr[i][0].startsWith(search_str));
				    if (usrArr[i][0].toLowerCase().startsWith(search_str.toLowerCase()) || usrArr[i][1].toLowerCase().startsWith(search_str.toLowerCase())) {
				    	usrs.push(usrArr[i][2]);
				    }
				}
                	}
                	return usrs;
                }
                $(function() {
                	$('#searchSubmit').click(function() {
                		window.location.assign("/bruinskave/php/search-result.php?users="+matchingUsers($('#s').val()));
                	});
                });
                $("#s").keyup(function(event){
		    if(event.keyCode == 13){
		        $("#searchSubmit").click();
		    }
		});
		$('#s').focus(function()
		{
		    /*to make this flexible, I'm storing the current width in an attribute*/
		    $(this).attr('data-default', $(this).width());
		    $(this).animate({ width: 200 }, 'slow');
		}).blur(function()
		{
		    /* lookup the original width */
		    
		    $(this).animate({ width: 100 }, 'slow');
		});
                </script>