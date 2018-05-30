<?php
	session_start();
	include 'connectdb.php';
	
	
	
	function sanitizeString($var)
	{
		$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}

	$ic = $_SESSION['ic'];
	
	
	if ($ic == "")
	{
		echo"<script type='text/javascript'>
	 	 	alert('Session end! Please login again!')
		    location.href='loginRegister.php'
		 	</script>";
			exit();
	}
	else
	{
		$query = "SELECT * FROM customer WHERE no_ic = '". $ic ."'";
		$result = mysqli_query ($con, $query) or exit("The query could not be performed");
		$objResult = mysqli_fetch_array($result);
	
		$email = $objResult["cust_email"];
		
			
			require 'PHPMailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;
			
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Custom connection options
//Note that these settings are INSECURE
$mail->SMTPOptions = array(
    'ssl' => [
        'verify_peer' => true,
        'verify_depth' => 3,
        'allow_self_signed' => true,
        'peer_name' => 'smtp.gmail.com',
        'cafile' => '/etc/ssl/ca_cert.pem',
    ],
);
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'azmir.khairil12@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'khairil96';
//Set who the message is to be sent from
$mail->setFrom('azmir.khairil12@gmail.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('nhanisah396@gmail.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer SMTP options test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Send the message, check for errors
if (!$mail->send()) {
	echo $ic;
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
			
	}
	
		

		
		mysqli_close($con);
	?>
	<!-- stop php for lost form-->
	
	
	