<?php

	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	
	$username = $_POST['username'];
	$lCode = $_POST['leagueCode'];
	$teamnum = $_POST['teamnum'];
	$error;
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	$select = "SELECT * FROM " . $lCode . " ";
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//Check if the person is in the league
	$query = $select . "WHERE username='" . $username . "'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		//This user is in the league
		$row = mysqli_fetch_assoc($result);
		$teamOne = $row["teamOne"];
		$teamTwo = $row["teamTwo"];
		$teamThree = $row["teamThree"];
		$teamFour = $row["teamFour"];
		
		if(is_null($teamOne)) {
			//We will use this team to draft to
			$query = $select . "WHERE teamOne='" . $teamnum . "' OR teamTwo='" . $teamnum . "' OR teamThree='" . $teamnum . "' OR teamFour='" . $teamnum . "'";
			$results = mysqli_query($conn, $query);
			if(mysqli_num_rows($results) > 0) {
				$row = mysqli_fetch_assoc($results);
				mysqli_close($conn);
				die("Error: " . $row["username"] . " has already drafted this team");
			}
			//Nobody else has drafted the team
			$query = "UPDATE " . $lCode . " SET teamOne='" . $teamnum . "' WHERE username='" . $username . "'";
			mysqli_query($conn, $query);
		} else if(is_null($teamTwo)) {
			//We will use this team to draft to
			$query = $select . "WHERE teamOne='" . $teamnum . "' OR teamTwo='" . $teamnum . "' OR teamThree='" . $teamnum . "' OR teamFour='" . $teamnum . "'";
			$results = mysqli_query($conn, $query);
			if(mysqli_num_rows($results) > 0) {
				$row = mysqli_fetch_assoc($results);
				mysqli_close($conn);
				die("Error: " . $row["username"] . " has already drafted this team");
			}
			//Nobody else has drafted the team
			$query = "UPDATE " . $lCode . " SET teamTwo='" . $teamnum . "' WHERE username='" . $username . "'";
			mysqli_query($conn, $query);
		} else if(is_null($teamThree)) {
			//We will use this team to draft to
			$query = $select . "WHERE teamOne='" . $teamnum . "' OR teamTwo='" . $teamnum . "' OR teamThree='" . $teamnum . "' OR teamFour='" . $teamnum . "'";
			$results = mysqli_query($conn, $query);
			if(mysqli_num_rows($results) > 0) {
				$row = mysqli_fetch_assoc($results);
				mysqli_close($conn);
				die("Error: " . $row["username"] . " has already drafted this team");
			}
			//Nobody else has drafted the team
			$query = "UPDATE " . $lCode . " SET teamThree='" . $teamnum . "' WHERE username='" . $username . "'";
			mysqli_query($conn, $query);
		} else if (is_null($teamFour)) {
			//We will use this team to draft to
			$query = $select . "WHERE teamOne='" . $teamnum . "' OR teamTwo='" . $teamnum . "' OR teamThree='" . $teamnum . "' OR teamFour='" . $teamnum . "'";
			$results = mysqli_query($conn, $query);
			if(mysqli_num_rows($results) > 0) {
				$row = mysqli_fetch_assoc($results);
				mysqli_close($conn);
				die("Error: " . $row["username"] . " has already drafted this team");
			}
			//Nobody else has drafted the team
			$query = "UPDATE " . $lCode . " SET teamFour='" . $teamnum . "' WHERE username='" . $username . "'";
			mysqli_query($conn, $query);
		} else {
			mysqli_close($conn);
			die("You cannot draft anymore teams");
		}
		mysqli_close($conn);
		
	} else {
		mysqli_close($conn);
		die("Error Drafting: User is not in league");
	}
	
  
	
?>