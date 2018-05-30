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

			$sqlSum="SELECT sum(B.subtotal) as sum, B.cart_id, B.payment_address1, B.payment_address2, B.payment_address3, B.payment_state, B.payment_city, B.payment_poscode FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."'";
			$querySum=mysqli_query($con,$sqlSum);
			$resultSum=mysqli_fetch_assoc($querySum);
			
			$sqlAdd="SELECT  max(B.cart_id), B.payment_address1, B.payment_address2, B.payment_address3, B.payment_state, B.payment_city, B.payment_poscode FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."' GROUP BY B.payment_address1";
			$queryAdd=mysqli_query($con,$sqlAdd);
			$resultAdd=mysqli_fetch_assoc($queryAdd);
			
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
<script language="javascript">
function confirmdelete()
{
	var pasti=confirm("Are you sure want to delete?");
	if(pasti)
	return true;
	else
	return false;
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
<?php 

	if(isset($_POST['sbmtNewAdd']))
	{
		$sqlNewAdd="INSERT INTO address VALUES ('',capitalize('".$_POST['txtAddress1']."'),capitalize('".$_POST['txtAddress2']."'),capitalize('".$_POST['txtAddress3']."'),capitalize('".$_POST['txtCity']."'),capitalize('".$_POST['txtState']."'),'".$_POST['txtPoscode']."','".$_SESSION['ic']."')";
		$queryNewAdd=mysqli_query($con,$sqlNewAdd) or die(mysqli_error($con));
		
		if($queryNewAdd)
		{
			while($resultProduct1=mysqli_fetch_array($queryProduct))
			{
				$sqlNewPayAdd="UPDATE cart SET payment_address1=capitalize('".$_POST['txtAddress1']."'),payment_address2=capitalize('".$_POST['txtAddress2']."'),payment_address3=capitalize('".$_POST['txtAddress3']."'),payment_city=capitalize('".$_POST['txtCity']."'),payment_state=capitalize('".$_POST['txtState']."'),payment_poscode='".$_POST['txtPoscode']."' WHERE cart_id='".$resultProduct1['cart_id']."'";
				$queryNewPayAdd=mysqli_query($con,$sqlNewPayAdd) or die(mysqli_error($con));
			}
			
			echo"<script type='text/javascript'>
			 alert('Successfully add address!')
			 </script>";
		}
		
		
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=checkout.php\">";
		 
		 
	}

?>
<div class="container wrapper">
            <div class="row cart-head">
                <div class="container">
				
				<br>
				 <center><a href="shoppingCart.php" style="color:#000"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</a>&nbsp;&nbsp;&nbsp;------&nbsp;&nbsp;&nbsp;<a style="color:#00F"><i class="fa fa-truck" aria-hidden="true"></i> Shipping Address</a>&nbsp;&nbsp;&nbsp;------&nbsp;&nbsp;&nbsp;<a style="color:#999"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</a></center>
                 
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
                                    <div class="pull-right"><span>RM </span><span><?php echo $totalTax = $resultSum['sum']*(6/100) ?></span></div>
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
                                    <div class="pull-right"><span>RM </span><span><?php echo $resultSum['sum']+$totalTax ?></span></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--REVIEW ORDER END-->
                </div></form>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Shipping Details</div>
                        <div class="panel-body"><div class="col-xs-12"> <form class="form-horizontal" method="post" action="">                     
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Full Name:</strong>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $resultCust['cust_name'] ?>" readonly />
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><input type="text" pattern="[0-9]{10,11}" name="phone_number" class="form-control" value="<?php echo $resultCust['cust_nophone'] ?>" readonly /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><input name="email_address" class="form-control" value="<?php echo $resultCust['cust_email'] ?>" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" readonly /></div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                        <strong>Your item will be ship here : </strong><br/><br/>
                                        <?php  
											if($resultAdd['payment_address1'] == null)
											{
										?>
                                        <strong>-- Please select address --</strong>
                                        <?php } else { ?>
                                        <strong><p><?php echo $resultSum['payment_address1'] ?></p>
										<p><?php echo $resultSum['payment_address2'] ?></p>
                                        <p><?php echo $resultSum['payment_address3'] ?></p>
                                        <p><?php echo $resultSum['payment_city'] ?>, <?php echo $resultSum['payment_poscode'] ?>, <?php echo $resultSum['payment_city'] ?></p></strong>
                                        <?php } ?>
                                        
                                        
                                </div>
                            </div>
                            <div class="form-group"><hr /></div>
                            </form>
                            <div class="form-group">
                                <div class="col-md-12">
                                        <a href="" data-toggle="modal" data-target="#myAddress"> + Add Address</a>
                                </div>
                                <br/>
                            </div>
                            <div class="form-group">
								 <?php
                                 $sqladdress="select * from address where no_ic = '".$_SESSION['ic']."'";
                                 $query=mysqli_query($con,$sqladdress);
                                 while($resultAddress=mysqli_fetch_array($query))
                                 {
                                 ?>
                                <div class="col-md-5" >
                                <div class="col-md-12" style="background-color: #ffffff; border:0.5px solid #bdc3c7;">
                                
                                <br>
                                <p><?php echo $resultAddress['address1']; ?></p>
                                <p><?php echo $resultAddress['address2']; ?></p>
                                <p><?php echo $resultAddress['address3']; ?></p>
                                <p><?php echo $resultAddress['city']; ?>, <?php echo $resultAddress['poscode']; ?>, <?php echo $resultAddress['state']; ?></p>
                                
                                <a href="delAddress.php?address_id=<?php echo $resultAddress['address_id']; ?>"><button title="Delete this address" type="submit" class="btn btn-default loginFormElement" onClick="return confirmdelete()"><i class="fa fa-trash-o"></i> </button></a>
                                <a href="addPayAdress.php?address_id=<?php echo $resultAddress['address_id']; ?>"><button title="Choose this address" type="submit" class="btn btn-default loginFormElement"><i class="fa fa-check"></i> </button></a>
                                <br>
                                <br>
                                </div></div>
                                <?php } ?>
                                </div>
                                <div class="form-group">
                                <div class="col-md-12"
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <br/>
                                <div class="text-uppercase clearfix">
									<a href="shopMonitor.php" class="btn btn-default pull-left">
										<span class="hidden-xs">Continue Shopping</span>
										<span class="visible-xs">Continue</span>
									</a>
									<?php 
										if($resultAdd['payment_address1'] != null)
											{
									?>
									<a href="payment.php" class="btn btn-default pull-right">		
										Proceed to payment
									</a>
											<?php } ?>
								</div>
                                                                      
                                </div></div>
                            </div>
                        </div><br/></div>
                    </div>
                    <!--SHIPPING METHOD END-->
                    <!--CREDIT CART PAYMENT-->
                   
                    <!--CREDIT CART PAYMENT END-->
                </div>
                
                
            </div>
            <div class="row cart-footer">
        
            </div>
            <div class="modal fade" id="myAddress" role="dialog">
                        <div class="modal-dialog" style="width:50%;">
                        
                          <!-- Modal content-->
                          <div class="modal-content" >
                            <div class="modal-header">
                                <form name="addressForm" action="" method="post">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  
                                </div>
                                <div class="modal-body">
    
                                    Address
                                    <input type="text" name="txtAddress1" value=""  class="form-control"  required>
                                    <input type="text" name="txtAddress2" value=""  class="form-control"  >
                                    <input type="text" name="txtAddress3" value=""  class="form-control"  >
                                    <br>
                                    City
                                    <input type="text" name="txtCity" value=""  class="form-control"  required>
                                    <br>
                                    Poscode
                                    <input type="text" name="txtPoscode" value=""  class="form-control"  required>
                                    <br>
                                    State
                                    <select name="txtState"  class="form-control"  required="required">
												<option value="">- State -</option>
												<option value="Pahang">PAHANG</option>
												<option value="Perak">PERAK</option>
												<option value="Terengganu">TERENGGANU</option>
												<option value="Perlis">PERLIS</option>
												<option value="Selangor">SELANGOR</option>
												<option value="Negeri Sembilan">NEGERI SEMBILAN</option>
												<option value="Johor">JOHOR</option>
												<option value="Kelantan">KELANTAN</option>
												<option value="Kedah">KEDAH</option>
												<option value="Pulau Pinang">PULAU PINANG</option>
												<option value="Melaka">MELAKA</option>
												<option value="Sabah">SABAH</option>
												<option value="Sarawak">SARAWAK</option>
											</select>
                                    
                                    <br>
                                    <center><button type="submit" name="sbmtNewAdd" class="btn btn-success loginFormElement"><i class="fa fa-floppy-o"></i> Save</button></center>
    </form>
                            </div>
                            <div class="modal-footer">
                              <!--<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>-->
                            </div>
                         </div>
                          </div>
    </div>
    <?php mysqli_close($con); ?>
</body>
</html>