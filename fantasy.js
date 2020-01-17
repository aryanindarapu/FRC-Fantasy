function menufunction() {
	if(getComputedStyle(document.getElementById("home"),null).display == "block") { 
		console.log("Success!");
		document.getElementById("home").style.display = "none";
		document.getElementById("team").style.display = "none";
		document.getElementById("league").style.display = "none";
		document.getElementById("teams").style.display = "none";
		document.getElementById("register").style.display = "none";
		document.getElementById("login").style.display = "none";
		document.getElementById("navbar").style.minHeight = "81px";
		document.getElementById("navbar").style.height = "81px";
		document.getElementById("menubartextbottom").innerHTML = "&#9586&#9585";
		document.getElementById("n2").style.display = "block";
		document.getElementById("navLogoMobile").style.display = "block";
	} else if(getComputedStyle(document.getElementById("home"),null).display == "none") { 
		console.log("Success!");
		document.getElementById("home").style.display = "block";
		document.getElementById("team").style.display = "block";
		document.getElementById("league").style.display = "block";
		document.getElementById("teams").style.display = "block";
		document.getElementById("register").style.display = "block";
		document.getElementById("login").style.display = "block";
		document.getElementById("navbar").style.minHeight = "250px";
		document.getElementById("menubartextbottom").innerHTML = "&#9585&#9586";
        document.getElementById("n2").style.display = "none";
		document.getElementById("navLogoMobile").style.display = "none";
	} else {
		console.log("Failed");
	}
}

function loggedIn() {
	if (localStorage.getItem("username") != null) {
		document.getElementById("login").style.display = "none";
		document.getElementById("login").childNodes[1].style.display = "none";
		document.getElementById("register").style.display = "none";
		document.getElementById("register").childNodes[1].style.display = "none";
		document.getElementById("profile").style.display = "inline-block";
		document.getElementById("profileName").style.display = "inline-block";
		document.getElementById("profileName").innerHTML = localStorage.getItem("username");
	}
}