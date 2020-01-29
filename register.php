<!DOCTYPE html>
<html>
	<head>
		<title>Register - Fantasy FRC</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=26">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=26"></script>
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
			$query = "select * from fantasyusers where name = '".$username."' or email = '".$email."';";
			$duplicate = false;
			$results = mysqli_query($conn, $query);
			if (mysqli_num_rows($results) !== 0) {
				$duplicate = true;
				$error = "Username already exists!";
			}
			if($username_set && !$duplicate) {
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
		<script src='nav.js'></script>
		
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