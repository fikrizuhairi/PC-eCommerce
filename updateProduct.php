<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy PCTech </title>
	<link rel="icon" href="images/New.png" type="image/png" >
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-select.css"><!-- bootstrap-select-CSS -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" /><!-- flexslider-CSS -->
	<link href="css/styles.css" rel="stylesheet">
	
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
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
?>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Easy PCTech</span>Admin</a>
				
						
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">		
		<ul class="nav menu">
			<li><a href="adminMenu.php"><em class="fa fa-home">&nbsp;</em> Menu</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-product-hunt">&nbsp;</em> Product <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="addProduct.php">
						<span class="fa fa-plus">&nbsp;</span> Add Product
					</a></li>
					<li class="active"><a class="" href="updateProduct.php">
						<span class="fa fa-refresh">&nbsp;</span> Update Product
					</a></li>
				</ul>	
			</li>
			<li><a href="adminShipping.php"><em class="fa fa-truck">&nbsp;</em> Shipping</a></li>
            <li><a href="adminStat.php"><em class="fa fa-area-chart">&nbsp;</em> Statistic Sold Item</a></li>
			<li><a href="custInfo.php"><em class="fa fa-users">&nbsp;</em> Customer Info</a></li>
            <li><a href="userInfoAdmin.php"><em class="fa fa-user">&nbsp;</em> User Info</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="adminMenu.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Manage Product</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Manage Product</h1>
			</div>
		</div><!--/.row-->
		<!-- content-starts-here -->
		<div class="main-content">
			<div class="w3-categories">
				<h3>Select Categories</h3>
				<div class="container">
					<div class="col-md-3">
						<div class="focus-grid w3layouts-boder1">
						<a class="btn-8" href="updateMonitor.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Monitor</h4>
								</div>
							</div>
						</a>
						</div>
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder2">
						<a class="btn-8" href="updateProcessor.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Processor</h4>
								</div>
							</div>
						</a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder3">
						<a class="btn-8" href="updateGraphicCard.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Graphic Card</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder4">
						<a class="btn-8" href="updateKeyboard.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Keyboard</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder5">
							<a class="btn-8" href="updateMouse.php">
								<div class="focus-border">
									<div class="focus-layout">
										<h4 class="clrchg">Mouse</h4>
									</div>
								</div>
							</a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder6">	
						<a class="btn-8" href="updateMotherboard.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Motherboard</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder7">
						<a class="btn-8" href="updateFansHeatsink.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Fans & Heatsinks</h4>
								</div>
							</div>
						</a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder8">
						<a class="btn-8" href="updatePowerSupply.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Power Supply</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder9">
						<a class="btn-8" href="updateRAM.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">RAM</h4>
								</div>
							</div>
						</a>
					</div>
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder10">
						<a class="btn-8" href="updateNetworkComponent.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Network Component</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder11">
						<a class="btn-8" href="updateScanner.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Scanner</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder12">
						<a class="btn-8" href="updatePrinter.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Printer</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder1">
						<a class="btn-8" href="updateStorage.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Storage</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="col-md-3">
					<div class="focus-grid w3layouts-boder2">
						<a class="btn-8" href="updateSoftware.php">
							<div class="focus-border">
								<div class="focus-layout">
									<h4 class="clrchg">Software</h4>
								</div>
							</div>
						</a>
					</div>	
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- most-popular-ads -->									
		
			<!-- //slider -->				
			</div>
			<!--partners-->
			
		
        <!--footer section end-->
		<!-- Navigation-Js-->
			<script type="text/javascript" src="js/main.js"></script>
			<script type="text/javascript" src="js/classie.js"></script>
		<!-- //Navigation-Js-->
		<!-- js -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<!-- js -->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/bootstrap.js"></script>
		<script src="js/bootstrap-select.js"></script>
		<script>
		  $(document).ready(function () {
			var mySelect = $('#first-disabled2');

			$('#special').on('click', function () {
			  mySelect.find('option:selected').prop('disabled', true);
			  mySelect.selectpicker('refresh');
			});

			$('#special2').on('click', function () {
			  mySelect.find('option:disabled').prop('disabled', false);
			  mySelect.selectpicker('refresh');
			});

			$('#basic2').selectpicker({
			  liveSearch: true,
			  maxOptions: 1
			});
		  });
		</script>
		<!-- language-select -->
		<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
		<link href="css/jquery.uls.css" rel="stylesheet"/>
		<link href="css/jquery.uls.grid.css" rel="stylesheet"/>
		<link href="css/jquery.uls.lcd.css" rel="stylesheet"/>
		<!-- Source -->
		<script src="js/jquery.uls.data.js"></script>
		<script src="js/jquery.uls.data.utils.js"></script>
		<script src="js/jquery.uls.lcd.js"></script>
		<script src="js/jquery.uls.languagefilter.js"></script>
		<script src="js/jquery.uls.regionfilter.js"></script>
		<script src="js/jquery.uls.core.js"></script>
		<script>
					$( document ).ready( function() {
						$( '.uls-trigger' ).uls( {
							onSelect : function( language ) {
								var languageName = $.uls.data.getAutonym( language );
								$( '.uls-trigger' ).text( languageName );
							},
							quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
						} );
					} );
				</script>
		<!-- //language-select -->
		<script type="text/javascript" src="js/jquery.flexisel.js"></script><!-- flexisel-js -->	
					<script type="text/javascript">
						 $(window).load(function() {
							$("#flexiselDemo3").flexisel({
								visibleItems:1,
								animationSpeed: 1000,
								autoPlay: true,
								autoPlaySpeed: 5000,    		
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: { 
									portrait: { 
										changePoint:480,
										visibleItems:1
									}, 
									landscape: { 
										changePoint:640,
										visibleItems:1
									},
									tablet: { 
										changePoint:768,
										visibleItems:1
									}
								}
							});
							
						});
					   </script>
		<!-- Slider-JavaScript -->
			<script src="js/responsiveslides.min.js"></script>	
			 <script>
			$(function () {	
			  $("#slider").responsiveSlides({
				auto: true,
				pager: false,
				nav: true,
				speed: 500,
				maxwidth: 800,
				namespace: "large-btns"
			  });

			});
		  </script>
		<!-- //Slider-JavaScript -->
		<!-- here stars scrolling icon -->
			<script type="text/javascript">
				$(document).ready(function() {
					/*
						var defaults = {
						containerID: 'toTop', // fading element id
						containerHoverID: 'toTopHover', // fading element hover id
						scrollSpeed: 1200,
						easingType: 'linear' 
						};
					*/
										
					$().UItoTop({ easingType: 'easeOutQuart' });
										
					});
			</script>
			<!-- start-smoth-scrolling -->
			<script type="text/javascript" src="js/move-top.js"></script>
			<script type="text/javascript" src="js/easing.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){		
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});
			</script>
			<!-- start-smoth-scrolling -->
		<!-- //here ends scrolling icon -->
</body>		
			
				<p class="back-link">Easy PCTech </p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		<?php mysqli_close($con); ?>
</body>
</html>