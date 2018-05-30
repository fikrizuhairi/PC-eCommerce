<?php
	include 'connectdb.php';
	require 'PHPMailer/PHPMailerAutoload.php';
	
	
	function sanitizeString($var)
	{
		$var = stripslashes($var);
		$var = htmlentities($var);
		$var = strip_tags($var);
		return $var;
	}

	$ic = $_POST['noIc'];
	
	
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
		$query = "SELECT * FROM customer JOIN login_user WHERE customer.no_ic = login_user.no_ic and customer.no_ic = '". $ic ."'";
		$result = mysqli_query ($con, $query) or exit("The query could not be performed");
		$objResult = mysqli_fetch_array($result);
	
		$email = $objResult["cust_email"];
		
			$mail = new PHPMailer;
		
			// creates object
			$mail->SetLanguage( 'en', 'PHPMailer/language/' );		
		
		
			if($objResult == true)
			{
				$sqlUpd="UPDATE login_user SET password='".md5('#Abcd1234#')."' WHERE no_ic='".$ic."'";
				$query=mysqli_query($con,$sqlUpd);
				if($query)
				{
					$querySupp = "SELECT * FROM supplier";
					$resultSupp = mysqli_query ($con, $querySupp) or exit("The query could not be performed");
					$objResultSupp = mysqli_fetch_array($resultSupp);
					
					// HTML email starts here
					$subject = "Easy PCTech Forgot Password Notifications";
					$message  = "<table width='50%' align='center'><tr><td>
									<center><h1 style='font-family:sans-serif; font-size:30px'>Forgot password notifications</h1>
										<br><p>You have receive a forgot password notifications for your account at Easy PCTech System</p>
										<br>Dear <strong>".$objResult["cust_name"]. "</strong> ,
										<br>
										Your Password has been reset at <strong>Easy PCTech System</strong> 
													<br><br>
													No IC : <strong>".$ic."</strong><br>
													Password : <strong>#Abcd1234#</strong><br>
													 
										<br>
									<center>
									<strong>Have a question ?</strong>
									<br>
									Contact us at ".$objResultSupp["supplier_nophone"]." or ".$objResultSupp["supplier_email"]."
									<br><br>
									</center>
									</td></tr></table>";

					// HTML email ends here
					
					try
					{
						$mail->isSMTP();
						//$mail->Host = 'relay-hosting.secureserver.net';
						//$mail->Port = 25;
						//$mail->SMTPAuth = false;
						//$mail->SMTPSecure = false;
						$mail->Host = 'smtp.gmail.com';
						$mail->SMTPAuth = true;
						$mail->SMTPSecure = 'tls';
						$mail->Port = 587;
						$mail->AddAddress($email);
						$mail->Username   ="easypctech18@gmail.com";  
						$mail->Password   ="#qwertyuiop#"; 				
						$mail->SetFrom('easypctech18@gmail.com','Easy PCTech');
						$mail->AddReplyTo("easypctech18@gmail.com","Confirmation Order");
						$mail->Subject    = $subject;
						$mail->Body 	  = $message;
						$mail->AltBody    = $message;
						$mail->isHTML(true); 
						$mail->SMTPOptions = array
							(
								'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
								)
							);
							
							echo $ic;
						if($mail->Send())
						{
							echo "<script>alert('Your password has been successfully send to your email');";
							echo "window.location.href = 'loginRegister.php';</script>";
						}
						else
						{
							echo "<script>alert('Your password not send to your email');";
							echo "window.location.href = 'loginRegister.php';</script>";
							echo 'Mailer Error: ' . $mail->ErrorInfo;
						}
					}
					catch(phpmailerException $ex)
					{
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					}
				}
				else
				{
					echo "<script>alert('Your password has not update');";
							echo "window.location.href = 'loginRegister.php';</script>";
				}
			}	
	}
		
		mysqli_close($con);
	?>
	<!-- stop php for lost form-->
	
	
	