
var container = document.getElementById("workersTableContainer");
var popup = document.getElementById("workersTablePopup");
var openers = document.getElementsByClassName("workerTableOpener");
var i;


for (i = 0; i < openers.length; i++) {
	openers[i].addEventListener("click", function() {
		var opener = this;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				container.innerHTML = this.responseText;
				popup.classList.add("active");
				localStorage.setItem("currOpenWorkerListId", opener.id)
				SetUpAjaxSortLinks();
			}
		}
		xhttp.open("GET", encodeURI("ajax requests/workerDocList.php?userName=" + opener.id), true);
		xhttp.send();
	});
}
if(document.getElementById("workersTableCloseButton") != null)
	document.getElementById("workersTableCloseButton").addEventListener("click", function(){
		document.getElementById("workersTablePopup").classList.remove("active");
	});

var closers = document.getElementsByClassName("workerTableCloser");
for (i = 0; i < closers.length; i++) {
	closers[i].addEventListener("click", function(){
		popup.classList.remove("active");
	});
};
	
function SetUpAjaxSortLinks(){
	var sortLinks = document.getElementsByClassName("workerTableSortLink");
	for (i = 0; i < sortLinks.length; i++) {
		sortLinks[i].addEventListener("click", function(){
			var link = this;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if (this.readyState == 4 && this.status == 200){
					container.innerHTML = this.responseText;
					popup.classList.add("active");
					SetUpAjaxSortLinks();
				}
			}
			var sortQuery = this.id;
			sortQuery = sortQuery.replace("?", "&");
			xhttp.open("GET", "components/workerDocList.php?userName=" + localStorage.getItem("currOpenWorkerListId") + sortQuery, true);
			xhttp.send();
		});
	};
}
