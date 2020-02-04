document.write(
 '<div onload="loggedIn();" id="navbar" class="navbar container">\
		<div class = "row">\
			<div class="nl">\
				<a href="./index.php"><img class="navLogo" src="FantasyLogo000.png" \></a>\
			</div>\
			<div id="home" class="menubar">\
				<a href="./index.php" class="menubartext">Home</a>\
			</div>\
			<div id="team" class="menubar-none">\
				<a href="./myTeam.php" class="menubartext">My Team</a>\
			</div>\
			<div id="league" class="menubar-none">\
				<a href="./leagues.php" class="menubartext">League Home</a>\
			</div>\
			<div id="teams" class="menubar">\
				<a href="./team.php" class="menubartext">Teams</a>\
			</div>\
			<div id="login" class="menubar menuBarRight">\
				<a href="./login.php" class="menubartext">Login</a>\
			</div>\
			<div id="register" class="menubar menuBarRight">\
				<a href="./register.php" class="menubartext">Register</a>\
			</div>\
			<div id="profile" class="menubar-none" style="display: none">\
				<a id="profileName" href="./profile.php" class="menubartext" style="display: none"></a>\
			</div>\
			<div id="out" class="menubar-none" style="display: none">\
				<a id="signOut" href = "./signOut.php" class="menubartext" style="display: none">Sign Out</a>\
			</div>\
			<div id="n2" class="n2">\
				<img id="navLogoMobile" class="navLogoMobile" src="./finalColorFantasyLogo.png?version=1"/>\
			</div>\
			<div class="menubarbottom">\
					<p id="menubartextbottom" class="menubartextbottom" onclick="menufunction();">&#9586&#9585</p>\
			</div>\
		</div>\
	</div>'
);

//Writes the navbar to every page just add <script src="js/nav.js"></script>