 <?php
		include_once('connectdb.php');
			
			$sqlBudget="SELECT product_id,product_type,image_name,product_price,product_name from product where product_price <='".$_GET['budget']."' and product_availability = '1' and product_quantity != '0' and personal_uses='1' order by product_type asc, product_price asc";
			$queryBudget=mysqli_query($con,$sqlBudget);
			
?>
 <!DOCTYPE html>
<html lang="en">
<head>
<title>Easy PCTech</title>
<link rel="icon" href="images/New.png" type="image/png" >

<!-- Custom Theme files -->
<link href="css/bootstrap.min.css" rel="stylesheet">
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

<script language="javascript">
function Site(val)
{
	window.location.href = val;
}
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
						<li><a href="homePageGuest.php">Home</a></li>	
                        <li><a href="guestShopMonitor.php">Shopping</a></li>
					    <li style="background-color:#4B77BE;"><a href="guestBuildPC.php">Build Your PC</a></li>
                        <li><a href="shoppingCart.php">Cart</a></li>
						<li><a href="custShipping.php">Shipping</a></li>
                        <li><a href="userInfo.php">User Info</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</div>
			</nav>
	</div>
	
	<div class="row cart-head">
                <div class="container">
				
				<br>
				 <center><h1 class="text-center-mobile">WHAT TO BUY ?</h1>
                 <br/>
                 <select class="form-control" style="width:40%" onChange="Site(this.value)">
                 	<option value="">*--- Choose Spec ---*</option>
                    <option value="guestBuildPC1_all.php?budget=<?php echo $_GET['budget'] ?>">All</option>
                    <option value="guestBuildPC1_pcGaming.php?budget=<?php echo $_GET['budget'] ?>">PC Gaming</option>
                    <option value="guestBuildPC1_office.php?budget=<?php echo $_GET['budget'] ?>">Office</option>
                    <option value="guestBuildPC1_personalUses.php?budget=<?php echo $_GET['budget'] ?>">Personal Uses</option>
                 </select>
                
                <div class="row">
                    <p></p>
    </div>
				
	<!-- //navigation -->

	<!-- Build PC Table Starts -->
	<?php
	if(isset($_POST['submit']))
	{
		$sqlProduct="SELECT product_id, no_ic FROM cart where product_id='".$_GET['id']."' and no_ic='".$_SESSION['ic']."' and payment_id is null";
		$queryProduct=mysqli_query($con,$sqlProduct) or die (mysqli_error($con));
		$resutProduct=mysqli_fetch_row($queryProduct);
		if($resutProduct == 0)
		{
			
			$sql="INSERT INTO cart(cart_id,no_ic,product_id,quantity,subtotal) VALUES ('','".$_SESSION['ic']."','".$_GET['id']."','1','".$_GET['amount']."')";
			$query=mysqli_query($con,$sql) or die(mysqli_error($con));
			
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
			
		}
		else
		{
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
		}
	}
	?>
	<br><br>
	
			<div class="table-responsive shopping-cart-table">
            
				<table class="table table-bordered" >
					<thead>
						<tr>
							<td  width="13%" class="text-center">
								Type
							</td>
							<td width="15%" class="text-center">
								Image
							</td>							
							<td width="30%" class="text-center">
								Name
							</td>
							<td width="17%" class="text-center">
								Price
							</td>
							<td width="16%" class="text-center">
								Add to Cart ?
							</td>
						</tr>
					</thead>
					
					<tbody>
                    <?php
						while($resultBudget=mysqli_fetch_array($queryBudget))
						{
					?>
                    <form action="buildPC1_personalUses.php?id=<?php echo $resultBudget['product_id'] ?>&amount=<?php echo $resultBudget['product_price'];?>&budget=<?php echo $_GET['budget'] ?>" method="post">
						<tr>
							<td class="text-center">
								<?php echo $resultBudget['product_type']; ?>
							</td>
							<td class="text-center">
								<a href="shopping1.php?id=<?php echo $resultBudget['product_id']; ?>">
									<img src="imgProduct/<?php echo $resultBudget['image_name']; ?>" alt="Product Name" title="<?php echo $resultBudget['product_name']; ?>" class="img-thumbnail" />
								</a>
                            </td>							
							<td class="text-center">
								<?php echo $resultBudget['product_name']; ?>
                                <input type="hidden" name="amount" value="<?php echo $resultBudget['product_price'];?>"/> 
                                <input type="hidden" name="id" value="<?php echo $resultBudget['product_id'];?>"/>
							</td>
							<td class="text-center">
								RM<?php echo $resultBudget['product_price']; ?>.00
							</td>
							<td class="text-center">
								<button type="submit" name="submit" title="Add" class="btn btn-default tool-tip">
									<i class="fa fa-check-circle"></i>
								</button>
							</td>
						</tr></form>	
                        <?php } ?>
					</tbody>
					<!--<tfoot>
						<tr>
						  <td colspan="4" class="text-right">
							<strong>Total Amount :</strong>
						  </td>
						  <td colspan="2" class="text-left">
							$300
						  </td>
						</tr>
					</tfoot>-->
				</table>		
			</div>
			
		<!-- Build PC Table Ends -->
		
		<!--<div class="text-uppercase clearfix">
									
			<a href="checkout.html" class="btn btn-default pull-right">		
			Checkout
			</a>
		</div>-->
		
		<br>
		<td colspan="4" class="text-center">
			All of the suggestion parts are based from your budget.
		</td>
								
	
 
    
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

<?php mysqli_close($con); ?>
</body>
</html>