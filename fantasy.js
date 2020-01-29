/*
	In mobile mode, opens and closes menu
*/
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

/*
	Splits up cookie into parts to get cookie value
*/
function getCookie() {
	var name = "username=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

var user = getCookie();

/*
	If user is logged in: 
		- remove register/sign in buttons
		- add profile/log out buttons
		- display username
*/
function loggedIn() {
	if(user != ""|null) {
		document.getElementById("login").removeChild(document.getElementById("login").childNodes[1]);
		document.getElementById("login").remove();
		document.getElementById("register").removeChild(document.getElementById("register").childNodes[1]);
		document.getElementById("register").remove();
		document.getElementById("profile").style.display = "inline-block";
		document.getElementById("profileName").style.display = "inline-block";
		document.getElementById("profileName").innerHTML = user;
		document.getElementById("out").style.display = "inline-block";
		document.getElementById("signOut").style.display = "inline-block";
	}
}

function settings() {
	document.getElementById("verify").style.display = "none";
	document.getElementById("prof").style.display = "inline-block";
}