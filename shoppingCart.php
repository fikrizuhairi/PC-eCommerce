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
			
			$sqlProduct="SELECT  B.cart_id,B.product_id, A.product_name, A.product_price, A.image_name, A.product_type, B.subtotal, B.quantity, A.product_quantity FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."'";
			$queryProduct=mysqli_query($con,$sqlProduct) or die (mysqli_error($con));
			

			$sqlSum="SELECT sum(B.subtotal) as sum, B.cart_id FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."'";
			$querySum=mysqli_query($con,$sqlSum);
			$resultSum=mysqli_fetch_assoc($querySum);
			
?>
<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Easy PCTech</title>
	
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Google Web Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	
	<!-- CSS Files -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style_2.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link rel="icon" href="images/New.png" type="image/png" >
	<link href="css/image.css"rel="stylesheet" type="text/css" media="all" />
	<link href="css/bootstrap2.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" /> 
	<link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.css" rel="stylesheet">
	
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
	</script>
    
    <script type="text/javascript"> 

	
	function calcTotal(pce, qty, sbt, sbt1)
	{
		prc = document.getElementById(pce).value;
		qtt = document.getElementById(qty).value;
		document.getElementById(sbt).innerHTML=prc*qtt;
		document.getElementById(sbt1).value=prc*qtt;


	}


</script>
	
	<!--[if lt IE 9]>
		<script src="js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/fav-144.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/fav-114.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/fav-72.png">
	<link rel="apple-touch-icon-precomposed" href="images/fav-57.png">
	<link rel="shortcut icon" href="images/fav.png">
	
</head>

