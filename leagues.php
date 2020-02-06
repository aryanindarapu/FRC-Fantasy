
<html>
	<head>
		<title>FantasyFRC</title>
        <link rel="stylesheet" type="text/css" href="fantasy.css?version=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=1"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
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
		</style>
	</head>
	<body  style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src='nav.js?version=1'></script>
		<div class="net">
			<div class="paper">
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
							echo "<div class='league'>\n";
							echo $leaguesIn[$i] . "					<a class='draftLink' href='./draftSystem.php?league=".$leaguesInCodes[$i]."'>&gt;&gt;</a><br>" ;
							echo "</div>";
						}
					} else {
						$error = "You are not part of any leagues. You should try joining or starting one!";
					}
				}
				if ($error != null) {
					echo $error;
				}
				?>
			</div>
		</div>
	</body>
</html>