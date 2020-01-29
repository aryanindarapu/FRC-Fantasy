<!DOCTYPE html>
<html>
	<head>
		<title>Register - Fantasy FRC</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=24">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=24"></script>
	</head>
	<body style="background-color:#cccccc" onload="loggedIn();">
		<?php
		$error = null;
		if(isset($_POST['username'])){
			ini_set('mysql.connect_timeout', 300);
			ini_set('default_socket_timeout', 300); 
			//here we get the values posted from the form, as php variables
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password_as_string = $_POST['password'];
			//preg_match('(\w+)@(gmail|yahoo|icloud|hotmail|outlook|aol)(\.com|\.net)', $email,$matches, PREG_UNMATCHED_AS_NULL);
			
			$hashed_password = hash('whirlpool',$password_as_string);
			
			$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
			
			if(mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$username_set = isset($_POST['username']) && ($username != "");
			//First: Check If username exists in database
			if($username_set) {
				$query = 'INSERT INTO fantasyusers (name,password,email) VALUES ("'.$username.'","'.$hashed_password.'","'.$email.'");';
				mysqli_query($conn,$query);
				$newQuery = "UPDATE fantasyusers SET online = 0 WHERE name = '".$username."';";
				mysqli_query($conn,$newQuery);
			} else {
				$error = "INVALID USERNAME";
			}
		}
			
			if($error != null) {
				echo "<div class='error'>";
				echo "<p> ERROR: ".$error."</p>";
				echo "</div>";
			}
		?>
		<div id="navbar" class="navbar">
			<div class="nl">
				<a href="https://techhounds.com/FRC%20Fantasy/index.html"><img class="navLogo" src="finalColorFantasyLogo.png?version=1" /></a>
			</div>
			<div id="home" class="menubar">
				<a href="https://techhounds.com/FRC%20Fantasy/index.html" class="menubartext">Home</a>
			</div>
			<div id="team" class="menubar">
				<a href="https://techhounds.com/FRC%20Fantasy/myTeam.php" class="menubartext">My Team</a>
			</div>
			<div id="league" class="menubar">
				<a href="https://techhounds.com/FRC%20Fantasy/league.php" class="menubartext">League Home</a>
			</div>
			<div id="teams" class="menubar">
				<a href="https://techhounds.com/FRC%20Fantasy/team.php" class="menubartext">Teams</a>
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
		
		<div class="box">
			<form method="post" name="login" action="">
				<h1>FRC Fantasy Register</h1>
				<label for="email" class="input">Email</label></br>
				<input name="email" id="email" placeholder="Email"type="text" required></br>
				<label for="username" class="input">Username:</label></br>
				<input name="username" id="username" placeholder="Username" type="text" required></br>
				<label for="password" class="input">Password:</label></br>
				<input name="password" id="password" placeholder="Password" type="password" required></br></br>
				<input type="submit" value="Register" class="button"/>
			</form>
		</div>
	</body>
	
	<script>
	function redirectToLogin() {
		window.location.replace("http://www.techhounds.com/FRC%20Fantasy/login.php");
	}
	</script>
</html>