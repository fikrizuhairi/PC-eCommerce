<?php
session_start();
	include_once('connectdb.php');
	
		$sql="UPDATE cart SET quantity='".$_GET['quantity']."',subtotal='".$_GET['subtotal']."' WHERE cart_id='".$_GET['cart_id']."'";
		$query=mysqli_query($con,$sql) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully update cart!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=shoppingCart.php\">";
	
mysqli_close($con);
?>