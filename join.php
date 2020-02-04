<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<title>Join a League</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=1"></script>
	</head>
	<body style="background-color:#cccccc" onload="loggedIn();">
<?php
if(isset($_POST['username'])){
	/*
		$username set to form entered username
		$password set to form entered password
	*/
	$username = $_POST['username'];
	$password = $_POST['password'];
	//Set $email as global
	$email = true;
	//Check with RegEx for email
	if(preg_match('~(\w+)@(gmail|yahoo|icloud|hotmail|outlook|aol)(\.com|\.net)~', $username)) {
		$email = true;
	} else {
		$email = false;
	}
	//Hash password using whirlpool
	$hashed_password = hash('whirlpool', $password);
	//Connect to database
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	//State if error in connecting to database
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//Set $query as global
	$query = null;
	//Select lines from database where either email or username is $username
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
			//send AJAX request to joinLeague.php
			$lCode = $_POST["LeagueCode"];
			$lPass = $_POST["LeaguePassword"];
			echo "<script>\n";
			echo "$.ajax({\n"
				. "url: './php/joinLeague.php',\n"
				. "type: 'POST',\n"
				. "data: { 'LeagueCode':'" . $lCode . "',"
				. "'LeaguePassword': '" . $lPass . "',"
				. "'username': '" . $username . "'},\n"
				. "success: function(aData) {\n"
				. "alert(aData);\n"
			. "}});";
			echo "</script>";
		}
	}
}


?>

	

		<script src='nav.js?version=1'></script>
		<div class="box">
            <form method="post" name="verify" action="">
                <h1>Join A League</h1>
                <label for="username">Username: </label>
                <input name="username" id="username" type="text" /></br>
                <label for="password">Password: </label>
                <input name="password" id="password" type="password" /></br>
				<?php
					if(isset($_GET["id"])) {
						//POPULATE FORM FIELDS
						$leagueCode = $_GET["code"];
						$leaguePass = $_GET["key"];
						echo "<input name='LeagueCode' id='LeagueCode' style='display:none;' type='text' value='" . $leagueCode ."'>";
						echo "<input name='LeaguePassword' id='LeaguePassword' style='display:none;' type='text' value='" . $leaguePass . "'>";
					}
				?>
				<input type="submit" value="Log In" />
            </form>
        </div>
	</body>
</html>