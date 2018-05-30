<!DOCTYPE html>
<html>
<head>
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy PCTech </title>
	<link rel="icon" href="images/New.png" type="image/png" >
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
    </script>
</head>
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
                <li><a href="updateProduct.php">
					Manage Product
				</a></li>
				<li class="active">Mouse</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Mouse</h1>
			</div>
		</div><!--/.row-->
			<div class="row" >
              <form role="form" action="" method="POST">
              <div class="col-sm-12">
              <?php
                    $sqlSelect="SELECT * FROM product WHERE product_type = 'Mouse'";
                    $querySelect=mysqli_query($con,$sqlSelect);
                    
                     while($resultSelect=mysqli_fetch_array($querySelect))
                     { ?>
              <div class="col-md-3">
              <?php if($resultSelect['product_availability'] == 0){ ?>
              <div class="panel" style="border:solid; border-color:#c0392b">
			  <?php  } else if($resultSelect['product_quantity'] <= 3){ ?>
              <div class="panel" style="border:solid; border-color:#f1c40f">
              <?php } else { ?>
              <div class="panel" style="border:solid; border-color:#FFF">
              <?php } ?>
              <div class="form-group">
              <center><img src='imgProduct/<?php echo $resultSelect['image_name'];?>' File WIDTH=120 HEIGHT=160/></center>
              </div>
              
               <center><label for="productprice" class="loginFormElement">Product Price (RM): <?php echo $resultSelect['product_price'];?></label></center>
               <center><label for="productQuantity" class="loginFormElement">Quantity : <?php echo $resultSelect['product_quantity'];?></label></center>
               <center>
			   <?php if($resultSelect['product_availability'] == 1){ ?>
			   <a href="updateMouse1.php?product_id=<?php echo $resultSelect['product_id'];?>"><button type="button" id="updateProduct" name="submit" class="btn btn-primary loginFormElement">Update</button></a>
			   
			   <a href="delProduct.php?product_id=<?php echo $resultSelect['product_id'];?>"><button type="button" id="deleteProduct" name="submit" class="btn btn-danger loginFormElement">Delete</button></a>
			   <?php } else { ?>
			   <a href="restoreProduct.php?product_id=<?php echo $resultSelect['product_id'];?>"><button type="button" id="deleteProduct" name="submit" class="btn btn-warning loginFormElement">Restore</button></a>
			   <?php } ?>	
			   </center>
               <br> 
             </div></div>
				<?php }
                ?>
			</div>
				</form>
			</div>
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