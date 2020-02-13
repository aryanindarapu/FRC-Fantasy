
<html>
	<head>
		<title>FantasyFRC</title>
        <link rel="stylesheet" type="text/css" href="fantasy.css?version=12">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="fantasy.js?version=12"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
		<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.js"integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<style>
		.league {
			background-color: #222222;
			color: white;
			padding: 10px;
			display: block;
			width: 80%;
			margin: 0 auto;
		}
		.draftLink {
			display: inline-block;
			float: right;
			text-decoration: none;
			color: white;
		}

		.leagueBtn {
			border: none;
			background-color: inherit;
			padding: 4px 4px;
			cursor: pointer;
			display: inline-block;
			font-size: 20px;
			color: white;
		}

		table.basicInfo tr td {
			color: white;
			border: 2px solid black;
			background-color: #454545;
		}

		leagueInfo {
			background-color: #353535;
			width: 80%;
			padding-left: 10px;
			padding-right: 10px;
			padding-bottom: 10px;
		}
		</style>
	</head>
	<body  style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src="https://kit.fontawesome.com/3ca07295df.js" crossorigin="anonymous"></script>
		<script src='nav.js?version=12'></script>
		<div class="net">
			<div class="paper container">
				<h1>Leagues you are a part of</h1>
				<?php
				$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
				$error = "";
					//State if error in connecting to database
				if(mysqli_connect_errno())
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}
				$query = "select * from leagues where Active=true;";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) === 0) {
					$error = "There are currently no active leagues. You should start one!";
				} else {
					$allLeagueCodes = [];
					$allLeagueNames = [];
					$leaguesIn = [];
					$leaguesInCodes = [];
					for ($i = 0; $i < mysqli_num_rows($result); $i++) {
						$row = mysqli_fetch_assoc($result);
						array_push($allLeagueCodes, $row['LeagueCode']);
						array_push($allLeagueNames, $row['LeagueName']);
					}
					for ($i = 0; $i < sizeOf($allLeagueCodes); $i++) {
						$user = $_COOKIE['username'];
						$query = "select * from " . $allLeagueCodes[$i]. " where username='".$user."';";
						$result = mysqli_query($conn, $query);
						if (mysqli_num_rows($result) === 0) {
							continue;
						} else {
							array_push($leaguesIn, $allLeagueNames[$i]);
							array_push($leaguesInCodes, $allLeagueCodes[$i]);
						}
					}
					if (sizeOf($leaguesIn) > 0) {
						for ($i = 0; $i < sizeOf($leaguesIn); $i++) {
							$leagueUsers = [];
							$teamOne = [];
							$teamTwo = [];
							$teamThree = [];
							$teamFour = [];
							$wins = [];
							$losses = [];
							echo "<div class='league'>\n";
							echo '<button class="leagueBtn" data-toggle="collapse" data-target="#info'.$i.'">+</button>'. $leaguesIn[$i] . '<a class="draftLink" href="./leagueHome.php?league='.$leaguesInCodes[$i].'">&gt;&gt;</a><br>' ;
							echo "<div id='leagueInfo'>";
							echo "</div>";
							echo '<div id="info'.$i.'" class="collapse">';
							echo "<table class='basicInfo ml-auto mr-auto'>";
							echo "<tr><td>Username</td>";
							echo "<td>Team One</td>";
							echo "<td>Team Two</td>";
							echo "<td>Team Three</td>";
							echo "<td>Team Four</td>";
							echo "<td>Wins</td>";
							echo "<td>Losses</td></tr>";
							$query = "select * from " . $leaguesInCodes[$i]. ";";
							$result = mysqli_query($conn, $query);
							if (mysqli_num_rows($result) === 0) {
								continue;
							} else {
								for($k = 0; $k < mysqli_num_rows($result); $k++) {
									$row = mysqli_fetch_assoc($result);
									array_push($leagueUsers, $row['username']);
									array_push($teamOne, $row['teamOne']);
									array_push($teamTwo, $row['teamTwo']);
									array_push($teamThree, $row['teamThree']);
									array_push($teamFour, $row['teamFour']);
									array_push($wins, $row['Win']);
									array_push($losses, $row['Loss']);
								}
							}
							if (sizeOf($leagueUsers) > 0) {
								for ($j = 0; $j < sizeOf($leagueUsers); $j++) {
									echo "<tr>";
									echo "<td>$leagueUsers[$j]</td>";
									echo "<td>$teamOne[$j]</td>";
									echo "<td>$teamTwo[$j]</td>";
									echo "<td>$teamThree[$j]</td>";
									echo "<td>$teamFour[$j]</td>";
									echo "<td>$wins[$j]</td>";
									echo "<td>$losses[$j]</td>";
									echo "</tr>";
								}
							} else {
								$error = "There are no users in this league!";
							}
							echo "</table>";
							echo "</div>";
							echo "</div>";
						}
					} else {
						$error = "You are not part of any leagues. You should try joining or starting one!";
					}
				}
				// Loop through league codes in array
				// select * from "leagueCodesIn"
				if ($error != null) {
					echo $error;
				}
				?>
				<a href="./leagueCreation.php"><button class="button" id = "leagueButton" disabled>CREATE LEAGUE</button></a>
			</div>
		</div>
	</body>
</html>
