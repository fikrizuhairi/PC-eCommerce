<?php
	session_start();
	include 'connectdb.php';
	require 'PHPMailer/PHPMailerAutoload.php';
	
	
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

		$query = "SELECT * FROM customer JOIN cart JOIN payment WHERE  cart.no_ic = customer.no_ic and payment.payment_id = cart.payment_id and payment.payment_id='".$_GET['id']."'";
		$result = mysqli_query ($con, $query) or exit("The query could not be performed");
		$objResult = mysqli_fetch_array($result);
	
		$email = $objResult["cust_email"];
		
			$mail = new PHPMailer;
		
			// creates object
			$mail->SetLanguage( 'en', 'PHPMailer/language/' );		
		
		
			if($objResult == true)
			{
				
								
				$querySupp = "SELECT * FROM supplier";
				$resultSupp = mysqli_query ($con, $querySupp) or exit("The query could not be performed");
				$objResultSupp = mysqli_fetch_array($resultSupp);
			
				// HTML email starts here
				$subject = "Your Order Has Shipped - #".$_GET["id"]."";
				$message  = "<table width='50%' align='center'><tr><td>
									<center>
									
									<h1 style='font-family:sans-serif; font-size:40px'>Your Order Has Shipped</h1>
									<br>Good news, <strong>".$objResult["cust_name"]. "</strong> - your order is on its way!
									<br>
									<br>
									</center>
									
									<table style='background-color:#ecf0f1; width:100%'><tr><td><br>
									Order Number : <strong>#".$_GET["id"]."</strong><br>
									Your Tracking Number : <strong>".$objResult["tracking_num"]."</strong> <br>
									Delivery Method:<strong> Standard Delivery , PosLaju </strong> <br>
									Ship To : <strong>".$objResult["cust_name"]. "</strong> <br>
									Address : <strong>".$objResult["payment_address1"]." ".$objResult["payment_address2"]." ".$objResult["payment_address3"].", ".$objResult["payment_city"].", ".$objResult["payment_poscode"].", ".$objResult["payment_state"]."</strong> <br>
									Contact Info : <strong>".$objResult["cust_nophone"]."</strong> <br><br>
									</td></tr></table>
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
						//echo "<script>alert('Tracking order confimation have send to your email');";
						//echo "window.location.href = 'adminShipping.php'</script>";
						echo "<meta http-equiv=\"refresh\" content=\"0; URL=adminShipping.php\">";
					}
					else
					{
						//echo "<script>alert('Your password not send to your email');";
						//echo "window.location.href = 'custShipping.php';</script>";
						echo 'Mailer Error: ' . $mail->ErrorInfo;
					}
				}
				catch(phpmailerException $ex)
				{
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				}
		}	
			

	}
		
		mysqli_close($con);
	?>
	<!-- stop php for lost form-->
	
	
	