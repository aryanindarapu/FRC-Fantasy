<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require './PHPMailer/PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require './PHPMailer/PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require './PHPMailer/PHPMailer/src/SMTP.php';

$username = $_COOKIE['username'];
$email = $_COOKIE['email'];
echo "<script>console.log('" . $username . "');</script>";
echo "<script>console.log('" . $email . "');</script>";
$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');

if(isset($username, $email)) {
	/* Generate random reset token of 64 characters (1 byte = 2 chars) */
    $token = bin2hex(random_bytes(32));
	$conn = mysqli_connect('localhost','loginUser','techhounds','fantasyfrc');
    $query = "UPDATE fantasyusers SET resetToken='". $token ."' WHERE name ='".$username."';";
    mysqli_query($conn,$query);

    
    /* Create new email */
    $mail = new PHPMailer();

    /* Set the mail sender, recipient, subject, and body */
    $mail->setFrom('fantasyfrc868@gmail.com', 'Fantasy FRC Account Support');
    $mail->addAddress($email);
    $mail->Subject = 'Frantasy FRC Password Reset';
    $mail->isHTML(TRUE);
	$mail->Body = '<html>Click <a href="https://techhounds.com/FRC%20Fantasy/newPass.php?resetIdentifier=' . $token . '">here to reset your password</a> on our site. This link will be valid for 15 minutes.</html>';

	/* Use SMTP, encryption, and authentication */
	$mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->SMTPKeepAlive = true;
    /* SMTP login */
    $mail->Username = 'fantasyfrc868@gmail.com';
    $mail->Password = 'team868!';
	
	/* Send Email */
	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message has been sent";
        echo '<script>console.log("Email sent to ' . $email.'")</script>';
	   //'<script>window.location.href = "https://techhounds.com/FRC%20Fantasy/pending.php?email='.$email.'";</script>'
	}
} else {
	echo '<script>console.log("Email not set")</script>';
	//echo '<script>window.location.href = "https://techhounds.com/FRC%20Fantasy/index.php"</script>';
}
?>