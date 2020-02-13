<?php
	$username = $_COOKIE["username"];
?>
<html>
	<head>
		<title>League Creation</title>
		<link rel="stylesheet" type="text/css" href="fantasy.css?version=12">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<body style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: 0.05em">
		<script src="https://kit.fontawesome.com/3ca07295df.js" crossorigin="anonymous"></script>
		<script src='nav.js?version=12'></script>
		<div class="box">
			<h1 class="leagueHeader">Create A League</h1>
			<form action="./php/createLeague.php" method="POST" class="leagueName">
				<label for="leagueName" class="input">League Name:</label></br>
				<input type="text" name="LeagueName" id="LeagueName" class="registerTextBoxes"/></br>
				<label for="leagueLocation" class="input">League Location:</label></br>
				<select name="Region" class="locationDropbox " id="Region">
					<option value="IND">Indiana</option>
				</select></br></br>
				<label for="leaguePassword" class="input">League Password:</label></br>
				<input type="password" name="Password" id="Password" class="registerTextBoxes"/></br>
				<!-- Hidden Username field to pass in the username value easily -->
				<input style="display:none;" type="text" name="username" id="username" value="<?php echo $username; ?>"/>
				<input type="submit" name="creation" value="Create League" class="button"/></br>
			</form>
		</div>
	</body>
</html>
