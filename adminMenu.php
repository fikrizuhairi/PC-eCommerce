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
			<li class="active"><a href="adminMenu.php"><em class="fa fa-home">&nbsp;</em> Menu</a></li>
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
            <li><a href="adminStat.php"><em class="fa fa-area-chart">&nbsp;</em> Statistic Sold Item</a></li>
			<li><a href="custInfo.php"><em class="fa fa-users">&nbsp;</em> Customer Info</a></li>
            <li><a href="userInfoAdmin.php"><em class="fa fa-user">&nbsp;</em> User Info</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			
		</div><!--/.row-->
		<?php 
			$sqlNeed="SELECT count(payment_id) as count FROM payment WHERE shipment_status != 'DONE'";
			$queryNeed=mysqli_query($con,$sqlNeed);
			$resultNeed=mysqli_fetch_assoc($queryNeed);
			
			$sqlNeed1="SELECT count(product_id) as count FROM product WHERE product_quantity < 3";
			$queryNeed1=mysqli_query($con,$sqlNeed1);
			$resultNeed1=mysqli_fetch_assoc($queryNeed1);
			
			$sqlNeed2="SELECT count(no_ic) as count FROM customer";
			$queryNeed2=mysqli_query($con,$sqlNeed2);
			$resultNeed2=mysqli_fetch_assoc($queryNeed2);
			
			$sqlNeed3="SELECT sum(quantity) as count FROM cart";
			$queryNeed3=mysqli_query($con,$sqlNeed3);
			$resultNeed3=mysqli_fetch_assoc($queryNeed3);
			
			
		 ?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Welcome, <?php echo $resultData['supplier_name'];?>!</h1>
			</div>
		</div><!--/.row-->
        <a href="#">
        <div class="col-md-3">
            <div class="panel panel-container">
                 <center>
                    <h2>
                      <strong><?php echo $resultNeed['count'] ?></strong>
                    </h2>
                    <h4>
                      Need Delivery
                    </h4>
				</center>
                <br>
            </div>
        </div>
        </a>
        <a href="#">
        <div class="col-md-3">
            <div class="panel panel-container">
                 <center>
                    <h2>
                      <strong><?php echo $resultNeed1['count'] ?></strong>
                    </h2>
                    <h4>
                      Need Stock
                    </h4>
				</center>
                <br>
            </div>
        </div>
        </a>
        <a href="#">
        <div class="col-md-3">
            <div class="panel panel-container">
                 <center>
                    <h2>
                      <strong><?php echo $resultNeed3['count'] ?></strong>
                    </h2>
                    <h4>
                      Item Sold
                    </h4>
				</center>
                <br>
            </div>
        </div>
        </a>
        <a href="#"><div class="col-md-3">
            <div class="panel panel-container">
                <center>
                    <h2>
                      <strong><?php echo $resultNeed2['count'] ?></strong>
                    </h2>
                    <h4>
                      Registered Customer
                    </h4>
				</center>
                <br>
            </div> 
        </div></a>
		
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
		 </div>
		 
		 
		 <?php
		  $sql1 = "SELECT sum(payment_total) from payment where month(payment_date) = '01' && year(payment_date)= '$yearqry ' ";
          $exec1 = mysqli_query($con, $sql1) or die ("Error Query [".$sql1."]");
          $result1 = mysqli_fetch_row($exec1);
		  
		  $sql2 = "SELECT sum(payment_total) from payment where month(payment_date) = '02' && year(payment_date)= '$yearqry ' ";
          $exec2 = mysqli_query($con, $sql2) or die ("Error Query [".$sql2."]");
          $result2 = mysqli_fetch_row($exec2);
		  
		  $sql3 = "SELECT sum(payment_total) from payment where month(payment_date) = '03' && year(payment_date)= '$yearqry ' ";
          $exec3 = mysqli_query($con, $sql3) or die ("Error Query [".$sql3."]");
          $result3 = mysqli_fetch_row($exec3);
		  
		  $sql4 = "SELECT sum(payment_total) from payment where month(payment_date) = '04' && year(payment_date)= '$yearqry ' ";
          $exec4 = mysqli_query($con, $sql4) or die ("Error Query [".$sql4."]");
          $result4 = mysqli_fetch_row($exec4);
		  
		  $sql5 = "SELECT sum(payment_total) from payment where month(payment_date) = '05' && year(payment_date)= '$yearqry ' ";
          $exec5 = mysqli_query($con, $sql5) or die ("Error Query [".$sql5."]");
          $result5 = mysqli_fetch_row($exec5);
		  
		  $sql6 = "SELECT sum(payment_total) from payment where month(payment_date) = '06' && year(payment_date)= '$yearqry ' ";
          $exec6 = mysqli_query($con, $sql6) or die ("Error Query [".$sql6."]");
          $result6 = mysqli_fetch_row($exec6);
		  
		  $sql7 = "SELECT sum(payment_total) from payment where month(payment_date) = '07' && year(payment_date)= '$yearqry ' ";
          $exec7 = mysqli_query($con, $sql7) or die ("Error Query [".$sql7."]");
          $result7 = mysqli_fetch_row($exec7);
		  
		  $sql8 = "SELECT sum(payment_total) from payment where month(payment_date) = '08' && year(payment_date)= '$yearqry ' ";
          $exec8 = mysqli_query($con, $sql8) or die ("Error Query [".$sql8."]");
          $result8 = mysqli_fetch_row($exec8);
		  
		  $sql9 = "SELECT sum(payment_total) from payment where month(payment_date) = '09' && year(payment_date)= '$yearqry ' ";
          $exec9 = mysqli_query($con, $sql9) or die ("Error Query [".$sql9."]");
          $result9 = mysqli_fetch_row($exec9);
		  
		  $sql10 = "SELECT sum(payment_total) from payment where month(payment_date) = '10' && year(payment_date)= '$yearqry ' ";
          $exec10 = mysqli_query($con, $sql10) or die ("Error Query [".$sql10."]");
          $result10 = mysqli_fetch_row($exec10);
		  
		  $sql11 = "SELECT sum(payment_total) from payment where month(payment_date) = '11' && year(payment_date)= '$yearqry ' ";
          $exec11= mysqli_query($con, $sql11) or die ("Error Query [".$sql11."]");
          $result11 = mysqli_fetch_row($exec11);
		  
		  $sql12 = "SELECT sum(payment_total) from payment where month(payment_date) = '12' && year(payment_date)= '$yearqry ' ";
          $exec12 = mysqli_query($con, $sql12) or die ("Error Query [".$sql12."]");
          $result12 = mysqli_fetch_row($exec12);
		  
		  
		 
		 ?>
		 		

			<script>
				var ctx = document.getElementById("myChart");
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: ["January", "Febuary", "March", "April", "May", "June", "July","August","September","October","November","Disember"],
						datasets: [{
							label: '<?php echo $yearqry; ?>  Profit Monthly (RM) ',
							data: [<?php echo $result1[0]; ?>,<?php echo $result2[0]; ?>
								,<?php echo $result3[0]; ?>,<?php echo $result4[0]; ?>
								,<?php echo $result5[0]; ?>,<?php echo $result6[0]; ?>
								,<?php echo $result7[0]; ?>,<?php echo $result8[0]; ?>
								,<?php echo $result9[0]; ?>,<?php echo $result10[0]; ?>
								,<?php echo $result11[0];?>,<?php echo $result12[0]; ?>
								],
							backgroundColor: [
							   "#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c","#e74c3c",
							   
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

          
			
			<br><br><br>
			<div class="col-sm-12">
				<p class="back-link">Easy PCTech </p>
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