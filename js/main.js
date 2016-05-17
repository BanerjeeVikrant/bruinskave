// FindFriends main Javascript file
function send_post() {
    var hr = new XMLHttpRequest();
    var url = "../send_post.php";
    var fn = document.getElementById("post").value;
    var to_user = document.getElementById("username").innerHTML;
    var vars = "to="+to_user+"&post="+fn;
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	if(hr.readyState == 4 && hr.status == 200) {
	    window.location.reload();	
	}   
    }
    hr.send(vars);
    document.getElementById("status").innerHTML = "processing...";
}

function shiftinfo(){
    var origText = window.frames['richTextField'].document.body.innerHTML;
    origText = origText.replace(/&nbsp;/g,' ');
    document.getElementById("post").value = origText.replace(/\<img/,'<img width="200px" ');
}

function post(){
		
	shiftinfo();
	send_post();
}