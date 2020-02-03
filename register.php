<!DOCTYPE html>
<html>
	<head>
		<title>Register - Fantasy FRC</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=1"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
	</head>
	<body style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<?php
		$error = null;
		//Check if a username field is filled in form. If so start function.
		if(isset($_POST['username'])){
			//Set timeout to 300ms so it trys to connect for longer
			ini_set('mysql.connect_timeout', 300);
			ini_set('default_socket_timeout', 300); 
			//here we get the values posted from the form, as php variables
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password_as_string = $_POST['password'];	
			//Hash password enter in form using whirlpool and store as php variable
			$hashed_password = hash('whirlpool',$password_as_string);
			//Connect to database
			$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
			//If error occurs in connection, echo the error
			if(mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			//Set to true unless username is empty
			$username_set = isset($_POST['username']) && ($username != "");
			$query = "select * from fantasyusers where name = '".$username."' or email = '".$email."';";
			$duplicate = false;
			// Check if the username exists
			$results = mysqli_query($conn, $query);
			//If username or email is already in database, set $duplicate to true and change error message
			if (mysqli_num_rows($results) !== 0) {
				$duplicate = true;
				$error = "Username already exists!";
			}
			//If the username or email has not been used, input form data into the database
			if($username_set && !$duplicate) {
				$query = 'INSERT INTO fantasyusers (name,password,email) VALUES ("'.$username.'","'.$hashed_password.'","'.$email.'");';
				mysqli_query($conn,$query);
				$newQuery = "UPDATE fantasyusers SET online = 0 WHERE name = '".$username."';";
				mysqli_query($conn,$newQuery);
			} else {
				$error = "Username already exists!";
			}
		}
			//If an error has occured, display the error message
			if($error != null) {
				echo "<div class='error'>";
				echo "<p> ERROR: ".$error."</p>";
				echo "</div>";
			}
		?>
		<script src='nav.js?version=1'></script>
		<div class="box">
			<form method="post" name="login" action="">
				<h1 class="registerHeader">FRC Fantasy Register</h1>
				<label for="email" class="input">Email:</label></br>
				<input name="email" id="email" placeholder="frcfan@gmail.com" type="text" class="registerTextBoxes" required></br>
				<label for="username" class="input">Username:</label></br>
				<input name="username" id="username" placeholder="Username" type="text" class="registerTextBoxes" required></br>
				<label for="password" class="input">Password:</label></br>
				<input name="password" id="password" placeholder="Password" type="password" class="registerTextBoxes" required></br></br>
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