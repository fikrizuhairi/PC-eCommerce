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
		
		$Products_Id=$_GET['product_id'];

		$sqlProduct = "SELECT * FROM product WHERE product_id='$Products_Id'";
		$queryProduct=mysqli_query($con,$sqlProduct) or die(mysqli_error($con));
		$resultData2=mysqli_fetch_assoc($queryProduct);
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
                <li><a href="updateFansHeatsink.php">
					Fans & Heatsinks
				</a></li>
				<li class="active"><?php echo $resultData2['product_name'];?></li>
			</ol>
		</div><!--/.row-->
<?php
	if(isset($_POST['submit']))
	{
		$sqlUpd="UPDATE product SET product_price='".$_POST['productPrice']."',product_quantity='".$_POST['productQuantity']."',product_desc='".$_POST['productDesc']."' where product_id='$Products_Id'";
		$queryUpd=mysqli_query($con,$sqlUpd) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully Updated!')
		 </script>";
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=updateFansHeatsink.php\">";
	}

?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo $resultData2['product_name'];?></h1>
			</div>
		</div><!--/.row-->
			<div class="row" >
              <form role="form" action="" method="POST">
              <div class="col-md-6">
              <div class="form-group" style="border:solid;">
              <center><img src='imgProduct/<?php echo $resultData2['image_name'];?>' File WIDTH=150 HEIGHT=200/></center>
              </div>
                <div class="form-group">
               <label for="productdescription" class="loginFormElement">Product Description:</label>
                    <textarea name="productDesc" style="width: 100%;"><?php echo $resultData2['product_desc'];?>
                    </textarea>
               </div>
               
               <br> 
             </div>
                <div class="col-md-6">
                <div class="form-group">
               <label for="productname" class="loginFormElement">Product Name:</label>
               <input class="form-control" id="productName" name="productName" type="text" value="<?php echo $resultData2['product_name'];?>" readonly >
               </div>
                <div class="form-group">
               <label for="productbrand" class="loginFormElement">Product Brand:</label>
               <input class="form-control" id="productbrand" name="productBrand" type="text" value="<?php echo $resultData2['product_brand'];?>" readonly >
               </div>
               <div class="form-group">
               <label for="productname" class="loginFormElement">Product Model:</label>
               <input class="form-control" id="productmodel" name="productModel" type="text" value="<?php echo $resultData2['product_model'];?>" readonly >
               </div>
               <div class="form-group">
               <label for="productprice" class="loginFormElement">Product Price (RM):</label>
               <input class="form-control" id="productPrice" name="productPrice" type="text" pattern="\d+(\.\d{2})?" placeholder="eg: 23.00" value="<?php echo $resultData2['product_price'];?>" >
               </div>
                <div class="form-group">
               <label for="productquantity" class="loginFormElement">Product Quantity:</label>
               <input class="form-control" id="productQuantity" name="productQuantity" type="number" pattern="[1-9]{1,}" value="<?php echo $resultData2['product_quantity'];?>" min="1" >
               </div>
             </div>
               
             	
             <br>			
			<div class="col-sm-12">
			<center><button type="submit" id="updateProduct" name="submit" class="btn btn-success loginFormElement">Update Product</button>
           <a href="updateFansHeatsink.php"><button type="button" id="cancel" name="cancel" class="btn btn-danger loginFormElement">Cancel</button></a></center>
				<br>
			</div></form>
                 <!-- <p class="back-link">Easy PCTech </p>-->
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