
<?php
$error = null;
$loggedIn = false;
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$email = true;
	if(preg_match('~(\w+)@(gmail|yahoo|icloud|hotmail|outlook|aol)(\.com|\.net)~', $username)) {
		$email = true;
	} else {
		$email = false;
	}
	$hashed_password = hash('whirlpool', $password);
	
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$query = null;
	if($email) {
		$query = "SELECT * FROM fantasyusers WHERE email='".$username."'";
	} else {
		$query = "SELECT * FROM fantasyusers WHERE name='".$username."'";
	}
	$result = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result) === 0) {
		$error = "Incorrect Username and/or Password";
	} else {
		$row = mysqli_fetch_assoc($result);
		$username = $row['name'];
		$dbpass = $row['password'];
		if($hashed_password === $dbpass) {
			$loggedIn = true;
			$online = 1;
			$query = "UPDATE fantasyusers SET online = 1 WHERE id='".$row['id']."'";
			mysqli_query($conn,$query);
		}
	}
}

if($loggedIn) {
	$cookie_name = "username";
	$cookie_value = $username;
	echo "<script>console.log('" . $cookie_value . "');</script>";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	echo "<script>window.location.href = 'https://techhounds.com/FRC%20Fantasy/index.html'</script>";
}
?>

<html>
	<head>
        <title>Login - FantasyFRC</title>
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
                <h1>Login</h1>
                <label for="username">Username: </label>
                <input name="username" id="username" type="text" /></br>
                <label for="password">Password: </label>
                <input name="password" id="password" type="password" /></br>
                <input type="submit" value="Log In" onclick="loggedIn()"/>
            </form>
        </div>
	</body>
</html>