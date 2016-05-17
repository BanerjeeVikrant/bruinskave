<?php include "../php/connect.php"; ?>
<?php include "../php/header.php"; ?>
<style>
body{
	overflow-y: hidden;
	overflow-x: hidden;
}
#users-wrapper {
    display:inline-block;
    position: absolute;
    width: 25%;
    height: calc(100vh - 80px);
    border-right: 1px solid;
    margin-right: 2px;
    direction: ltr;
    border: 1px solid #aaaaaa;
    overflow-x: hidden;
    overflow-y: hidden;
    cursor: pointer;
}
#users-wrapper:hover {
    overflow-x: hidden;
    overflow-y: scroll;
}

/* Let's get this party started */
#users-wrapper::-webkit-scrollbar {
    width: 10px;
}
 
/* Track */
#users-wrapper::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    -webkit-border-radius: 15px;
    border-radius: 10px;
}
 
/* Handle */
#users-wrapper::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #4f3317; 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,1); 
}
#users-wrapper::-webkit-scrollbar-thumb:window-inactive {
	background: #111111;
}
#messages {
    display: inline-block;
    width: 60%;
    height: calc(100vh - 130px);
    float: left;   
    position: relative;
    left: calc(25% - 1px); 
    background-color: #f1f1f1;
    border: 1px solid grey;
    overflow-y: scroll;
    overflow-x: hidden;
}
/* Let's get this party started */
#messages::-webkit-scrollbar {
    width: 10px;
}
#messages::-webkit-scrollbar:hover ::-webkit-scrollbar-thumb{
    width: 20px;
}
 
/* Track */
#messages::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    

}
 
/* Handle */
#messages::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #cccccc; 
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,1); 
}
#messages::-webkit-scrollbar-thumb:window-inactive {
	background: #cccccc;;
}
.each-user{
    border: 1px solid #cccccc;
    padding: 5px;
    background-color: #fdfdfd;
}
.each-user:hover{
	background-color: #f1f1f1;
}
.chat-user-img {
    width: 55px;
    height: 55px;
    border-radius: 90px;
}
.each-message-wrapper {
    width: 100%;
    min-height: 42px;
}
.your-message {
    float: right;
    text-align: right;
    background-color: #20CEF5;
    color: white;
    padding: 4px;
    padding-left: 10px;
    padding-right: 11px;
    margin: 6px;
    border: 1px solid #f1f1f1;
    border-radius: 20px;
    font-family: verdana;
    max-width: 50%;
}
.their-message {
    float: left;
    background-color: #4f3317;
    color: white;
    padding: 4px;
    padding-left: 10px;
    padding-right: 11px;
    margin: 6px;
    border: 1px solid #f1f1f1;
    border-radius: 20px;
    font-family: verdana;
    max-width: 50%;
}
.toPic{
	width: 30px;
	height: 30px;
	float: left;
	margin-left: 10px;
	margin-top: 5px;
	border-radius: 45px;
}
#search-users {
    margin: 10px;
    width: 94%;
    font-family: verdana;
    border: 1px solid #ccc;
    border-radius: 20px;
    background: #fafafa;
    box-shadow: 2px 1px 5px #888888;
    padding-left: 10px;
}
#search-users:focus{
    box-shadow: 2px -1px 3px #888888;
    outline-width: 0;
    width: 94%;
}
.sendTextBox {
    background: #f4f4f4;
    position: absolute;
    top: calc(100vh - 51px);
    left: calc(25% - 1px);
    width: 60%;
    height: 50px;
    border: 1px solid #bbb;
}
#sendingText {
    margin: 10px;
    width: 97%;
    height: 30px;
    padding: 15px;
    padding-top: 15px;
    font-family: verdana;
    border-radius: 45px;
    border: 1px solid #aaa;
    outline-width: 0;
    resize: none;
    overflow: hidden;
}
</style>
<div style='position:relative; width: 100%;'>
<div id="users-wrapper">
	<input class = "search-user" id = "search-users" placeholder = "Lookup!" />
	<div id = "users">
		
	</div>
</div>
</div>
<div id="messages">
</div>
<div class = "sendTextBox">


<input type = 'text' name = 'sendingText' class = 'sendingText' sending-to = '' rows = '1' placeholder = 'Type a Message...' id = 'sendingText' autocomplete="off" ></input>
<input type = 'text' name = 'msg-id' id = 'msg-id' style = "display: none;" />

</div>
<script>
$(function() {
    $('#users').load('users.php', function() {
   
        $('.each-user').click(function(){
            lastid = 0;
            toId = $(this).attr('uid');
            $("#sendingText").attr("sending-to", toId);
            $("#msg-id").val(toId);
            url = '/v2/socialnetwork/bruins_chat/messages.php?from=<?php echo $username; ?>&toid='+toId;
            //alert(url);
            $('#messages').load(url, function() {
		var objDiv = document.getElementById("messages");
		objDiv.scrollTop = objDiv.scrollHeight;
		setTimeout(insertNewMsg,1000);
	    });
            //alert('from: <?php echo $username; ?>  toid: ' + toId);
        });
     });       
    
    $('#search-users').on("input", function()  {
        var search_users_by = this.value;
        $('#users').load('users.php?s='+search_users_by, function() {
	        $('.each-user').click(function(){
	        	lastid = 0;
			//alert('user clicked');
			toId = $(this).attr('uid');
			url = '/v2/socialnetwork/bruins_chat/messages.php?from=<?php echo $username; ?>&toid='+toId;
			//alert(url);
			$('#messages').load(url, function() {
				var objDiv = document.getElementById("messages");
				objDiv.scrollTop = objDiv.scrollHeight;
				setTimeout(insertNewMsg,1000);
				
			});
			//alert('from: <?php echo $username; ?>  toid: ' + toId);
	        });
        });
    });

});
var disable_msg_update = false;
$("#sendingText").keyup(function(event){
    if(event.keyCode == 13){
    	disable_msg_update = true;
    	var msgText = $("#sendingText").val();
	var sendingToId = $("#sendingText").attr("sending-to");	
	$.post( "add_msg.php", { sendmsg: msgText, sendto: sendingToId }, function() {disable_msg_update = false;});	
	$("#sendingText").val("");    	
    }
});

function insertNewMsg(){
	if (disable_msg_update) {
		setTimeout(insertNewMsg,1000);
		return;
	}
	lastid = $(".last_text").last().text();	
	url = '/v2/socialnetwork/bruins_chat/messages.php?from=<?php echo $username; ?>&toid='+toId+'&getnew='+lastid;	
	fromUser = "<?php echo $username; ?>";
	$.get("messages.php",{from : fromUser, toid : toId, getnew: lastid}, function(newMsgs) {		
		var info = newMsgs;
		if(info != ""){			
			$('#messages').append(newMsgs);
			var objDiv = document.getElementById("messages");
			objDiv.scrollTop = objDiv.scrollHeight;
		}
		setTimeout(insertNewMsg,1000);		
	});
}
</script>