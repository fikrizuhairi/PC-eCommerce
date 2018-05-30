<?php
session_start();
	include_once('connectdb.php');
	
		$sqlIns="UPDATE product SET product_availability = '1' WHERE product_id='".$_GET['product_id']."'";
		$queryInsert=mysqli_query($con,$sqlIns) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully restore product!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=updateProduct.php\">";
	
mysqli_close($con);
?>