<?php
	$username = $_COOKIE["username"];
?>
<html>
<head>
	<title>League Creation</title>
	<link rel="stylesheet" type="text/css" href="fantasy.css?version=26">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="fantasy.js?version=26"></script>
</head>
<body>
	<script src='nav.js'></script>
	<form action="./php/createLeague.php" method="POST">
		<input type="text" name="LeagueName" id="LeagueName" placeholder="League Name" />
		<select name="Region" id="Region">
			<option value="IND">Indiana</option>
		</select>
		<input type="password" name="Password" id="Password" placeholder="League Password" />
		<!-- Hidden Username field to pass in the username value easily -->
		<input style="display:none;" type="text" name="username" id="username" value="<?php echo $username; ?>"/>
		<input type="submit" name="creation" value="Create League"/>
	</form>
</body>
</html>