<?php
	$leagueCode = $_POST['leagueCode'];
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	$query = "SELECT * FROM " . $leagueCode . ";";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) {
		$data = [];
		for ($i = 0; $i < mysqli_num_rows($result); $i++) {
			$row = mysqli_fetch_assoc($result);
			
			//Check if the drafted teams are null, if not then update the array
			if(!is_null($row["teamOne"])) {
				array_push($data, $row["teamOne"]);
				if(!is_null($row["teamTwo"])) {
					array_push($data, $row["teamTwo"]);
					if(!is_null($row["teamThree"])) {
						array_push($data, $row["teamThree"]);
						if(!is_null($row["teamFour"])) {
							array_push($data, $row["teamThree"]);
						}
					}
				}
			}
		}
		$myJSON = json_encode($data);
		echo $myJSON;
	} else {
		echo '{ "success":"fail", "data":[] }';  
	}
	
	
	
?>