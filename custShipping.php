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
			
			$sqlShip="SELECT distinct(B.payment_id) as order_id, A.payment_total, A.payment_date, A.tracking_num, A.shipment_status FROM payment A, cart B WHERE A.payment_id = B.payment_id and A.no_ic='".$_SESSION['ic']."'";
			$queryShip=mysqli_query($con,$sqlShip);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Easy PCTech</title>
<link rel="icon" href="images/New.png" type="image/png" >
<link href="css/bootstrap2.css" rel="stylesheet" type="text/css" />



<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
    <link href="css/style2.css" rel="stylesheet" type="text/css"  />
    <script src="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"></script>
    
<!-- Custom Theme files -->


<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<!--<script src="js/jquery.min.js"></script> -->

<!-- //js -->  
<!-- web fonts --> 
<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //web fonts  
 for bootstrap working 
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
 //for bootstrap working 
 start-smooth-scrolling -->
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
	<!-- navigation -->
     
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
                        <li><a href="shopMonitor.php">Shopping</a></li>
					    <li><a href="buildPC.php">Build Your PC</a></li>
                        <li><a href="shoppingCart.php">Cart</a></li>
						<li style="background-color:#4B77BE;"><a href="custShipping.php">Shipping</a></li>
                        <li><a href="userInfo.php">User Info</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</nav>
	</div>
	<!-- //navigation -->
	
<!--Page Content-->
    <div class="page-content">
    
   
      
      <!--Orders History-->
      <section class="order-history extra-space-bottom">
      	<div class="container">
		<br>
          <center><h2 class="text-center-mobile">MY ORDER HISTORY</h2>
          <div class="col-md-1"></div>
          <div class="col-md-10">
          <br/>
          <div class="inner">
          <table id="myTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
              <tr>
                  <th>Order ID </th>
                  <th>No. of Items </th>
                  <th>Total Price </th>
                  <th>Date </th>
                  <th>Tracking Number </th>
				  <th>Shipping Status </th>
                  <th>Invoice?</th>
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
                  <td align="center"><?php echo $resultCountShip['count'] ?></td>
                  <td align="center">RM <?php echo $resultShip['payment_total']?></td>
                  <td align="center"><?php echo date('d M Y',strtotime($resultShip['payment_date'])) ?><br/><?php echo date('h:i A',strtotime($resultShip['payment_date'])) ?></td>
				  <td align="center"><?php echo $resultShip['tracking_num']?></td>
                  <?php if($resultShip['shipment_status'] == "DONE")
				  { ?>
                  <td align="center" class="status primary"><span>Done</span></td>
				  <?php } else if($resultShip['shipment_status'] == "PENDING") { ?>
                  <td align="center" class="status warning"><span>Processing</span></td>
                  <?php } else { ?>
                  <td align="center" class="status danger"><span>Canceled</span></td>
                  <?php } ?>
                  <td align="center"><a href="pdf2.php?payment_id=<?php echo $resultShip['order_id']?>"><button type="submit" name="submit" title="Invoice" class="btn btn-default tool-tip">
									<i class="fa fa-file-text-o"></i>
								</button></a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="col-md-1">
          </div>
        </div>
      </section><!--Orders History Close-->
    
    </div>
    
    </div>

    
    <!--<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>-->
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#myTable').DataTable();				
			} );
		</script>
<?php mysqli_close($con); ?>

</body>
</html>
