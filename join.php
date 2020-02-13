<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<title>Join a League</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=12">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=12"></script>
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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


	<script src="https://kit.fontawesome.com/3ca07295df.js" crossorigin="anonymous"></script>
		<script src='nav.js?version=12'></script>
		<div class="box">
            <form method="post" name="verify" action="">
                <h1>Join A League</h1>
                <label for="username" class="input">Username: </label>
                <input name="username" id="username" placeholder="Username" type="text" class="registerTextBoxes" style="width:80%" required></br>
                <label for="password" class="input">Password: </label>
                <input name="password" id="password" type="password" placeholder="Password" class="registerTextBoxes" style="width:80%" required></br>
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
