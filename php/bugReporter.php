<?php

	
	//Submit bug report to table
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	if(mysqli_connect_errno()) {
		echo "Couldn't connect to MySQL: " . mysqli_connect_error();
	}
	//Check VALUES
	$username = "";
	$description = "";
	if(isset($_POST["username"])) {
		$username = $_POST["username"];
	} else {
		$username = "Anonymous";
	}
	
	if(isset($_POST["description"])) {
		$description = $_POST["description"];
	} else {
		mysqli_close(0);
		die("No Report.");
	}
	
	
	$query = "INSERT INTO reports(username,description) VALUES ('" . $username . "','" . $description . "')";
	mysqli_query($conn, $query);
	mysqli_close(0);
?>