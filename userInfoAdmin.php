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
            <li><a href="adminStat.php"><em class="fa fa-area-chart">&nbsp;</em> Statistic Sold Item</a></li>
			<li><a href="custInfo.php"><em class="fa fa-users">&nbsp;</em> Customer Info</a></li>
            <li class="active"><a href="userInfoAdmin.php"><em class="fa fa-user">&nbsp;</em> User Info</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="adminMenu.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">User Info</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">User Info</h1>               
			</div>
		</div><!--/.row-->
		<div class="row">
              <form role="form" action="changeInfoAdmin.php" method="POST">
                <div class="col-md-6">

    <?php
		$sql="select supplier_name,supplier_nophone,supplier_email from supplier where no_ic='".$_SESSION['ic']."'";
		$query=mysqli_query($con,$sql);
		$result=mysqli_fetch_assoc($query);
	?>
                     <br>
					Fullname
					
						<input type="text" name="txtName" value="<?php echo $result['supplier_name'];?>"  class="form-control"  required>
					<br>
					No IC
					
						<input type="text" name="txtIC" value="<?php echo $_SESSION['ic'];?>"  class="form-control"  readonly required>
					<br>
					Phone Number
					
						<input type="text" name="txtPhone" value="<?php echo $result['supplier_nophone'];?>"  class="form-control"  required>
					<br>
					Email
					
						<input type="email" name="txtEmail" value="<?php echo $result['supplier_email'];?>"  class="form-control"  required>
                    <br>
                   
                    <button type="submit" class="btn btn-success loginFormElement"><i class="fa fa-floppy-o"></i> Save Changes</button><a href="" data-toggle="modal" data-target="#myModal"> I want to change my password</a><br><br>
                    </form>
                    
                    <form name="passwordForm" action="changePassword.php" method="post" onSubmit="return validate()">
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog" style="width:50%;">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              
                            </div>
                            <div class="modal-body">
                            <input type="hidden" name="txtIC" value="<?php echo $_SESSION['ic'];?>"  class="form-control"  readonly required>
                            Current Password
							<input type="password" name="txtPassword" value=""  class="form-control"  required>
							<br>
                            New Password
							<input name="txtNewPassword" class="form-control"placeholder="		      			 *Atleast 8 characters long.*"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters!" required>
							<br>
                            Confirm Password
							<input name="txtConfirmPassword" class="form-control"placeholder="	      				 *Atleast 8 characters long.*"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters!" required>
							<br>
                            <center><button type="submit" class="btn btn-success loginFormElement"><i class="fa fa-floppy-o"></i> Save</button></center>
                            </div>
                            <div class="modal-footer">
                              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                            </div>
                          </div>
                          
                        </div>
                      </div>              
               </div></form>
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