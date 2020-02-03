<?php
//Take the username provided by the form
$username = $_POST['username'];
//Set a site-wide cookie for that username
setcookie("username",$username,time()+(2*24*60*60),'/');
?>