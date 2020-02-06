<?php
//Set username cookie to blank and make it expire 
setcookie("username", "", time() - 3600, "/");
//Redirect to login page
echo "<script>window.location.href = 'https://techhounds.com/FRC%20Fantasy/login.php';</script>"; 
?>