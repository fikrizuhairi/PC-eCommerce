<?php
		session_start();
		include_once('connectdb.php');
		
		if($_SESSION['ic'] == "")
		{
			echo"<script type='text/javascript'>
	 	 	alert('Session end! Please login again!')
		    location.href='loginRegister.php'
		 	</script>";
			exit();
		}
		
			$sqlSlc="SELECT * FROM supplier where no_ic='".$_SESSION['ic']."'";
			$querySlc=mysqli_query($con,$sqlSlc) or die(mysqli_error($con));
			$resultData=mysqli_fetch_assoc($querySlc);
			
			$sqlSlc1="SELECT * FROM login_user where no_ic='".$_SESSION['ic']."'";
			$querySlc1=mysqli_query($con,$sqlSlc1) or die(mysqli_error($con));
			$resultData1=mysqli_fetch_assoc($querySlc1);
			
			$sqlProduct="SELECT  B.cart_id, A.product_name, B.subtotal, B.quantity FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."'";
			$queryProduct=mysqli_query($con,$sqlProduct) or die (mysqli_error($con));

			$sqlSum="SELECT sum(B.subtotal) as sum, B.cart_id FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."'";
			$querySum=mysqli_query($con,$sqlSum);
			$resultSum=mysqli_fetch_assoc($querySum);
			
			$totalTax = $resultSum['sum']*(6/100);
			$totalSum = $resultSum['sum']+$totalTax;
					
			$sqlCust="SELECT * FROM customer where no_ic='".$_SESSION['ic']."'";
			$queryCust=mysqli_query($con,$sqlCust);
			$resultCust=mysqli_fetch_assoc($queryCust);
			
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Easy PCTech</title>
<link rel="icon" href="images/New.png" type="image/png" >

<!-- Custom Theme files -->
<link href="css/bootstrap2.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/payment.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery.min.js"></script> 

<!-- //js -->  
<!-- web fonts --> 
<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //web fonts --> 
<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<!-- //for bootstrap working -->
<!-- start-smooth-scrolling -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>

<script language="javascript" type="text/javascript">
function validate()
{
var formName=document.passwordForm;

if (formName.txtNewPassword.value != formName.txtConfirmPassword.value)
{
formName.txtConfirmPassword.focus()
alert("Passwords do no match!");
return false;
}

if(formName.txtNewPassword.value.length < 8)
{
formName.txtNewPassword.focus()
return false;	
}
 
 return true;
}
</script>
<link href="css/payment.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //end-smooth-scrolling --> 
</head>
<body> 
	
<center><h1><i class="fa fa-desktop" aria-hidden="true"></i> Easy PCTech</h1></center>
	<!-- navigation -->
	<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
			 <div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
										
									</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="homePage.php">Home</a></li>	
                        <li><a href="shopMonitor.php">Shopping</a></li>
					    <li><a href="buildPC.php">Build Your PC</a></li>
                        <li><a href="shoppingCart.php">Cart</a></li>
						<li><a href="custShipping.php">Shipping</a></li>
                        <li><a href="userInfo.php">User Info</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</nav>
	</div>

