document.write(
'<nav onload="loggedIn();" class="navbar navbar-expand-lg navbar-dark bg-dark">\
	<a class="navbar-brand" href="#">\
		<img src="./FantasyLogo000.png" width="175" height="60" alt="">\
	</a>\
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">\
		<span style="color: #f1f1f1;"><i class="fas fa-bars"></i></span> \
	</button>\
	\
	<div class="collapse navbar-collapse bg-dark" id="navbarNav">\
		<ul class="navbar-nav mr-auto">\
			<!--<li class="nav-item">\
				<a class="nav-link text-white" href="./login.php">Login<span class="sr-only">(current)</span></a>\
			</li>-->\
			<li class="nav-item">\
				<a class="nav-link text-white" href="./about.html">About</a>\
			</li>\
			<li id="team" style="display:none;" class="nav-item">\
				<a class="nav-link text-white" href="./myTeam.php">My Team</a>\
			</li>\
			<li id="league" class="nav-item">\
				<a class="nav-link text-white" href="./leagues.php">League Home</a>\
			</li>\
			</ul>\
			\
			<ul class="navbar-nav ml-auto">\
			<li id="register" class="nav-item">\
				<a class="nav-link text-white" href="./register.php">Register</a>\
			</li>\
			<li id="login" class="nav-item">\
				<a class="nav-link text-white" href="./login.php">Log In</a>\
			</li>\
			<li id="profile" class="nav-item">\
				<a id="profileName" class="nav-link text-white" href="./verify.php" style="display:none"></a>\
			</li>\
			<li id="out" class="nav-item">\
				<a id="signout" class="nav-link text-white" style="display:none" href="./signOut.php">Sign Out</a>\
			</li>\
		</ul>\
	</div>\
</nav>'
);

//Writes the navbar to every page just add <script src="js/nav.js"></script>
