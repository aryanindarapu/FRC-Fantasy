<!DOCTYPE php>
<html>
	<head>
        <title>Profile - FantasyFRC</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=12">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=12"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
			<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</head>
	<script>
		function settings(username, email) {
			document.getElementById("verify").style.display = "none";
			document.getElementById("prof").style.display = "inline-block";
			document.getElementById('profUser').innerHTML = username;
			document.getElementById('profEmail').innerHTML = email;
		}
	</script>
	<body  style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src="https://kit.fontawesome.com/3ca07295df.js" crossorigin="anonymous"></script>
		<script src='nav.js?version=12'></script>
		<div id="verify" class="box">
            <form method="post" name="login" action="">
                <h1>Verify Your Account</h1>
                <label for="password">Password: </label>
                <input name="password" id="password" type="password" /></br>
				<input style="display:none;" id="dbPassword" name="dbPassword" type="password" />
                <input type="submit" value="Enter" onclick="loggedIn()"/>
            </form>
        </div>
		<div id="prof" style="display: none">
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
					<a href="./resetPass.php">Reset Password</a>
					<p>Deactivate Account</p>
				</div>
			</div>
		</div>
	<?php
		$username = null;
		$password = null;
		$query = null;
		$error = null;
		$dbPass = null;
		$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
		echo '<script src="fantasy.js?version=12"></script>';

		if(mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		if(isset($_COOKIE['username'],$_COOKIE['email'])) {
			$query = "SELECT * FROM fantasyusers WHERE name='".$_COOKIE['username']."' AND email='". urldecode($_COOKIE['email']) ."'";
			$result = mysqli_query($conn, $query);

			if(mysqli_num_rows($result) === 0) {
				$error = "Unable to Find User With this Username and Email!";
			} else {
				$row = mysqli_fetch_assoc($result);
				$dbPass = $row["password"];
				echo '<script>';
				echo 'document.getElementById("verify").style.display = "none";';
				echo 'document.getElementById("prof").style.display = "block";';
				echo 'document.getElementById("profUser").innerHTML = "'.$_COOKIE["username"].'";';
				echo 'document.getElementById("profEmail").innerHTML = "'.$_COOKIE["email"].'";';
				echo 'document.getElementById("dbPassword").value = "' .$dbPass . '";';
				echo '</script>';
				echo "<script>console.log('Settings visible!')</script>";


			}
		} else if(isset($_COOKIE["username"])){
			$username = $_COOKIE["username"];
			if(isset($_POST['password'])) {
				$password = $_POST['password'];
				$hashed_password = hash('whirlpool', $password);
				$query = "SELECT * FROM fantasyusers WHERE name='".$username."'";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) === 0) {
					$error = "Unable to Find User With this Username!";
				} else {
					$row = mysqli_fetch_assoc($result);
					$username = $row['name'];
					$dbpass = $row['password'];
					$email = $row['email'];
					if($hashed_password === $dbpass) {
						$cookie_user = "username";
						$cookie_mail = "email";
						$cookie_userval = $username;
						$cookie_mailval = $email;
						setcookie($cookie_user, $cookie_userval, time() + (86400 * 30), "/"); // 86400 = 1 day
						setcookie($cookie_mail, $cookie_mailval, time() + (86400 * 30), "/"); // 86400 = 1 day
					} else {
						$error = "Incorrect Password!";
					}
				}
			}
		} else {
			echo "<script>window.location.href = './login.php';</script>";
		}

		if($error != null) {
			echo "<div class='error'>";
			echo "<p> ERROR: ".$error."</p>";
			echo "</div>";
		}
		?>

	</body>
</html>