<body>
	<center><h1><i class="fa fa-desktop" aria-hidden="true"></i> Easy PCTech</h1></center>
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
                        <li style="background-color:#4B77BE;"><a href="shoppingCart.php">Cart</a></li>
						<li><a href="custShipping.php">Shipping</a></li>
                        <li><a href="userInfo.php">User Info</a></li>
						<li><a href="logout.php">Log Out</a></li>
						
						
					</ul>
				</div>
			</nav>
	</div>
	<?php
		if(isset($_POST['submit']))
		{
			$sql="UPDATE cart SET quantity='".$_POST['quantity']."',subtotal='".$_POST['subtotal']."' WHERE cart_id='".$_GET['id']."'";
			$query=mysqli_query($con,$sql) or die(mysqli_error($con));
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
	
		}
		
		if(isset($_POST['delete']))
		{
			$sql="DELETE FROM cart WHERE cart_id='".$_GET['id']."'";
			$query=mysqli_query($con,$sql) or die(mysqli_error($con));
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
	
		}
	?>		
		
	<!-- Main Container Starts -->
		<div id="main-container" class="container">
		
		<!-- Main Heading Starts -->
		<br>
			<center><a style="color:#00F"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</a>&nbsp;&nbsp;&nbsp;------&nbsp;&nbsp;&nbsp;<a style="color:#999"><i class="fa fa-truck" aria-hidden="true"></i> Shipping Address</a>&nbsp;&nbsp;&nbsp;------&nbsp;&nbsp;&nbsp;<a style="color:#999"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</a></center>
		<!-- Main Heading Ends -->
		<!-- Shopping Cart Table Starts -->
         
			<div class="table-responsive shopping-cart-table">
           
				<table class="table table-bordered">
					<thead>
						<tr>
							<td class="text-center">
								Item
							</td>
							<td class="text-center">
								Product Name
							</td>							
							<td class="text-center" width="10%">
								Quantity
							</td>
							<td class="text-center">
								Price
							</td>
							<td class="text-center">
								Total
							</td>
							<td class="text-center">
								Action
							</td>
						</tr>
					</thead>
                   
                    <tbody> 
                    
					<?php	while($resultProduct=mysqli_fetch_array($queryProduct))
							{ ?>
                    <form action="shoppingCart.php?id=<?php echo $resultProduct['cart_id'] ?>" method="POST">
						<tr>
							<td class="text-center">
								<a href="shopping1.php?id=<?php echo $resultProduct['product_id'] ?>">
									<img src="imgProduct/<?php echo $resultProduct['image_name'];?>" File WIDTH=120 HEIGHT=110 alt="<?php echo $resultProduct['product_name'] ?>" title="<?php echo $resultProduct['product_name'] ?>" class="img-thumbnail" />
								</a>
							</td>
							<td class="text-center">
								<a href="shopping1.php?id=<?php echo $resultProduct['product_id'] ?>">
								<p><b><?php echo $resultProduct['product_type'] ?></b></p><br/>
								<?php echo $resultProduct['product_name'] ?></a>
							</td>							
							<td class="text-center">
								<div class="input-group btn-block">
									<input min="1" name="quantity" type="number" id="qty<?php echo $resultProduct['cart_id'] ?>" value="<?php echo $resultProduct['quantity'] ?>" max="<?php echo $resultProduct['product_quantity'] ?>"  class="form-control" oninput="calcTotal('pce<?php echo $resultProduct['cart_id'] ?>','qty<?php echo $resultProduct['cart_id'] ?>','sbt<?php echo $resultProduct['cart_id'] ?>','sbt1<?php echo $resultProduct['cart_id'] ?>');"  required>
                                
								</div>								
							</td>
							<td class="text-center">
								<label id="pce1">RM <?php echo $resultProduct['product_price'] ?>.00</label>
                                <input type="hidden" id="pce<?php echo $resultProduct['cart_id'] ?>" value="<?php echo $resultProduct['product_price'] ?>"  class="form-control"  required>
							</td>
							<td class="text-center">
								<label>RM</label> <label id="sbt<?php echo $resultProduct['cart_id'] ?>"> <?php echo $resultProduct['subtotal'] ?></label><label>.00</label>
                               <input type="hidden" name="subtotal" id="sbt1<?php echo $resultProduct['cart_id'] ?>">
							</td>
							<td class="text-center">
								<button type="submit" name="submit" title="Update" class="btn btn-default tool-tip">
									<i class="fa fa-refresh"></i>
								</button>
								<button type="submit" name="delete" title="Remove" class="btn btn-default tool-tip">
									<i class="fa fa-times-circle"></i>
								</button>
							</td>
						</tr></form>	
							<?php }?>					
					</tbody>
					<tfoot>
						<tr>
						  <td colspan="4" class="text-right">
							<strong>Total Amount :</strong>
						  </td>
						  <td colspan="2" class="text-left">
							<label>RM <?php echo $resultSum['sum'] ?>.00</label>
						  </td>
						</tr>
					</tfoot>
                    
				</table>
                	
			</div>
            
		<!-- Shopping Cart Table Ends -->
		<!-- Shipping Section Starts -->
			<section class="registration-area">
				<div class="row">
				<!-- Shipping & Shipment Block Starts -->
					<div class="col-sm-6">
                    <!-- Conditions Panel Starts -->
						<div class="panel panel-smart">
							<div class="panel-heading">
								<h3 class="panel-title">
									When will I receive my items?
								</h3>
							</div>
							<div class="panel-body">
								<p>
									The delivery timeframe is an estimation of when your items will be delivered to your shipping address. This includes order verification, item processing, plus carrier shipment. You will be able to see more information on your delivery dates at shipping section.
								</p>								
							</div>
						</div>
					<!-- Conditions Panel Ends -->
					
					</div>
				<!-- Shipping & Shipment Block Ends -->
				<!-- Discount & Conditions Blocks Starts -->
					<div class="col-sm-6">
					
					
					<!-- Total Panel Starts -->
						<div class="panel panel-smart">
							<div class="panel-heading">
								<h3 class="panel-title">
									Total
								</h3>
							</div>
							<div class="panel-body">
								<dl class="dl-horizontal">
									<dt>Subtotal :</dt>
									<dd>RM <?php echo $resultSum['sum'] ?>.00</dd>
									<dt>Tax Total (6%) :</dt>
									<dd>RM <?php echo $totalTax = $resultSum['sum']*(6/100) ?></dd>
								</dl>
								<hr />
								<dl class="dl-horizontal total">
									<dt>Total :</dt>
									<dd>RM <?php echo $resultSum['sum']+$totalTax ?></dd>
								</dl>
								<hr />
								<div class="text-uppercase clearfix">
									<a href="shopMonitor.php" class="btn btn-default pull-left">
										<span class="hidden-xs">Continue Shopping</span>
										<span class="visible-xs">Continue</span>
									</a>
									<a href="checkout.php" class="btn btn-default pull-right">		
										Checkout
									</a>
								</div>
                                
							</div>
						</div>
					<!-- Total Panel Ends -->
					</div>
				<!-- Discount & Conditions Blocks Ends -->
				</div>
			</section>
		<!-- Shipping Section Ends -->
		</div>
	<!-- Main Container Ends -->
	
	<!-- JavaScript Files -->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/jquery-migrate-1.2.1.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-hover-dropdown.min.js"></script>
	<script src="js/custom_2.js"></script>
    <?php mysqli_close($con); ?>
</body>
</html>