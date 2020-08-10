
setTimeout(function(){
document.querySelector(".sqlResult").classList.add("transparent");
	setTimeout(function(){
		document.querySelector(".sqlResult").classList.add("hidden");
	}, 1000);
}, 3000);

function SendAjaxRequest(method, link, isAsync){
	var result;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			result = this.responseText;
		}
	}
	xhttp.open(method, encodeURI(link), isAsync);
	xhttp.setRequestHeader("Content-type", "text/html; charset=utf-8");
	xhttp.send();
	return result;
}

////////////////////// BIPER //////////////////////

// currFileName and currUserName defined in footer.php

var audio = new Audio('sounds/Google_Event-1.mp3');
audio.muted=false;
audio.volume = 0.2;
var docs = [
	"PP",
	"WP",
	"NP",
	"FIRE"
];
docs.forEach(function(item){
	window[item+"Amount"] = null;
if(localStorage.getItem(item+"DocAlertStop") == "false")
	BiperAlert(item);
});

BiperCheckLoop();
function BiperCheckLoop(){
	if(currFileName == "piwnica_new.php"){
		PPAmount = SendAjaxRequest("GET", "ajax requests/getPPDocsAmount.php", false)
		document.getElementById("PPDocsAmount").innerHTML = PPAmount;
		
		WPAmount = SendAjaxRequest("GET", "ajax requests/getWPDocsAmount.php", false)
		document.getElementById("WPDocsAmount").innerHTML = WPAmount;

		NPAmount = SendAjaxRequest("GET", "ajax requests/getNPDocsAmount.php", false)
		document.getElementById("NPDocsAmount").innerHTML = NPAmount;
		
		FIREAmount = SendAjaxRequest("GET", "ajax requests/getFIREDocsAmount.php", false)
	}
	else if (currFileName == "employee.php"){
		PPAmount = SendAjaxRequest("GET", "ajax requests/getPPDocsAmountByUser.php?user=" + currUserName, false);
		document.getElementById("PPDocsAmount").innerHTML = PPAmount;
		
		FIREAmount = SendAjaxRequest("GET", "ajax requests/getFIREDocsAmountByUser.php?user=" + currUserName, false)
	}
	docs.forEach(function(doc){
		if(window[doc+"Amount"] > localStorage.getItem(doc+"Amount") && localStorage.getItem(doc+"Amount") != null && localStorage.getItem(doc+"Amount") != "")
			BiperAlert(doc);
		if(window[doc+"Amount"] != null && window[doc+"Amount"] != "")
			localStorage.setItem(doc+"Amount", window[doc+"Amount"]);
	})
	
	setTimeout(function(){
		BiperCheckLoop();
	}, 5000);
}


function BiperAlertLoop(led){
	var canPlay = false;
	docs.forEach(function(doc){
		if(localStorage.getItem(doc+"DocAlertStop") == "false")
		canPlay = true;
	});

	if(canPlay)
	{
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
function BiperAlert(doc){
	var ledLight;
	localStorage.setItem(doc + "DocAlertStop", false);

	document.getElementById(doc+"alert").classList.add("active");
	ledLight = document.querySelector("#"+doc+"alert .led-yellow");
	if(ledLight == null)
		ledLight = document.querySelector("#"+doc+"alert .led-red");
	BiperAlertLoop(ledLight);


	document.querySelector("#"+doc+"alert .icon-cancel").addEventListener("click", function(){
		document.getElementById(doc+"alert").classList.remove("active");
		localStorage.setItem(doc+"DocAlertStop", true);
		localStorage.setItem(doc+"Amount", window[doc+"amount"]);
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

