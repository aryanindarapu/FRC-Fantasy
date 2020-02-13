<!DOCTYPE php>
<?php
$resetIdentifier = $_GET['resetIdentifier'];
$error = null;
    
if(isset($_POST['password'],$_POST['confPassword'])) {
    $password = $_POST['password'];
    $confPassword = $_POST['confPassword'];
    
    if($password == $confPassword) {
        $hashed_password = hash('whirlpool',$password);
        $conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
        $query = "UPDATE fantasyusers SET password='".$hashed_password."' WHERE resetToken ='".$resetIdentifier."';";
        mysqli_query($conn,$query);
        $newQuery = "UPDATE fantasyusers SET resetToken = null WHERE password = '".$hashed_password."';";
        mysqli_query($conn,$newQuery);
    } else {
        $error = "Password and Confirm Password must be the same!";
    }
} else {
    $error = "Both Password and Confirm Password fields must be entered!";
}

//If an error has occured, display the error message
if($error != null) {
    echo "<div class='error'>";
    echo "<p> ERROR: ".$error."</p>";
    echo "</div>";
}
?>
<html>
	<head>
		<title>FantasyFRC</title>
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
	<body style="background-color:#cccccc; font-family: 'Oswald', sans-serif; letter-spacing: .05em;" onload="loggedIn();">
        <div class="box">
			<form method="post" name="reset" action="">
				<h1 class="registerHeader">FRC Fantasy Reset Password</h1>
				<label for="password" class="input">New Password:</label></br>
				<input name="password" id="password" placeholder="Password" type="password" class="registerTextBoxes" required></br>
                <label for="password" class="input">Confirm New Password:</label></br>
				<input name="confPassword" id="password" placeholder="Password" type="password" class="registerTextBoxes" required></br></br>
				<input type="submit" value="Reset Password" class="button"/>
			</form>
		</div>
	</body>
</html>