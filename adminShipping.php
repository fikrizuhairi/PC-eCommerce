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
			
			$sqlShip="SELECT distinct(B.payment_id) as order_id, B.no_ic, C.cust_name, A.payment_total, A.payment_date, A.tracking_num, A.shipment_status FROM payment A, cart B, customer C WHERE A.payment_id = B.payment_id and B.no_ic = C.no_ic";
			$queryShip=mysqli_query($con,$sqlShip);	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy PCTech</title>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"></script>
    
    <link rel="icon" href="images/New.png" type="image/png" >
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
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
					<li><a class="" href="updateProduct.php">
						<span class="fa fa-refresh">&nbsp;</span> Update Product
					</a></li>
				</ul>	
			</li>
			<li class="active"><a href="adminShipping.php"><em class="fa fa-truck">&nbsp;</em> Shipping</a></li>
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
				<li class="active">Shipping</li>
			</ol>
		</div>
	
	<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">  Shipping List</h1>
			</div>
	</div>
	
	<!--Page Content-->
      
      <!--Orders History-->
      <section class="order-history extra-space-bottom">
          <center><h2 class="text-center-mobile">CUSTOMER ORDER HISTORY</h2>
          
          <div class="col-md-12">
            <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th >Order ID</th>
                  <th >Customer</th>
                  <th >No. of Items</th>
                  <th >Date</th>
                  <th >Tracking Number</th>
				  <th >Shipping Status</th>
				  <th >Update Order</th>
                </tr>
              </thead>
              <tbody>
               <?php  
					while($resultShip=mysqli_fetch_array($queryShip))
					{
						$sqlCountShip = "SELECT count(cart_id) as count FROM cart WHERE payment_id='".$resultShip['order_id']."'";
						$queryCountShip = mysqli_query($con,$sqlCountShip);
						$resultCountShip = mysqli_fetch_assoc($queryCountShip);
				?>
                <tr>
                  <td>#<?php echo $resultShip['order_id']?></td>
                  <td align="center"><?php echo $resultShip['no_ic'] ?> - <?php echo $resultShip['cust_name'] ?></td>
                  <td align="center"><?php echo $resultCountShip['count'] ?></td>
                  <td align="center"><?php echo date('d M Y',strtotime($resultShip['payment_date'])) ?><br/><?php echo date('h:i A',strtotime($resultShip['payment_date'])) ?></td>
				  <td align="center"><?php echo $resultShip['tracking_num']?></td>
				  <?php if($resultShip['shipment_status'] == "DONE")
				  { ?>
                  <td class="status primary"  align="center"><span>Done</span></td>
                  <td><center><a href="updateShipping.php?id=<?php echo $resultShip['order_id']?>"><button type="button" id="update" name="update" class="btn btn-primary loginFormElement">Detail</button></a></center></td>
				  <?php } else if($resultShip['shipment_status'] == "PENDING") { ?>
                  <td class="status warning" align="center"><span>Processing</span></td>
                  <td><center><a href="updateShipping.php?id=<?php echo $resultShip['order_id']?>"><button type="button" id="update" name="update" class="btn btn-success loginFormElement">Update</button></a></center></td>
                  <?php } else { ?>
                  <td class="status danger" align="center"><span>Canceled</span></td>
                  <td><center><a href="updateShipping.php?id=<?php echo $resultShip['order_id']?>"><button type="button" id="update" name="update" class="btn btn-success loginFormElement">Update</button></a></center></td>
                  <?php } ?>
                  
				  
                </tr>
              <?php  } ?>
              </tbody>
            </table></div>
      </section><!--Orders History Close-->
    
    
    </div>
	
	<!--<script src="js/jquery-1.11.1.min.js"></script>-->
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
    <script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
		$('#myTable').DataTable();
	} );
	</script>
		<?php mysqli_close($con); ?>
</body>
</html>