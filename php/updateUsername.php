<?php
$username = $_POST['username'];
setcookie("username",$username,time()+(2*24*60*60),'/');
?>