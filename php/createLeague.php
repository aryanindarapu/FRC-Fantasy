<?php
if(isset($_POST["LeagueName"])) {
	$leagueTitle = $_POST["LeagueName"];
	$region = $_POST["Region"];
	$password = $_POST["Password"];
	$username = $_POST["username"];
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//Table Name: leagues
	/*  Fields: 
	- LeagueID (Auto Inc)
	- LeagueName (Varchar(24))
	- LeagueCode (text)
	- Region (Varchar(3))
	- Settings (text)
	- Active (boolean)
	- Password (text)
	*/
	$hashed_password = hash('whirlpool', $password);
	
	$query = "INSERT INTO leagues(LeagueName,Region,Active,Password) VALUES ('" . $leagueTitle 
		. "','" . $region . "',true,'" . $hashed_password . "')";
	mysqli_query($conn, $query);
	
	//Get the league stuff
	$query = "SELECT * FROM leagues WHERE LeagueName='" . $leagueTitle
		. "' AND Password='" . $hashed_password . "'";
	$results = mysqli_query($conn, $query);
	$lID = "id";
	$leagueCode = "code";
	if(mysqli_num_rows($results) === 0) {
		echo "Failed when retrieving League Info";
	} else {
		$row = mysqli_fetch_assoc($results);
		//Fetch League ID and make it globally accessible for the rest of the script
		$lID = $row["LeagueID"];
		//Create a League Code and set it globally
		$leagueCode = $row["Region"] . $lID;
	}
	
	//Update Table with generated LeagueCode
	$query = "UPDATE leagues SET LeagueCode='" . $leagueCode
		. "' WHERE LeagueID=" . $lID;
	mysqli_query($conn, $query);
	//CREATE TABLE Based off of the league code
	$query = "CREATE TABLE " . $leagueCode . "("
		. "`username` VARCHAR(20) NOT NULL,"
		. "`teamOne` TEXT,"
		. "`teamTwo` TEXT,"
		. "`teamThree` TEXT,"
		. "`teamFour` TEXT,"
		. "`Win` TEXT,"
		. "`Loss` TEXT,"
		. "`Owner` BOOLEAN NOT NULL DEFAULT false,"
		. "PRIMARY KEY (`username`))";
	mysqli_query($conn, $query);
		
	//INSERT OWNER TO NEW TABLE
	$query = "INSERT INTO " . $leagueCode . "(username,Owner)" .
		 "VALUES ('" . $username . "', true)";
	mysqli_query($conn, $query);
	//Generate a GET link with properties:
	//id, code, key
	
	echo "<h1>Your Link is:\n</h1><br>";
	echo "https://www.techhounds.com/FRC%20Fantasy/join.php?id=" . $lID . "&code=" . $leagueCode . "&key=" . $hashed_password;
	echo "<br><h2>DON'T LOSE IT! We cant help you get it back if you lose it!</h2>";
} else {
	echo "You shouldn't be here";
}

?>