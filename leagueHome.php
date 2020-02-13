<!DOCTYPE php>
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
	</head>
	<body  style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src="https://kit.fontawesome.com/3ca07295df.js" crossorigin="anonymous"></script>
		<script src='nav.js?version=12'></script>
		<?php
		// Declared Variables/Arrays
		$leagueUsers = [];
		$wins = [];
		$losses = [];
		$draws = [];
		$ratios = [];
		$leaderboard = [];
		$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
		
		// Get info from url and cookie
		$leagueCode = $_GET['league'];
		$user = $_COOKIE['username'];
		
		echo "<div class='row'>";
			echo "<div class='col-sm'>";
				echo "<div class='box'>";
					// Leaderboard Code & Standings
					echo "<h2>Leaderboard</h2>";
					$query = 'SELECT * FROM '.$leagueCode.';';
					$result = mysqli_query($conn, $query);
					for ($i = 0; $i < mysqli_num_rows($result); $i++) {
						$row = mysqli_fetch_assoc($result);
						array_push($leagueUsers, $row['username']);
						array_push($wins, $row['Win']);
						array_push($losses, $row['Loss']);
						array_push($draws, $row['Draw']);
					}
					for ($j = 0; $j < sizeOf($leagueUsers); $j++) {
						$ratio = 0;
						if(($wins[$j] + $losses[$j] + $draws[$j]) > 0) {
							$ratio = round((100 * $wins[$j]) / ($wins[$j] + $losses[$j] + $draws[$j]), 0);
						}
						$leaderboard[$j][0] = $leagueUsers[$j];
						$leaderboard[$j][1] = $ratio;
						$leaderboard[$j][2] = "".$wins[$j]."-".$losses[$j]."-".$draws[$j]."";
					}
					usort($leaderboard,"leaderSort");
					for ($j = 0; $j < sizeOf($leagueUsers); $j++) {
					//echo leaderboard table
						echo "<p>".$leaderboard[$j][0]."</p>";
						echo "<p>".$leaderboard[$j][2]."	".$leaderboard[$j][1]."%</p>";
					}
					function leaderSort($a, $b){
						if ($a[1] == $b[1]) {
							return 0;
						}
						return ($a[1] > $b[1]) ? -1 : 1;
					}
				echo "</div>";
			echo "</div>";
			echo "<div class='col-sm'>";
				echo "<div class='box'>";
					//League Info
					$query = 'SELECT * FROM '.$leagueCode.';';
					$result = mysqli_query($conn, $query);
					$userNo = mysqli_num_rows($result);
					$query = 'SELECT * FROM leagues WHERE LeagueCode="'.$leagueCode.'";';
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);
					$leagueName = $row['LeagueName'];
					$region = $row['Region'];
					echo "<h2>".$leagueName."</h2>";
					echo "<p>Region: ".$region."<p>";
					$query = 'SELECT * FROM '.$leagueCode.' WHERE Owner=1;';
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);
					$owner = $row['username'];
					// User Standings/Info
					$query = 'SELECT * FROM '.$leagueCode.' WHERE username="'.$user.'";';
					$result = mysqli_query($conn, $query);
					echo "<p>Creator: ".$owner."</p>";
					echo "<p>Teams: ".$userNo."</p>";
					$row = mysqli_fetch_assoc($result);
				echo "</div>";
				echo "<div class='box'>";
					echo "<h2>My Standings</h2>";
					echo "<h3>".$user."</h3>";
					echo "<p>".$row['Win']."-".$row['Loss']."-".$row['Draw']."</p>";
					$ratio = "0";
					if(($row['Win'] + $row['Loss'] + $row['Draw']) > 0) {
						$ratio = round((100 * $row['Win']) / ($row['Win'] + $row['Loss'] + $row['Draw']), 0);
					}
					echo "<p>Win/Loss Ratio: ".$ratio."%</p>";
				echo "</div>";
			echo "</div>";
			echo "<div class='col-sm'></div>";
		echo "</div>";
		?>
	</body>
</html>
