
setTimeout(function(){
document.querySelector(".sqlResult").classList.add("transparent");
	setTimeout(function(){
		document.querySelector(".sqlResult").classList.add("hidden");
	}, 1000);
}, 3000);


if(sessionStorage.getItem("scrollPos") != null){
	window.scroll(0, parseInt(sessionStorage.getItem("scrollPos")));
}
window.addEventListener('scroll', function(e){
	sessionStorage.setItem("scrollPos", window.scrollY);
})


function SendAjaxRequest(method, link, isAsync){
	var result;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			result = this.responseText;
		}
	}
	xhttp.open(method, encodeURI(link), isAsync);
	xhttp.send();
	return result;
}

////////////////////// BIPER //////////////////////

// currFileName and currUserName defined in footer.php

var audio = new Audio('sounds/Google_Event-1.mp3');
audio.volume = 0.2;
var PPAmount = null;
var WPAmount = null;
var FIREAmount = null;
BiperCheckLoop();
function BiperCheckLoop(){
	if(currFileName == "piwnica_new.php"){
		PPAmount = SendAjaxRequest("GET", "ajax requests/getPPDocsAmount.php", false)
		document.getElementById("PPDocsAmount").innerHTML = PPAmount;
		
		WPAmount = SendAjaxRequest("GET", "ajax requests/getWPDocsAmount.php", false)
		document.getElementById("WPDocsAmount").innerHTML = WPAmount;
		
		FIREAmount = SendAjaxRequest("GET", "ajax requests/getFIREDocsAmount.php", false)
	}
	else if (currFileName == "employee.php"){
		PPAmount = SendAjaxRequest("GET", "ajax requests/getPPDocsAmountByUser.php?user=" + currUserName, false);
		document.getElementById("PPDocsAmount").innerHTML = PPAmount;
		
		FIREAmount = SendAjaxRequest("GET", "ajax requests/getFIREDocsAmountByUser.php?user=" + currUserName, false)
	}
	if(PPAmount > localStorage.getItem("PPAmount") && localStorage.getItem("PPAmount") != null && localStorage.getItem("PPAmount") != "")
		BiperAlert("PP");
	if(PPAmount != null && PPAmount != "")
		localStorage.setItem("PPAmount", PPAmount);
	
	
	if(WPAmount > localStorage.getItem("WPAmount") && !(localStorage.getItem("WPAmount") == null || localStorage.getItem("WPAmount") == ""))
		BiperAlert("WP");
	if(WPAmount != null && WPAmount != "")
		localStorage.setItem("WPAmount", WPAmount);
	
	if(FIREAmount > localStorage.getItem("FIREAmount") && !(localStorage.getItem("FIREAmount") == null || localStorage.getItem("FIREAmount") == ""))
		BiperAlert("FIRE");
	if(FIREAmount != null && FIREAmount != "")
		localStorage.setItem("FIREAmount", FIREAmount);
	
	setTimeout(function(){
		BiperCheckLoop();
	}, 5000);
}

if(localStorage.getItem("PPDocAlertStop") == "false")
	BiperAlert("PP");
if(localStorage.getItem("WPDocAlertStop") == "false")
	BiperAlert("WP");
if(localStorage.getItem("FIREDocAlertStop") == "false")
	BiperAlert("FIRE");


function BiperAlertLoop(led){
	if(localStorage.getItem("PPDocAlertStop") == "false" || localStorage.getItem("WPDocAlertStop") == "false" || localStorage.getItem("FIREDocAlertStop") == "false"){
		if(led.classList.contains("led-yellow"))
			led.style.animation = "blinkYellow 2s 1";
		else if (led.classList.contains("led-red"))
			led.style.animation = "blinkRed 2s 1";
		
		setTimeout(function(){
			audio.play();
		},200);
		setTimeout(function(){
			led.style.animation = "none";
			void led.offsetWidth;
			BiperAlertLoop(led);
		}, 3000);
	} 
}
//BiperAlert("FIRE");
function BiperAlert(doc){
	var ledLight;
	localStorage.setItem(doc + "DocAlertStop", false);
	if(doc == "PP"){
		document.getElementById("PPalert").classList.add("active");
		ledLight = document.querySelector("#PPalert .led-yellow");
		BiperAlertLoop(ledLight);
	}
	else if(doc == "WP"){
		document.getElementById("WPalert").classList.add("active");
		ledLight = document.querySelector("#WPalert .led-yellow");
		BiperAlertLoop(ledLight);
	}
	else if (doc == "FIRE"){
		document.getElementById("FIREalert").classList.add("active");
		ledLight = document.querySelector("#FIREalert .led-red");
		BiperAlertLoop(ledLight);
	}
	if(document.querySelector("#PPalert .icon-cancel") != null)
	document.querySelector("#PPalert .icon-cancel").addEventListener("click", function(){
		document.getElementById("PPalert").classList.remove("active");
		localStorage.setItem("PPDocAlertStop", true);
		localStorage.setItem("PPAmount", PPAmount);
		audio.pause();
		audio.currentTime = 0;
	});
	if(document.querySelector("#WPalert .icon-cancel") != null)
	document.querySelector("#WPalert .icon-cancel").addEventListener("click", function(){
		document.getElementById("WPalert").classList.remove("active");
		localStorage.setItem("WPDocAlertStop", true);
		localStorage.setItem("WPAmount", WPAmount);
		audio.pause();
		audio.currentTime = 0;
	});
	if(document.querySelector("#FIREalert .icon-cancel") != null)
	document.querySelector("#FIREalert .icon-cancel").addEventListener("click", function(){
		document.getElementById("FIREalert").classList.remove("active");
		localStorage.setItem("FIREDocAlertStop", true);
		localStorage.setItem("FIREAmount", FIREAmount);
		audio.pause();
		audio.currentTime = 0;
	});
}

////////////// <select> color changes /////////////////

function changeSelectColor(sel){
  sel.style.color = sel.options[sel.selectedIndex].style.color;
}
var selects = document.querySelectorAll(".colorSelect");
for(i = 0; i < selects.length; i++){
	changeSelectColor(selects[i]);
	selects[i].addEventListener("change", function(){
		changeSelectColor(this);
	});
}

