<?php
	$username = $_COOKIE["username"];
?>
<html>
<form action="php/createLeague.php" method="POST">
	<input type="text" name="LeagueName" id="LeagueName" placeholder="League Name" />
	<select name="Region" id="Region">
		<option value="IND">Indiana</option>
	</select>
	<input type="password" name="Password" id="Password" placeholder="League Password" />
	<!-- Hidden Username field to pass in the username value easily -->
	<input style="display:none;" type="text" name="username" id="username" value="<?php echo $username; ?>"/>
	<input type="submit" name="creation" value="Create League"/>
</form>
</html>