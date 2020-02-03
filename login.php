
<?php
$error = null;
$loggedIn = false;
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
	//$result stores number of rows and information from each row that returns from fuction above
	$result = mysqli_query($conn, $query);
	
	/*
		If no rows match $username, return an error
		If a row matches the $username value:
			- select row identified above
			- set $username to stored database username (Non-case-sensitivity purposes & so username will be stored and not email)
			- set $dpass to hashed password stored in database
			- Check if $dpass is equal to $hashed_password. If so:
				- set $loggedIn to true
				- set $online to 1 (true)
				- set $query "online" value to 1 (true)
				- sends $query to database, updating it
	*/
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

/*
	If $loggedIn is true:
		- echo $username to console
		- set cookie with name "username" to value of logged in username from above function
		- set cookie to expire in 30 days
		- redirect to index (home) page
*/
if($loggedIn) {
	$cookie_name = "username";
	$cookie_value = $username;
	echo "<script>console.log('" . $cookie_value . "');</script>";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	echo "<script>window.location.href = 'https://techhounds.com/FRC%20Fantasy/index.php'</script>";
}
?>

<html>
	<head>
        <title>Login - FantasyFRC</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=1"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
	</head>
	<body style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src='nav.js?version=1'></script>
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