<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
				
				<br>
				 <center><a href="shoppingCart.php" style="color:#000"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</a>&nbsp;&nbsp;&nbsp;------&nbsp;&nbsp;&nbsp;<a href="checkout.php" style="color:#000"><i class="fa fa-truck" aria-hidden="true"></i> Shipping Address</a>&nbsp;&nbsp;&nbsp;------&nbsp;&nbsp;&nbsp;<a style="color:#00F"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</a></center>
                 
                <div class="row">
                    <p></p>
                </div>
				<br>
				<br>
				
               
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>  
            <?php
				if(isset($_POST['sbmitOrder']))
				{
					
					$sqlPayment="INSERT INTO payment VALUES ('','".$totalSum."','Credit Card','".$_POST['card_number']."','".$_POST['CreditCardType']."','".$_POST['card_code']."','".$_POST['card_month']."/".$_POST['card_year']."',NOW(),'','PENDING','".$_SESSION['ic']."')";
					$queryPayment=mysqli_query($con,$sqlPayment) ;
					
					if($queryPayment)
					{					
						$sqlCP="SELECT max(payment_id) as pay_id,payment_total FROM payment WHERE no_ic='".$_SESSION['ic']."'";
						$queryCP=mysqli_query($con,$sqlCP) or die(mysqli_error($con));
						$resultCP=mysqli_fetch_assoc($queryCP);
	
						while($resultProduct1=mysqli_fetch_array($queryProduct))
						{
							$sqlUpdCP="UPDATE cart SET payment_id='".$resultCP['pay_id']."' WHERE cart_id='".$resultProduct1['cart_id']."'";
							$queryUpdCP=mysqli_query($con,$sqlUpdCP) or die(mysqli_error($con));

						}
						
						$sqlStock="select A.product_id, A.quantity, B.product_quantity, (B.product_quantity - A.quantity) as balance from cart A, product B where A.product_id = B.product_id and A.payment_id='".$resultCP['pay_id']."'";
						$queryStock=mysqli_query($con,$sqlStock) or die(mysqli_error($con));
						
						while($resultStock=mysqli_fetch_array($queryStock))
						{
							$sql1="UPDATE product SET product_quantity='".$resultStock['balance']."' WHERE product_id='".$resultStock['product_id']."'";	
							$query1=mysqli_query($con,$sql1) or die(mysqli_error($con));
						}

						/*echo"<script type='text/javascript'>
						 alert('Successfully paid!')
						 </script>";*/
						 
					}
					echo"<script type='text/javascript'>
						location.href='payment_mail.php'
						</script>";
					//echo "<meta http-equiv=\"refresh\" content=\"0; URL=payment_mail.php\">";
					//echo "<meta http-equiv=\"refresh\" content=\"0; URL=custShipping.php\">";
				}
			?>  
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                    <!--REVIEW ORDER-->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"></div>
                        </div>
						
                        <div class="panel-body">
                          <div class="col-xs-12">
                          <div class="form-group">
                                <div class="col-xs-7">
                                    <strong>Product Name</strong>
                                </div>
                                <div class="col-xs-2">
                                    <div class="pull-right"><strong>Qty</strong></div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="pull-right"><strong>Price</strong></div>
                                </div>
                            </div>
                          <div class="form-group">
                          <?php while($resultProduct=mysqli_fetch_array($queryProduct))
							{ ?>
                                <div class="col-xs-7">
                                    <small><span><?php echo $resultProduct['product_name']; ?></span></small>
                                </div>
                                <div class="col-xs-2">
                                    <div class="pull-right"><span><?php echo $resultProduct['quantity']; ?> </span></div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="pull-right"><span>RM </span><span><?php echo $resultProduct['subtotal']; ?>.00</span></div>
                                </div>
                           <?php } ?>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Subtotal</strong>
                                    <div class="pull-right"><span>RM </span><span><?php echo $resultSum['sum']; ?>.00</span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Tax Total (6%)</small>
                                    <div class="pull-right"><span>RM </span><span><?php echo $totalTax  ?></span></div>
                                </div>
                                <div class="col-xs-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>Free</span></div>
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>RM </span><span><?php echo $totalSum ?></span></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
					
					 
                    <!--REVIEW ORDER END-->
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-lock"></i></span> Secure Payment</div>
                        <div class="panel-body">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card Type:</strong></div>
                                <div class="col-md-12">
                                    <select id="CreditCardType" name="CreditCardType" class="form-control" required="required">
                                    	<option value="">Card type</option>
                                        <option value="Visa">Visa</option>
                                        <option value="MasterCard">MasterCard</option>
                                        <option value="American Express">American Express</option>
                                        <option value="Discover">Discover</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Credit Card Number:</strong></div>
                                <div class="col-md-12"><input type="text" class="form-control" name="card_number" value="" pattern="[0-9]{13,16}" placeholder="XXXX XXXX XXXX XXXX" required/></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Card CVV:</strong></div>
                                <div class="col-md-12"><input type="text" placeholder="XXX" class="form-control" name="card_code" value="" required /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <strong>Expiration Date</strong>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="card_month" required="required">
                                        <option value="">Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="card_year" required="required">
                                        <option value="">Year</option>
                                        <option value="18">2018</option>
                                        <option value="19">2019</option>
                                        <option value="20">2020</option>
                                        <option value="21">2021</option>
                                        <option value="22">2022</option>
                                        <option value="23">2023</option>
                                        <option value="24">2024</option>
                                        <option value="25">2025</option>
                                        <option value="26">2026</option>
                                        <option value="27">2027</option>
                                        <option value="28">2028</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span>Pay secure using your credit card.</span>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="submit" name="sbmitOrder" class="btn btn-primary btn-submit-fix">Place Order</button>
                                </div>
                            </div>
                        </div></div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                   
                    <!--CREDIT CART PAYMENT END-->
                </div>
                
                </form>
            </div>
            <div class="row cart-footer">
        
            </div>
    </div>
    <?php mysqli_close($con); ?>
</body>
</html>