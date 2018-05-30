<!DOCTYPE html>
<html lang="en">
<!-- Head -->
<head>
<title>Easy PCTech</title>
<link rel="icon" href="images/New.png" type="image/png" >

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">

<!-- default-css-files -->
<!-- font -->
	<link href="css/bootstrap1.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" type="text/css" href="css/zoomslider.css" />
<!-- default-css-files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- gallery -->
<link rel="stylesheet" href="css/lightGallery.css" type="text/css" media="all" />
<!-- //gallery -->

<!-- Online fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext" rel="stylesheet">
<!-- //Online fonts -->
<!-- js -->
	<script src="js/jquery.min.js"></script>
<!-- //js -->
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!-- style.css-file-->
	<link href="css/style1.css" rel='stylesheet' type='text/css' />
<!-- //style.css-file -->



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

<!--/main-header-->
	<div id="demo-1" data-zs-src='["images/pic1.jpg", "images/pic2.jpg", "images/pic3.jpg","images/pic4.jpg"]' data-zs-overlay="dots">
		<div class="demo-inner-content">
		<!--/header-w3l-->
			   <div class="header-w3-agileits" id="home">
			     <div class="inner-header-agile">	
								<nav class="navbar navbar-default">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
										<h1><i class="fa fa-desktop" aria-hidden="true"></i><a> Easy PCTech</a>
										 
										</h1>
									</div>
									<!-- navbar-header -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
										
										<ul class="nav navbar-nav">
												
												<li><a href="shopMonitor.php" class="scroll">SHOPPING</a></li>
												<li><a href="buildPC.php" class="scroll">BUILD YOUR PC</a></li>
												<li><a href="custShipping.php" class="scroll">SHIPPING</a></li>
												<li><a href="userInfo.php" class="scroll">USER INFO</a></li>
                                                <li><a href="logout.php" class="scroll">LOGOUT</a></li>
										</ul>


									</div>
									<div class="clearfix"> </div>	
								</nav>
									
					
							</div> 

			
		<!--//header-w3l-->
			<!--/banner-info-->
			<div class="w3-banner-head-info">
					<div class="w3-border-banner">
					 </div>
					<div class="baner-info">   
						<h3>WELCOME TO EASY PCTECH</h3>
						<h4>We build the best PC, only for you !</h4>
						<p> Build your PC <br> and start shopping your PC accessories <br> HERE !!</p>
					</div>
			</div>
			<!--/banner-ingo-->
			
		</div>
	</div>
 </div>
  <!--/banner-section-->
 <!--//main-header-->
	
 <script type="text/javascript" src="js/jquery.zoomslider.min.js"></script>
			  
		<!-- smooth scrolling-bottom-to-top -->
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
				<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
				<script src="js/SmoothScroll.min.js"></script>

		<!-- //smooth scrolling-bottom-to-top -->
	<!--js for bootstrap working-->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->


				 
<?php mysqli_close($con); ?>

</body>
</html>
