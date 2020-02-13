<?php
	// This code has to get called when drafting is started in a league
	set_time_limit(300);
	$lCode = $_GET['leagueCode'];
	$matchTable = $lCode . "_matches";
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$usernames = [];
	$numOfUsers = 0;
	$query = "SELECT * FROM " . $lCode;
	$results = mysqli_query($conn, $query);
	for($i = 0; $i < mysqli_num_rows($results); $i++) {
		$row = mysqli_fetch_assoc($results);
		$numOfUsers++;
		array_push($usernames, $row["username"]);
	}
	//Create table
	$query = "CREATE TABLE " . $matchTable . "(" .
	"`matchid` INT NOT NULL AUTO_INCREMENT," .
	"`userOne` VARCHAR(26) NOT NULL," .
	"`userTwo` VARCHAR(26) NOT NULL," .
	"`week` INT NOT NULL," .
	"PRIMARY KEY (`matchid`)" .
	");";
	mysqli_query($conn, $query);
	// Logic to create matches (by Matthew)
	// MATCH TABLE IS MATCH ID
	$usernamesShuffled = $usernames;
	shuffle($usernamesShuffled);
	// REAL logic to do matches
	switch ($numOfUsers) {
	    case 2:
					$userOne = $usernames[0];
					$userTwo = $usernames[1];
	        for ($i = 0; $i < 6; $i++) {
						$query =  "INSERT INTO " .$matchTable. " VALUES ('" .$userTwo."','" .$userOne."');";
						mysqli_query($conn, $query);
					}
	        break;
	    case 3:
	        $userOne = $usernamesShuffled[0];
					$userTwo = $usernamesShuffled[1];
					$userThree = $usernamesShuffled[2];
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userThree."',1);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userTwo."',2);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userOne."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',3);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userThree."',4);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userTwo."'5);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userOne."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',6);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userThree."',7);");
	        break;
	    case 4:
					$userOne = $usernamesShuffled[0];
					$userTwo = $usernamesShuffled[1];
					$userThree = $usernamesShuffled[2];
					$userFour = $usernamesShuffled[3];
					echo $userOne;
					echo $userTwo;
					echo $userThree;
					echo $userFour;
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userThree."',1);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFour."',2);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFour."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',3);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userFour."',4);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFour."',5);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFour."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',6);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userFour."',7);");
	        break;
			case 5:
					$userOne = $usernamesShuffled[0];
					$userTwo = $usernamesShuffled[1];
					$userThree = $usernamesShuffled[2];
					$userFour = $usernamesShuffled[3];
					$userFive = $usernamesShuffled[4];
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userThree."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userFive."',1);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFive."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFour."',2);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFour."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userTwo."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userThree."',3);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userOne."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFour."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userThree."',4);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userOne."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFive."',5);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userTwo."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userThree."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userFive."',6);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFive."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFour."',7);");
					break;
			case 6:
					$userOne = $usernamesShuffled[0];
					$userTwo = $usernamesShuffled[1];
					$userThree = $usernamesShuffled[2];
					$userFour = $usernamesShuffled[3];
					$userFive = $usernamesShuffled[4];
					$userSix = $usernamesShuffled[5];
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userOne."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userThree."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userSix."',1);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFive."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSix."','" .$userFour."',2);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFour."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userSix."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userThree."',3);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userOne."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFour."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userSix."',4);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userSix."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFive."',5);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userTwo."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userThree."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userSix."',6);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userOne."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFive."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userSix."',7);");
					break;
			case 7:
					$userOne = $usernamesShuffled[0];
					$userTwo = $usernamesShuffled[1];
					$userThree = $usernamesShuffled[2];
					$userFour = $usernamesShuffled[3];
					$userFive = $usernamesShuffled[4];
					$userSix = $usernamesShuffled[5];
					$userSeven = $usernamesShuffled[6];
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userOne."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userSeven."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userSix."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFive."',1);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userTwo."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userSeven."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userFive."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userSix."',2);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userThree."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userTwo."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userSix."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userSeven."',3);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFour."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSix."','" .$userSix."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userSeven."',4);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFive."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFour."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userThree."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSeven."','" .$userSix."',5);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userSix."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFive."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userFour."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSeven."','" .$userSeven."',6);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userSeven."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userSix."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userFive."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFour."',7);");
					break;
			case 8:
					$userOne = $usernamesShuffled[0];
					$userTwo = $usernamesShuffled[1];
					$userThree = $usernamesShuffled[2];
					$userFour = $usernamesShuffled[3];
					$userFive = $usernamesShuffled[4];
					$userSix = $usernamesShuffled[5];
					$userSeven = $usernamesShuffled[6];
					$userEight = $usernamesShuffled[7];
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userEight."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userSeven."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userSix."',1);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userFive."',1);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userTwo."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userSeven."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userEight."',2);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userSix."',2);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userThree."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userEight."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userSix."',3);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userSeven."',3);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFour."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userThree."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSix."','" .$userEight."',4);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFive."','" .$userSeven."',4);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userFive."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFour."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userEight."',5);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSeven."','" .$userSix."',5);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userSix."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userFive."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userFour."',6);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userSeven."','" .$userEight."',6);");

					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userOne."','" .$userSeven."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userTwo."','" .$userSix."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userThree."','" .$userFive."',7);");
					mysqli_query($conn, "INSERT INTO " .$matchTable. " (userOne, userTwo, week) VALUES ('" .$userFour."','" .$userEight."',7);");
					break;
	}
	// ECHO TO TEST scheduleing
	echo "<table><tr><th>Match Number</th><th>User One</th><th>User Two</th></tr>";
	 $query = "SELECT * FROM " . $matchTable . ";";
	 $result = mysqli_query($conn, $query);
	 for($i = 0; $i < mysqli_num_rows($result); $i++) {
 		$row = mysqli_fetch_assoc($result);
 		echo "<tr>";
		echo "<td>" . $row["matchid"] . "</td>";
		echo "<td>" . $row["userOne"] . "</td>";
		echo "<td>" . $row["userTwo"] . "</td>";
		echo "</tr>";
 	}
	echo "</table>";
?>
