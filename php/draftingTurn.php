<?php
	$username = $_POST["username"];
	$lCode = $_POST['leagueCode'];
	//Query to table to see if this whose turn it is in this league
	$select = "SELECT * FROM " . $lCode . " ";
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$query = $select . "ORDER BY drafted ASC";
	$results = mysqli_query($conn, $query);
	for($i = 0; $i < mysqli_num_rows($results); $i++) {
		$row = mysqli_fetch_assoc($results);
		$drafted = $row["drafted"];
		if($drafted < 4) {
			echo $row["username"];
			break;
		}
	}
?>