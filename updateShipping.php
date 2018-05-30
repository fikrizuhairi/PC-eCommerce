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
			
			$sqlShip="SELECT D.product_name, B.quantity FROM payment A, cart B, product D WHERE A.payment_id = B.payment_id and B.product_id = D.product_id and B.payment_id='".$_GET['id']."'";
			$queryShip=mysqli_query($con,$sqlShip);
						
			$sqlAddShip="SELECT C.cust_name, C.cust_nophone, C.cust_email, B.payment_address1, B.payment_address2, B.payment_address3, B.payment_city, B.payment_state, B.payment_poscode, A.payment_total, A.shipment_status FROM payment A, cart B, customer C WHERE A.payment_id = B.payment_id and B.no_ic = C.no_ic and B.payment_id='".$_GET['id']."'";
			$queryAddShip=mysqli_query($con,$sqlAddShip);
			$resultShip=mysqli_fetch_assoc($queryAddShip);
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
				<li class="active">Update Order</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Update Order</h1>               
			</div>
		</div><!--/.row-->
        <?php 
			$sqlCheck="SELECT tracking_num,shipment_status FROM payment WHERE payment_id='".$_GET['id']."'";
			$queryCheck=mysqli_query($con,$sqlCheck);
			$resultCheck=mysqli_fetch_assoc($queryCheck);
		?>
        
		<?php
			if(isset($_POST['submit']))
			{
				if($resultCheck['tracking_num'] == null)
				{
					$sql="UPDATE payment SET tracking_num='".$_POST['trackingNumber']."', shipment_status='".$_POST['orderStatus']."' WHERE payment_id='".$_GET['id']."'";	
					$query=mysqli_query($con,$sql);
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=shippingEmail.php?id=".$_GET['id']."\">";
				}
				else
				{
					$sql="UPDATE payment SET tracking_num='".$_POST['trackingNumber1']."', shipment_status='".$_POST['orderStatus']."' WHERE payment_id='".$_GET['id']."'";	
					$query=mysqli_query($con,$sql);
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=adminShipping.php\">";
				}
				
			}
		?>
		<div class="row">
                <div class="col-md-6">
                <div class="panel panel-info">
                        <div class="panel-heading">
                            Review Order <div class="pull-right"></div>
                        </div>
						
                        <div class="panel-body">
                          <div class="col-xs-12">
                          <div class="form-group">
                                <div class="col-xs-10">
                                    <strong>Product Name</strong>
                                </div>
                                <div class="col-xs-2">
                                    <div class="pull-right"><strong>Qty</strong></div>
                                </div>
                                
                            </div>
                          <div class="form-group">
                          <?php while($resultProduct=mysqli_fetch_array($queryShip))
							{ ?>
                                <div class="col-xs-10">
                                    <small><span><?php echo $resultProduct['product_name']; ?></span></small>
                                </div>
                                <div class="col-xs-2">
                                    <div class="pull-right"><span><?php echo $resultProduct['quantity']; ?> </span></div>
                                </div>
                               
                           <?php } ?>
                            </div>
                            <div class="form-group" ><hr/></div>
                            <div class="form-group">
                                <div class="col-xs-12"><br/>
                                    <strong>Order Total (Include 6% GST)</strong>
                                    <div class="pull-right"><span>RM </span><span><?php echo $resultShip['payment_total']; ?></span></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                <div class="panel panel-info">
                        <div class="panel-heading">Shipping Details</div>
                        <div class="panel-body"><div class="col-xs-12">                    
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <strong>Full Name:</strong>
                                    <p><?php echo $resultShip['cust_name'] ?></p>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Phone Number:</strong></div>
                                <div class="col-md-12"><p><?php echo $resultShip['cust_nophone'] ?></p></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Email Address:</strong></div>
                                <div class="col-md-12"><p><?php echo $resultShip['cust_email'] ?></p></div>
                            </div>
                            <div class="form-group"><hr /></div>
                            <div class="form-group">
                                <div class="col-md-12">
                                        <strong>Item will be ship here : </strong><br/><br/>
                                        <p><?php echo $resultShip['payment_address1'] ?></p>
										<p><?php echo $resultShip['payment_address2'] ?></p>
                                        <p><?php echo $resultShip['payment_address3'] ?></p>
                                        <p><?php echo $resultShip['payment_city'] ?>, <?php echo $resultShip['payment_poscode'] ?>, <?php echo $resultShip['payment_city'] ?></p>
     
                                </div>
                            </div>
                        </div><br/></div>
         </div>
         
         </div>
               
		<div class="col-md-6">
                     
             <form role="form" action="" method="POST">
            <div class="panel panel-info">
                        <div class="panel-heading">
                            Status <div class="pull-right"></div>
                        </div>
                        <div class="panel-body">
                          <div class="col-xs-12">
                         <div class="col-sm-12">
                        		
                                <div class="form-group">
                               <strong>Tracking Number:</strong>
                               <?php 
							   	if($resultCheck['tracking_num'] == null)
								{
							   ?>
                               <input class="form-control" id="trackingnumber" name="trackingNumber" type="text" required>
                               <?php } else { ?>
                               <input class="form-control" id="trackingnumber1" name="trackingNumber1" type="text" value="<?php echo $resultCheck['tracking_num'] ?>" readonly>
                               <?php } ?>
                               </div>
                            </div>
                            
                            <div class="col-sm-12"> 
                                <div class="form-group"> 
                                    <strong>Shipping Status:</strong>
                                    <?php 
									if($resultCheck['shipment_status'] == 'DONE')
									{
								   ?>
                                   <label>Done</label>
                                   <?php } else { ?>
                                    <select class="form-control" id="orderstatus" name="orderStatus" >
                                        <option value="PENDING">Pending</option>
                                        <option value="DONE">Done</option>
                                    </select>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
            						<?php 
									if($resultCheck['shipment_status'] == 'DONE')
									{
								   ?>
                                   <center><a href="adminShipping.php"><button type="button" id="cancel" name="cancel" class="btn btn-primary loginFormElement">Back</button></a></center>
                                   <?php } else { ?>
				<center><button type="submit" id="updateOrder" name="submit" class="btn btn-success loginFormElement">Update</button></form>
				<a href="adminShipping.php"><button type="button" id="cancel" name="cancel" class="btn btn-danger loginFormElement">Cancel</button></a></center><?php } ?><br/>
			</div>
                            </div>
                        </div>
                    </div>
        </div>
             	
            <br>			
			
			
            
           <!-- <p class="back-link">Easy PCTech </p>-->
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