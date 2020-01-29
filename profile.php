<!DOCTYPE php>
<?php
$username = null;
$password = null;
$query = null;
$error = null;
$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');

if(mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
	
if(isset($_COOKIE["username"])){
	$username = $_COOKIE["username"];
	if(isset($_POST['password'])) {
		$password = $_POST['password'];
		$hashed_password = hash('whirlpool', $password);
		$query = "SELECT * FROM fantasyusers WHERE name='".$username."'";
		$result = mysqli_query($conn, $query);

		if(mysqli_num_rows($result) === 0) {
			$error = "Incorrect Username and/or Password";
		} else {
			$row = mysqli_fetch_assoc($result);
			$username = $row['name'];
			$dbpass = $row['password'];
			$email = $row['email'];
			if($hashed_password === $dbpass) {
				//Run your code here (Or set a global value to run it other places)
				echo "<script>document.getElementById('profUser').innerHTML = '". $username ."';</script>";
				echo "<script>document.getElementById('profEmail').innerHTML = '". $email ."';</script>";
				echo "<script>settings();</script>";
				echo "<script>console.log('Settings visible!')</script>";
			} else {
				$error = "Incorrect Password!";
			}
		}
	}
} else {
	echo "<script>window.location.href = 'https://techhounds.com/FRC%20Fantasy/login.php';</script>";
}

if($error != null) {
	echo "<div class='error'>";
	echo "<p> ERROR: ".$error."</p>";
	echo "</div>";
}
?>
<html>
	<head>
        <title>Profile - FantasyFRC</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=33">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=33"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
	</head>
	<body  style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src='nav.js?version=33'></script>
		<div class="box">
            <form method="post" name="login" action="">
                <h1>Verify Your Account</h1>
                <label for="password">Password: </label>
                <input name="password" id="password" type="password" /></br>
                <input type="submit" value="Enter" onclick="loggedIn()"/>
            </form>
        </div>
		<div id="prof" style="display: none"
			<h2>Profile Information</h2>
			<div class="net">
				<div class="paper">
					<p>Username</p>
					<p id="profUser">
					<p>Email</p>
					<p id="profEmail"></p>
				</div>
			</div>
			<h2>Settings</h2>
			<div class="net">
				<div class="paper">
					<p>Reset Password</p>
					<p>Deactivate Account</p>
				</div>
			</div>
		</div>
	</body>
</html>