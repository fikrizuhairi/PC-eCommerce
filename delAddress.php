<?php
session_start();
	include_once('connectdb.php');
	
		$sqlIns="DELETE FROM address WHERE address_id='".$_GET['address_id']."'";
		$queryInsert=mysqli_query($con,$sqlIns) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully remove address!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=userInfo.php\">";
	
mysqli_close($con);
?>