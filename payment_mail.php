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
		$sqlCP="SELECT max(payment_id) as pay_id FROM payment WHERE no_ic='". $ic ."'";
		$queryCP=mysqli_query($con,$sqlCP) or die(mysqli_error($con));
		$resultCP=mysqli_fetch_assoc($queryCP);
		
		$sqlproduct="SELECT D.product_name, B.quantity, A.payment_total, D.product_price, B.subtotal FROM payment A, cart B, product D WHERE A.payment_id = B.payment_id and B.product_id = D.product_id and B.no_ic = '".$ic."' and B.payment_id='".$resultCP['pay_id']."'";
		$queryproduct=mysqli_query($con,$sqlproduct) or die(mysqli_error($con));
								
		$sqlSum="SELECT sum(B.subtotal) as sum, B.cart_id FROM product A, cart B where B.product_id = A.product_id and B.payment_id='".$resultCP['pay_id']."' and B.no_ic = '".$ic."'";
		$querySum=mysqli_query($con,$sqlSum);
		$resultSum=mysqli_fetch_assoc($querySum);
								
		$totalTax = $resultSum['sum']*(6/100);
		
		$query = "SELECT * FROM customer JOIN cart JOIN payment WHERE  cart.no_ic = customer.no_ic and payment.payment_id = cart.payment_id and cart.no_ic = '".$ic."' and payment.payment_id='".$resultCP['pay_id']."'";
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
				$subject = "Easy PCTech Confirmation Order - #".$resultCP['pay_id']."";
				$message  = "<table width='50%' align='center'><tr><td>
									<center>
									Your order is in process
									<h1 style='font-family:sans-serif; font-size:40px'>Order Confirmation</h1>
									<br>Dear <strong>".$objResult["cust_name"]. "</strong> ,
									<br>
									We're currently processing your order. You'll get updates on your order status once your item(s) are shipped. 
									<br><br><br>
									<strong>Have a question ?</strong>
									<br>
									Contact us at ".$objResultSupp["supplier_nophone"]." or ".$objResultSupp["supplier_email"]."
									<br><br>
									</center>
									
									<table style='background-color:#ecf0f1; width:100%'><tr><td><br>
									<strong>Order Number</strong> : #".$resultCP['pay_id']." <br><br>
									<strong>Order Date</strong> : ".date('d M Y',strtotime($objResult["payment_date"]))." - ".date('h:i A',strtotime($objResult["payment_date"]))." <br>
									<strong>Order By</strong> : ".$objResult["cust_name"]. " <br>
									<strong>Payment Method</strong> : ".$objResult["payment_method"]." <br>
									<strong>Contact Info</strong> : ".$objResult["cust_nophone"]." <br><br>
									</td></tr></table>
									<br>
									<strong>Delivery method</strong> : Standard Delivery <br><br>
									<strong>Ship To</strong> : ".$objResult["payment_address1"]." ".$objResult["payment_address2"]." ".$objResult["payment_address3"].", ".$objResult["payment_city"].", ".$objResult["payment_poscode"].", ".$objResult["payment_state"]."<br><br><br>
									
									<p style='border-bottom:solid #bdc3c7'><strong>Item ordered</strong></p>
									<table style='width:100%' align='left'>
										<thead >
											<th width='60%' align='left' style='border-bottom:double #bdc3c7'>Item</th>
											<th width='10%' align='left' style='border-bottom:double #bdc3c7'>Qty</th>
											<th width='15%' align='left' style='border-bottom:double #bdc3c7'>Price</th>
											<th width='15%' align='left' style='border-bottom:double #bdc3c7'>Total</th>
										</thead>
										<tbody>
										"; while ($objResult1 = mysqli_fetch_array($queryproduct)) { 
										$message .= "
											<tr>
												<td>".$objResult1["product_name"]."</td>
												<td>".$objResult1["quantity"]."</td>
												<td>RM ".$objResult1["product_price"].".00</td>
												<td>RM ".$objResult1["subtotal"].".00</td>
											</tr>
										"; } 
										$message .= "
											<tr>
												<td></td>
												<td colspan='2' align='left'><strong>Subtotal</strong></td>
												<td>RM ".$resultSum["sum"].".00</td>
											</tr>
											<tr>
												<td></td>
												<td colspan='2' align='left'><strong>Tax Total (6%)</strong></td>
												<td>RM ".$totalTax."</td>
											</tr>
											<tr>
												<td></td>
												<td colspan='2' align='left'><strong>Shipping</strong></td>
												<td>Free</td>
											</tr>
											<tr>
												<td></td>
												<td colspan='2' align='left'><strong>Order Total</strong></td>
												<td>RM ".$objResult["payment_total"]."</td>
											</tr>
											
										</tbody>
									</table>
									
									<br><br>
									<center>
									
									<br></center>
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
						echo "<script>alert('Your order confimation have send to your email');";
						echo "window.location.href = 'custShipping.php';</script>";
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
	
	
	