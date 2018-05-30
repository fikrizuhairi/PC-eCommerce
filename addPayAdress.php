<?php
session_start();
	include_once('connectdb.php');
	
		$sqlAddress="SELECT * FROM address WHERE address_id='".$_GET['address_id']."'";
		$queryAddress=mysqli_query($con,$sqlAddress) or die(mysqli_error($con));
		$resultAddress=mysqli_fetch_assoc($queryAddress);
		
		$sqlProduct="SELECT  B.cart_id, A.product_name, B.subtotal, B.quantity FROM product A, cart B where B.product_id = A.product_id and B.payment_id is null and B.no_ic = '".$_SESSION['ic']."'";
		$queryProduct=mysqli_query($con,$sqlProduct) or die (mysqli_error($con));
		
		while($resultProduct1=mysqli_fetch_array($queryProduct))
		{
			$sqlNewPayAdd="UPDATE cart SET payment_address1=capitalize('".$resultAddress['address1']."'),payment_address2=capitalize('".$resultAddress['address2']."'),payment_address3=capitalize('".$resultAddress['address3']."'),payment_city=capitalize('".$resultAddress['city']."'),payment_state=capitalize('".$resultAddress['state']."'),payment_poscode='".$resultAddress['poscode']."' WHERE cart_id='".$resultProduct1['cart_id']."'";
			$queryNewPayAdd=mysqli_query($con,$sqlNewPayAdd) or die(mysqli_error($con));
		}
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully save address for shipping!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=checkout.php\">";
	
mysqli_close($con);
?>