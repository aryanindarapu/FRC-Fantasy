<!DOCTYPE html>
<html>
	<head>
		<title>FantasyFRC</title>
        <link rel="stylesheet" type="text/css" href="fantasy.css?version=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="fantasy.js?version=1"></script>
		<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
		<style>
			.league-bar {
				width: 80%;
				display: block;
				margin: 20px auto;
				background-color: #3b3b3b;
			}
			.league-bar a {
				background-color: #222222;
				padding: 5px;
				margin: 0;
				display: inline-block;
				color: #ffffff;
				text-decoration: none;
				height: 100%;
			}
		
		</style>
	</head>
	<body style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
		<script src='nav.js?version=1'></script>		
		<div class="leaguetop">
			<div class="league-bar">
				<a href="./leagueCreation.php">Create League</a>
				<a href="./leagues.php">My Leagues</a>
			</div>
		</div>
	</body>
</html>