function changeText(){
    var origText = window.frames['richTextField'].document.body.innerHTML;
    origText = origText.replace(/&nbsp;/g,' ');
    document.getElementById("post").value = origText.replace(/\<img/,'<img width="200px" ');
}
function send_message() {
    var hr = new XMLHttpRequest();
    var url = "../send_message.php";
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
document.getElementById("status").innerHTML = "processing...";
}

function transferText(){
	alert("Called");
	changeText();
	alert("Changed text");
	send_message();
}