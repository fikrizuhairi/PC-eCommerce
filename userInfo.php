<!DOCTYPE html>
<html lang="en">
<head>
<title>Easy PCTech</title>
<link rel="icon" href="images/New.png" type="image/png" >

<!-- Custom Theme files -->
<link href="css/bootstrap2.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" /> 
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery.min.js"></script> 

<!-- //js -->  
<!-- web fonts --> 
<link href='//fonts.googleapis.com/css?family=Glegoo:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //web fonts --> 
<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<!-- //for bootstrap working -->
<!-- start-smooth-scrolling -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>

<script language="javascript">
function confirmdelete()
{
	var pasti=confirm("Are you sure want to delete?");
	if(pasti)
	return true;
	else
	return false;
}
</script>

<script language="javascript" type="text/javascript">
function validate()
{
var formName=document.passwordForm;

if (formName.txtNewPassword.value != formName.txtConfirmPassword.value)
{
formName.txtConfirmPassword.focus()
alert("Passwords do no match!");
return false;
}

if(formName.txtNewPassword.value.length < 8)
{
formName.txtNewPassword.focus()
return false;	
}
 
 return true;
}
</script>
<!-- //end-smooth-scrolling --> 
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
						<li><a href="custShipping.php">Shipping</a></li>
                        <li style="background-color:#4B77BE;"><a href="userInfo.php">User Info</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</nav>
	</div>
	<!-- //navigation -->
	
	<!-- mail -->
    <div class="col-md-12">
    <br>
    <div class="col-md-6" >
    <div class="col-md-12" style="background-color: #ffffff; border:double #bdc3c7; box-shadow: 5px 5px 5px 2px gray;"><br>
    <center><h3>Personal Info</h3></center>
    <?php
		$sql="select cust_name,cust_nophone,cust_email from customer where no_ic='".$_SESSION['ic']."'";
		$query=mysqli_query($con,$sql);
		$result=mysqli_fetch_assoc($query);
	?>
                    <form action="changeInfoCustomer.php" method="post" >
                    <br>
					Fullname
					
						<input type="text" name="txtName" value="<?php echo $result['cust_name'];?>"  class="form-control"  required>
					<br>
					No IC
					
						<input type="text" name="txtIC" value="<?php echo $_SESSION['ic'];?>"  class="form-control"  readonly required>
					<br>
					Phone Number
					
						<input type="text" name="txtPhone" value="<?php echo $result['cust_nophone'];?>"  class="form-control"  required>
					<br>
					Email
					
						<input type="email" name="txtEmail" value="<?php echo $result['cust_email'];?>"  class="form-control"  required>
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
	  				</form>
    </div></div>
    
    <div class="col-md-6" >
        <div class="col-md-12" style="background-color: #ffffff; border:double #bdc3c7; box-shadow: 5px 5px 5px 2px gray;"><br>
            <center><h3>Shipping Info</h3></center><br>
            <a href="" data-toggle="modal" data-target="#myAddress"> + Add Address</a>
            <br>
			<div class="modal fade" id="myAddress" role="dialog">
                        <div class="modal-dialog" style="width:50%;">
                        
                          <!-- Modal content-->
                          <div class="modal-content" >
                            <div class="modal-header">
                                <form name="addressForm" action="addAddress.php" method="post">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  
                                </div>
                                <div class="modal-body">
    
                                    Address
                                    <input type="text" name="txtAddress1" value=""  class="form-control"  required>
                                    <input type="text" name="txtAddress2" value=""  class="form-control"  >
                                    <input type="text" name="txtAddress3" value=""  class="form-control"  >
                                    <br>
                                    City
                                    <input type="text" name="txtCity" value=""  class="form-control"  required>
                                    <br>
                                    Poscode
                                    <input type="text" name="txtPoscode" value=""  class="form-control"  required>
                                    <br>
                                    State
                                    <select name="txtState"  class="form-control"  required="required">
												<option value="">- State -</option>
												<option value="Pahang">PAHANG</option>
												<option value="Perak">PERAK</option>
												<option value="Terengganu">TERENGGANU</option>
												<option value="Perlis">PERLIS</option>
												<option value="Selangor">SELANGOR</option>
												<option value="Negeri Sembilan">NEGERI SEMBILAN</option>
												<option value="Johor">JOHOR</option>
												<option value="Kelantan">KELANTAN</option>
												<option value="Kedah">KEDAH</option>
												<option value="Pulau Pinang">PULAU PINANG</option>
												<option value="Melaka">MELAKA</option>
												<option value="Sabah">SABAH</option>
												<option value="Sarawak">SARAWAK</option>
											</select>
                                    
                                    <br>
                                    <center><button type="submit" class="btn btn-success loginFormElement"><i class="fa fa-floppy-o"></i> Save</button></center>
    </form>
                            </div>
                            <div class="modal-footer">
                              <!--<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>-->
                            </div>
                         </div>
                          </div>
                        </div>            
                     
             <div class="col-md-12">
             <?php
			 $sqladdress="select * from address where no_ic = '".$_SESSION['ic']."'";
			 $query=mysqli_query($con,$sqladdress);
			 while($resultAddress=mysqli_fetch_array($query))
			 {
			 ?>
            <div class="col-md-6"  >
            <div class="col-md-12" style="background-color: #ffffff; border:0.5px solid #bdc3c7;">
            
            <br>
            <p><?php echo $resultAddress['address1']; ?></p>
            <p><?php echo $resultAddress['address2']; ?></p>
            <p><?php echo $resultAddress['address3']; ?></p>
            <p><?php echo $resultAddress['city']; ?>, <?php echo $resultAddress['poscode']; ?>, <?php echo $resultAddress['state']; ?></p>
            
            <a href="delAddress.php?address_id=<?php echo $resultAddress['address_id']; ?>"><button type="submit" class="btn btn-default loginFormElement" onClick="return confirmdelete()"><i class="fa fa-trash-o"></i> </button></a><br>
            <br>
            </div></div>
			<?php } ?>
            </div><p>&nbsp;</p>
        </div>
        
    </div>
    
    </div>
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

<?php mysqli_close($con); ?>
</body>
</html>