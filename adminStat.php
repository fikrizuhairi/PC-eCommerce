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

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy PCTech</title>
    <link rel="icon" href="images/New.png" type="image/png" >
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="js/Chart.js"></script>
	
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
				<a class="navbar-brand" href="adminMenu.php"><span>Easy PCTech</span>Admin</a>
				<center><span>Welcome</span></center>
						
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<div class="divider"></div>
		
		<ul class="nav menu">
			<li><a href="adminMenu.php"><em class="fa fa-home">&nbsp;</em> Menu</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-product-hunt">&nbsp;</em> Product <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="addProduct.php">
						<span class="fa fa-plus">&nbsp;</span> Add Product
					</a></li>
					<li><a class="" href="updateProduct.php">
						<span class="fa fa-refresh">&nbsp;</span> Update Product
					</a></li>
				</ul>	
			</li>
			<li><a href="adminShipping.php"><em class="fa fa-truck">&nbsp;</em> Shipping</a></li>
            <li class="active"><a href="adminStat.php"><em class="fa fa-area-chart">&nbsp;</em> Statistic Sold Item</a></li>
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
				<li class="active">Statistic Sold Item</li>
			</ol>
		</div><!--/.row-->
		
		<h3>Profit Based On Categories</h3>
		
		<?php
			if(!isset($_GET['year'])){
				echo '';
				$yearqry ='2017';
			}
			else{
				$yearqry = $_GET['year'];
			}

			?>
		
		<div class="col-md-12" style='background-color:white;'> 	
		 <canvas id="myChart" width="400" height="150"></canvas>
		 <center>
			<form >
			<?php
			if(!isset($_GET['year'])){
				echo '';
				$yearqry ='2017';
			}
			else{
				$yearqry = $_GET['year'];
			}

			?>
			
			
			<select name="year" onchange="window.location.href = 'adminStat.php?year=' + this.value;">
				<option value=''>Select Year</option>
				<?php 
				
				$sql = "SELECT distinct year(payment_date)from payment  ";
				$exec = mysqli_query($con, $sql) or die ("Error Query [".$sql."]");
				$result = mysqli_fetch_row($exec);
					 
				$no = $result[0];
					 
			    echo "<option  value='$no'>$no</option>";
			  
				
				?>

			</select>
			</form>
			</center>		
		 
		<p> FH = Fans And Heatsinks </p>
		<p> GC = Graphic Card </p>
		<p> KB = Keyboard </p>
		<p> MN = Monitor </p>
		<p> MB = Motherboard </p>
		<p> M = Mouse </p>
		<p> NC = Network Component </p>
		<p> PS = Power Supply </p>
		<p> PT = Printer </p>
		<p> PR = Processor </p>
		<p> RAM = Random Access Memory </p>
		<p> SC = Scanner </p>
		<p> SW = Software </p>
		<p> SR = Storage </p>		
		 </div>
		  <?php
		  $sql1 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Fans And Heatsinks' and year(payment.payment_date) = '$yearqry' ";
          $exec1 = mysqli_query($con, $sql1) or die ("Error Query [".$sql1."]");
          $result1 = mysqli_fetch_row($exec1);
		  
		  $sql2 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Graphic Card' and year(payment.payment_date) = '$yearqry'";
          $exec2 = mysqli_query($con, $sql2) or die ("Error Query [".$sql2."]");
          $result2 = mysqli_fetch_row($exec2);
		  
		  $sql3 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Keyboard' and year(payment.payment_date) = '$yearqry'";
          $exec3 = mysqli_query($con, $sql3) or die ("Error Query [".$sql3."]");
          $result3 = mysqli_fetch_row($exec3);
		  
		  $sql4 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Monitor' and year(payment.payment_date) = '$yearqry'";
          $exec4 = mysqli_query($con, $sql4) or die ("Error Query [".$sql4."]");
          $result4 = mysqli_fetch_row($exec4);
		  
		  $sql5 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Motherboard' and year(payment.payment_date) = '$yearqry'";
          $exec5 = mysqli_query($con, $sql5) or die ("Error Query [".$sql5."]");
          $result5 = mysqli_fetch_row($exec5);
		  
		  $sql6 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Mouse' and year(payment.payment_date) = '$yearqry'";
          $exec6 = mysqli_query($con, $sql6) or die ("Error Query [".$sql6."]");
          $result6 = mysqli_fetch_row($exec6);
		  
		  $sql7 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Network Component' and year(payment.payment_date) = '$yearqry'";
          $exec7 = mysqli_query($con, $sql7) or die ("Error Query [".$sql7."]");
          $result7 = mysqli_fetch_row($exec7);
		  
		  $sql8 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Power Supply' and year(payment.payment_date) = '$yearqry'";
          $exec8 = mysqli_query($con, $sql8) or die ("Error Query [".$sql8."]");
          $result8 = mysqli_fetch_row($exec8);
		  
		  $sql9 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Printer' and year(payment.payment_date) = '$yearqry'";
          $exec9 = mysqli_query($con, $sql9) or die ("Error Query [".$sql9."]");
          $result9 = mysqli_fetch_row($exec9);
		  
		  $sql10 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Processor' and year(payment.payment_date) = '$yearqry'";
          $exec10 = mysqli_query($con, $sql10) or die ("Error Query [".$sql10."]");
          $result10 = mysqli_fetch_row($exec10);
		  
		  $sql11 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'RAM' and year(payment.payment_date) = '$yearqry'";
          $exec11= mysqli_query($con, $sql11) or die ("Error Query [".$sql11."]");
          $result11 = mysqli_fetch_row($exec11);
		  
		  $sql12 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Scanner' and year(payment.payment_date) = '$yearqry'";
          $exec12 = mysqli_query($con, $sql12) or die ("Error Query [".$sql12."]");
          $result12 = mysqli_fetch_row($exec12);
		  
		  $sql13 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Software' and year(payment.payment_date) = '$yearqry'";
          $exec13 = mysqli_query($con, $sql13) or die ("Error Query [".$sql13."]");
          $result13 = mysqli_fetch_row($exec13);
		  
		  $sql14 = "SELECT sum(cart.quantity) from cart join product join payment on cart.product_id = product.product_id and cart.payment_id = payment.payment_id where product.product_type = 'Storage' and year(payment.payment_date) = '$yearqry'";
          $exec14 = mysqli_query($con, $sql14) or die ("Error Query [".$sql14."]");
          $result14 = mysqli_fetch_row($exec14);
		 
		 ?>
		 
		 <script>
				var ctx = document.getElementById("myChart");
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["FH","GC","KB","MN","MB","M","NC","PS","PT","PR","RAM","SC","SW","SR"],
						datasets: [{
							label: '<?php echo $yearqry; ?>  Quantity  ',
							data: [<?php echo $result1[0]; ?>,<?php echo $result2[0]; ?>
								,<?php echo $result3[0]; ?>,<?php echo $result4[0]; ?>
								,<?php echo $result5[0]; ?>,<?php echo $result6[0]; ?>
								,<?php echo $result7[0]; ?>,<?php echo $result8[0]; ?>
								,<?php echo $result9[0]; ?>,<?php echo $result10[0]; ?>
								,<?php echo $result11[0]; ?>,<?php echo $result12[0]; ?>
								,<?php echo $result13[0]; ?>,<?php echo $result14[0]; ?>
								
								],
							backgroundColor: [
							   "#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c",
							   
							],
							borderWidth: 2
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true
									
								}
							}]
						}
					}
				});
			</script>
				
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