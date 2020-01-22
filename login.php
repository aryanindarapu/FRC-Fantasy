
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
		
		$dbpass = $row['password'];
		if($hashed_password === $dbpass) {
			$loggedIn = true;
			$online = 1;
			$query = "UPDATE fantasyusers SET online = 1 WHERE id='".$row['id']."'";
			mysqli_query($conn,$query);
		}
	}
	
}

?>

<html>
	<head>
        <title>Login - FantasyFRC</title>
        <link rel="stylesheet" type="text/css" href="fantasy.css?version=12">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=12"></script>
	</head>
	<body style="background-color:#cccccc">
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
				<a href="https://techhounds.com/FRC%20Fantasy/league.html" class="menubartext">League Home</a>
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
			<div id="profile" class="menubar menuBarRight">
				<p id="profileName" href="" class="menubartext"></p>
			</div>
			<div id="n2" class="n2">
				<img id="navLogoMobile" class="navLogoMobile" src="finalColorFantasyLogo.png?version=1"/>
			</div>
			<div class="menubarbottom">
					<p id="menubartextbottom" class="menubartextbottom" onclick="menufunction();">&#9586&#9585</p>
			</div>
		</div>
		
		<?php
			if($loggedIn) {
				echo "<script type='text/javascript'> setValues(); </script>";
				sleep(1);
				echo "<div class='success'><p>Logged in. Redirecting in 5 seconds..</p></div>";
				sleep(5);
				header("Location:"."http://www.techhounds.com/FRC%20Fantasy/index.html");
			} else if($error != null) {
				echo "<div class='error'><p>".$error."</p></div>";
			}
		?>
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