<?php
/*
 -ERROR CODES:
	- "CPE" (Code/Password ERROR) - No matches
	- "TUE" (Table Updating ERROR) - Could not update League Table
	- "AIL" (Already in League)
	- "QF" (Query Failed)
	- "LNA" (League No Longer Active)
*/
$leagueCode = $_POST["LeagueCode"];
$password = $_POST["LeaguePassword"];
$username = $_POST["username"];
$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
if(mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Check the password and LeagueCode of the League to join
$query = "SELECT * FROM leagues WHERE Password='" . $password .	"' AND LeagueCode='" . $leagueCode . "'";
$results = mysqli_query($conn, $query);
if(mysqli_num_rows($results) !== 0) {
	$row = mysqli_fetch_assoc($results);
	//Check if the table is active
	if($row["Active"] == 0) {
		mysqli_close();
		die("LNA");
	}
} else {
	mysqli_close();
	die("CPE");
}

//Check if user already in league table
$query = "SELECT * FROM " . $leagueCode . " WHERE username='" . $username . "'";
//Query and get the results, or die and throw an error
$results = mysqli_query($conn,$query) or die ("QF");
if(mysqli_num_rows($results) > 0) {
	mysqli_close();
	die("AIL");
}
//Insert User into league table
$query = "INSERT INTO " . $leagueCode . "(username) VALUES ('" . $username . "')";
mysqli_query($conn, $query) or die("TUE");
mysqli_close();
echo "Success";
?>