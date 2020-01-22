<?php
	$username = $_POST['username'];
	$teamnum = $_POST['teamnum'];
	$error;
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	/* GET DIVISION OF USER */
	$division;
	$query = "SELECT * FROM divisions WHERE username='".$username."'";
	
	$result = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($result) === 0) {
		$error = "RIP";
	} else {
		$row = mysqli_fetch_assoc($result);
		$division = $row['division'];
	}
	//Now To update the table to draft the team for the person
	$query = "UPDATE drafted_teams SET username ='".$username"' WHERE division='".$division."' AND team_num='".$teamnum."'";
	mysqli_query($conn, $query);
?>