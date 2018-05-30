<?php
		include_once('connectdb.php');
?>

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
<!-- //end-smooth-scrolling --> 
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
						<li><a href="homePageGuest.php">Home</a></li>	
                        <li style="background-color:#4B77BE;"><a href="shopMonitor.php">Shopping</a></li>
					    <li><a href="guestBuildPC.php">Build Your PC</a></li>
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
                        <li><a href="guestShopMonitor.php">&nbsp;&nbsp;Monitor</a></li>
                        <li><a href="guestShopProcessor.php">&nbsp;&nbsp;Processor</a></li>
                        <li><a href="guestShopGraphicCard.php">&nbsp;&nbsp;Graphic Card</a></li>
                        <li><a href="guestShopKeyboard.php">&nbsp;&nbsp;Keyboard</a></li>
                        <li><a href="guestShopMouse.php">&nbsp;&nbsp;Mouse</a></li>
                        <li><a href="guestShopMotherboard.php">&nbsp;&nbsp;Motherboard</a></li>
                        <li><a href="guestShopFanHeatsink.php">&nbsp;&nbsp;Fan & Heatsink</a></li>
                        <li class="active"><a href="guestShopPowerSupply.php">&nbsp;&nbsp;Power Supply</a></li>
                        <li><a href="guestShopRAM.php">&nbsp;&nbsp;RAM</a></li>
                        <li><a href="guestShopNetwork.php">&nbsp;&nbsp;Network Component</a></li>
                        <li><a href="guestShopScanner.php">&nbsp;&nbsp;Scanner</a></li>
                        <li><a href="guestShopPrinter.php">&nbsp;&nbsp;Printer</a></li>
                        <li><a href="guestShopStorage.php">&nbsp;&nbsp;Storage</a></li>
                        <li><a href="guestShopSoftware.php">&nbsp;&nbsp;Software</a></li>
                    </ul>
               	</div>
	</div>
	<!--- Side Bar --->
	<?php
					 if(isset($_POST['submit']))
					{
						$sqlProduct="SELECT product_id, no_ic FROM cart where product_id='".$_POST['id']."' and no_ic='".$_SESSION['ic']."' and payment_id is null";
						$queryProduct=mysqli_query($con,$sqlProduct) or die (mysqli_error($con));
						$resutProduct=mysqli_fetch_row($queryProduct);
						if($resutProduct == 0)
						{
							echo"<script type='text/javascript'>
							alert('Session end! Please login again!')
							location.href='loginRegister.php'
							</script>";
							exit();
						}
						else
						{
							echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
						}
					}
					
				?>	
				
				<div class="col-md-8 w3ls_mobiles_grid_right">

					<div class="clearfix"> </div>
					<div class="w3ls_mobiles_grid_right_grid2">
					<?php
						$sqlSelect="SELECT * FROM product where product_type='Power Supply' AND product_availability = '1' order by product_price asc";
						$querySelect=mysqli_query($con,$sqlSelect);
						$rowResult = mysqli_num_rows($querySelect);
                    ?>
						<div class="w3ls_mobiles_grid_right_grid2_left">
							<h3>Showing Results: <?php echo $rowResult;?> - <?php echo $rowResult;?></h3>
						</div>
						<!--<div class="w3ls_mobiles_grid_right_grid2_right">
							<select name="select_item" class="select_item">
								<option selected="selected">Default sorting</option>
								<option>Sort by popularity</option>
								<option>Sort by newness</option>
								<option>Sort by price: low to high</option>
								<option>Sort by price: high to low</option>
							</select>
						</div>-->
						<div class="clearfix"> </div>
					</div>
                   
                    <?php
                     while($resultSelect=mysqli_fetch_array($querySelect))
                     { ?>
					<div id="myTabContent" class="tab-content">
						
							<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles" >
                                <div class="agile_ecommerce_tab_left mobiles_grid" style="border:double #bdc3c7" >
                                    <form action="" method="post">
                                    	
                                        <div class="form-group" >
                                            <div class="container1">
                                                <center><img src='imgProduct/<?php echo $resultSelect['image_name'];?>' class="image" /></center>
                                                <div class="middle">
                                                    <div class="text"><a href="guestShopping1.php?id=<?php echo $resultSelect['product_id'];?>"><?php echo $resultSelect['product_name'];?></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                       		 <?php if($resultSelect['product_quantity'] == '0') {?>
                                       		<p style="font-weight: bold;">Out of Stock </p>
                                            <p> RM <?php echo $resultSelect['product_price'];?></p> 
                                                <input type="hidden" name="amount" value="<?php echo $resultSelect['product_price'];?>"/> 
                                                <input type="hidden" name="id" value="<?php echo $resultSelect['product_id'];?>"/>   
                                                <button type="button"  class="btn btn-danger loginFormElement"><i class="fa fa-cart-plus"></i> Out of Stock</button>
											<?php } else { ?> 
                                            <p style="font-weight: bold;">In Stock </p> 
											
                                            <p> RM <?php echo $resultSelect['product_price'];?></p> 
                                                <input type="hidden" name="amount" value="<?php echo $resultSelect['product_price'];?>"/> 
                                                <input type="hidden" name="id" value="<?php echo $resultSelect['product_id'];?>"/>   
                                                <button type="submit" name="submit" class="btn btn-primary loginFormElement"><i class="fa fa-cart-plus"></i> Add to cart</button><?php } ?>
                                        </div> 
									</form>
								</div>
                                <br/>
							</div>
                       
                   </div>
                   
                   
						 <?php } ?>
				
	
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