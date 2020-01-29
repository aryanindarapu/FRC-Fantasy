<!DOCTYPE html>
<html>
	<head>
		<title>FantasyFRC</title>
        <link rel="stylesheet" type="text/css" href="fantasy.css?version=24">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=24"></script>
	</head>
	<body style="background-color:#cccccc" onload="loggedIn();">
		<div id="navbar" class="navbar">
			<div class="nl">
				<a href="https://techhounds.com/FRC%20Fantasy/index.html"><img class="navLogo" src="finalColorFantasyLogo.png?version=1" /></a>
			</div>
			<div id="home" class="menubar">
				<a href="https://techhounds.com/FRC%20Fantasy/index.html" class="menubartext">Home</a>
			</div>
			<div id="team" class="menubar">
				<p class="menubartext">My Team</p>
			</div>
			<div id="league" class="menubar">
				<a href="https://techhounds.com/FRC%20Fantasy/league.php" class="menubartext">League Home</a>
			</div>
			<div id="teams" class="menubar">
				<p class="menubartext">Teams</p>
			</div>
			<div id="register" class="menubar menuBarRight">
				<a href="https://techhounds.com/FRC%20Fantasy/register.php" class="menubartext">Register</a>
			</div>
			<div id="login" class="menubar menuBarRight">
				<a href="https://techhounds.com/FRC%20Fantasy/login.php" class="menubartext">Login</a>
			</div>
			<div id="profile" class="menubar menuBarRight" style="display: none">
				<p id="profileName" class="menubartext" style="display: none"></p>
			</div>
			<div id="out" class="menubar menuBarRight" style="display: none">
				<a id="signOut" href = "./signOut.php" class="menubartext" style="display: none">Sign Out</a>
			</div>
			<div id="n2" class="n2">
				<img id="navLogoMobile" class="navLogoMobile" src="finalColorFantasyLogo.png?version=1"/>
			</div>
			<div class="menubarbottom">
					<p id="menubartextbottom" class="menubartextbottom" onclick="menufunction();">&#9586&#9585</p>
			</div>
		</div>
		
		<div class="leaguetop">
			<div>
				<p>
			</div>
		</div>
	</body>
</html>