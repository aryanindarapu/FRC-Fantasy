<!DOCTYPE php>
<html>
<head>
</head>
	<p>Redirecting...</p>
</html>
<?php
	$redirect = $_GET["redirect"];
	
	if($redirect === "login") {
		sleep(1);
		header("Location:https://www.techhounds.com/FRC%20Fantasy/login.php?r=true");
	}
?>
