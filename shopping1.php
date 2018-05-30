<!DOCTYPE html>
<html lang="en">
<head>
<title>Easy PCTech </title>
<link rel="icon" href="images/New.png" type="image/png" >
<link href="css/image.css"rel="stylesheet" type="text/css" media="all" />

<!-- Custom Theme files -->
<link href="css/bootstrap2.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" /> 
<link href="css/fasthover.css" rel="stylesheet" type="text/css" media="all" />
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

<script type="text/javascript"> 
	function calcTotal(pce, qty, sbt)
	{
		prc = document.getElementById(pce).value;
		qtt = document.getElementById(qty).value;
		document.getElementById(sbt).value=prc*qtt;
	}
</script>
<!-- //end-smooth-scrolling --> 
</head> 

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
			
			$sqlSelect="SELECT * FROM product where product_id='".$_GET['id']."'";
			$querySelect=mysqli_query($con,$sqlSelect);
			$resultSelect=mysqli_fetch_assoc($querySelect);
?>

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
                        <li style="background-color:#4B77BE;"><a href="shopMonitor.php">Shopping</a></li>
					    <li><a href="buildPC.php">Build Your PC</a></li>
                        <li><a href="shoppingCart.php">Cart</a></li>
						<li><a href="custShipping.php">Shipping</a></li>
                        <li><a href="userInfo.php">User Info</a></li>
						<li><a href="logout.php">Log Out</a></li>
						
						
					</ul>
				</div>
			</nav>
	</div>
      
	<!-- //navigation -->
	<!-- banner -->
	
	
	<!-- SIDEBAR -->
	<div class="mobiles">
		<div class="container">
			<div class="w3ls_mobiles_grids">
				<div class="col-md-4 w3ls_mobiles_grid_left">
                <div class="col-md-10">
                    <ul class="nav nav-pills nav-stacked" style="background-color: #ffffff; border:0.5px solid #bdc3c7; box-shadow: 5px 5px 5px 2px gray;">
                        <li><a href="shopMonitor.php">&nbsp;&nbsp;Monitor</a></li>
                        <li><a href="shopProcessor.php">&nbsp;&nbsp;Processor</a></li>
                        <li><a href="shopGraphicCard.php">&nbsp;&nbsp;Graphic Card</a></li>
                        <li><a href="shopKeyboard.php">&nbsp;&nbsp;Keyboard</a></li>
                        <li><a href="shopMouse.php">&nbsp;&nbsp;Mouse</a></li>
                        <li><a href="shopMotherboard.php">&nbsp;&nbsp;Motherboard</a></li>
                        <li><a href="shopFanHeatsink.php">&nbsp;&nbsp;Fan & Heatsink</a></li>
                        <li><a href="shopPowerSupply.php">&nbsp;&nbsp;Power Supply</a></li>
                        <li><a href="shopRAM.php">&nbsp;&nbsp;RAM</a></li>
                        <li><a href="shopNetwork.php">&nbsp;&nbsp;Network Component</a></li>
                        <li><a href="shopScanner.php">&nbsp;&nbsp;Scanner</a></li>
                        <li><a href="shopPrinter.php">&nbsp;&nbsp;Printer</a></li>
                        <li><a href="shopStorage.php">&nbsp;&nbsp;Storage</a></li>
                        <li><a href="shopSoftware.php">&nbsp;&nbsp;Software</a></li>
                    </ul>
               	</div>
	</div>
	<!--- Side Bar --->
    <?php
					 if(isset($_POST['submit']))
					{
						$sqlProduct="SELECT product_id, no_ic FROM cart where product_id='".$resultSelect['product_id']."' and payment_id is null";
						$queryProduct=mysqli_query($con,$sqlProduct) or die (mysqli_error($con));
						$resutProduct=mysqli_fetch_row($queryProduct);
						if($resutProduct == 0)
						{
							
							$sql="INSERT INTO cart(cart_id,no_ic,product_id,quantity,subtotal) VALUES ('','".$_SESSION['ic']."','".$resultSelect['product_id']."','".$_POST['productQuantity']."','".$_POST['subtotal']."')";
							$query=mysqli_query($con,$sql) or die(mysqli_error($con));
							echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
						}
						else
						{
							echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
						}
					}
					
					if(isset($_POST['back']))
					{
						echo "<meta http-equiv=\"refresh\" content=\"0; URL=shopMonitor.php\">";
					}
					
				?>	
				
				
				<div class="col-md-8 w3ls_mobiles_grid_right">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h1 class="page-header"><?php echo $resultSelect['product_name'];?></h1>
                                        </div>
                                    </div>
                                    	<div class="row" >
                                              <form role="form" action="" method="POST">
                                              <div class="col-md-6">
                                              <div class="form-group" style="border:solid;">
                                                      <center>
                                                        <div class="thumb-image"><img src='imgProduct/<?php echo $resultSelect['image_name'];?>' File WIDTH=280 HEIGHT=250 data-imagezoom="true" /></div>
                                                      </center>
                                               </div>
                                                <script defer src="js/jquery.flexslider.js"></script>
                                                <link rel="stylesheet" href="css/flexslider1.css" type="text/css" media="screen" />
                                                <script>
                                                // Can also be used with $(document).ready()
                                                $(window).load(function() {
                                                  $('.flexslider').flexslider({
                                                    animation: "slide",
                                                    controlNav: "thumbnails"
                                                  });
                                                });
                                                </script>
                                            <!-- flexslider -->
                                            <!-- zooming-effect -->
                                                <script src="js/imagezoom.js"></script>
                                            <!-- //zooming-effect -->
                                               
                                               <br> 
                                               <div class="form-group">
                                               		
                                                   <label for="productquantity" class="loginFormElement">Product Quantity:</label>
                                                   <input class="form-control" id="qty<?php echo $resultSelect['product_id'] ?>" name="productQuantity" type="number" pattern="[1-9]{1,}" min="1" value="1" max="<?php echo $resultSelect['product_quantity'] ?>" oninput="calcTotal('pce<?php echo $resultSelect['product_id'] ?>','qty<?php echo $resultSelect['product_id'] ?>','sbt<?php echo $resultSelect['product_id'] ?>');">
                                                   <input type="hidden" id="pce<?php echo $resultSelect['product_id'] ?>" value="<?php echo $resultSelect['product_price'];?>" class="form-control"  required>
                                                   <input class="form-control" id="sbt<?php echo $resultSelect['product_id'] ?>" name="subtotal" type="hidden" value="<?php echo $resultSelect['product_price'];?>">
                                                   
                                                   <br><button type="submit" name="submit" class="btn btn-primary loginFormElement pull-left"><i class="fa fa-cart-plus"></i> Add to cart</button>
                                                   <button type="submit" name="back" class="btn btn-default loginFormElement pull-right"><i class="fa fa-shopping-basket"></i> Continue Shopping</button>
                                                   </div>
                                             </div>
                                              <div class="col-md-6">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                               <label for="productbrand" class="loginFormElement">Product Brand:</label>
                                               <?php echo $resultSelect['product_brand'];?>
                                               </div><br>
                                               <div class="form-group">
                                               <label for="productname" class="loginFormElement">Product Model:</label>
                                               <?php echo $resultSelect['product_model'];?>
                                               </div><br>
                                               <div class="form-group">
                                               <label for="productprice" class="loginFormElement">Product Price (RM):</label>
                                               <?php echo $resultSelect['product_price'];?>.00
                                               </div><br>
                                               <div class="form-group">
                                               <label for="productdescription" class="loginFormElement">Product Description:</label>
											   <?php echo $resultSelect['product_desc'];?>
                                               </div><br><br>
                                               
                                                   
                                             </div></div> 
                                             			
                                            </form>
                                             <!-- <p class="back-link">Easy PCTech </p>-->
                                        </div>
                                        
									
								
                       
                   </div>

	<script type="text/javascript">
		$(window).load(function() {
			$("#flexiselDemo2").flexisel({
				visibleItems:4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:568,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:667,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			
		});
	</script>

		<?php mysqli_close($con); ?>
</body>
</html>