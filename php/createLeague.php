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
		. "','" . $Region . "',true,'" . $hashed_password . "')";
	mysqli_query($conn, $query);
	
	//Get the league stuff
	$query = "SELECT * FROM leagues WHERE LeagueName='" . $leagueTitle
		. "' AND Password='" . $hashed_password . "'";
	$results = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) === 0) {
		$echo "Failed when retrieving League Info";
	} else {
		$row = mysqli_fetch_assoc($result);
		//Fetch League ID and make it globally accessible for the rest of the script
		$GLOBALS["LeagueID"] = $row["LeagueID"];
		//Create a League Code and set it globally
		$GLOBALS["LeagueCode"] = $row["Region"] . $GLOBALS["LeagueID"];
	}
	
	//Update Table with generated LeagueCode
	$query = "UPDATE leagues SET LeagueCode='" . $GLOBALS["LeagueCode"]
		. "' WHERE LeagueID=" . $GLOBALS["LeagueID"];
	mysqli_query($query);
	//CREATE TABLE Based off of the league code
	$query = "CREATE TABLE " . $GLOBALS["LeagueCode"] . "("
		. "`username` VARCHAR(20) NOT NULL,"
		. "`teamOne` TEXT,"
		. "`teamTwo` TEXT,"
		. "`teamThree` TEXT,"
		. "`teamFour` TEXT,"
		. "`Win` TEXT,"
		. "`Loss` TEXT,"
		. "`Owner` BOOLEAN NOT NULL DEFAULT false,"
		. "PRIMARY KEY (`username`))";
	mysqli_query($query);
		
	//INSERT OWNER TO NEW TABLE
	$query = "INSERT INTO " . $GLOBALS["LeagueCode"] . "(username,Owner)" .
		. "VALUES ('" . $username . "', true)";
	$mysqli_query($query);
} else {
	echo "You shouldn't be here";
}

?>