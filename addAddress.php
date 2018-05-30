<?php
session_start();
	include_once('connectdb.php');
	
		$sqlIns="INSERT INTO address VALUES ('',capitalize('".$_POST['txtAddress1']."'),capitalize('".$_POST['txtAddress2']."'),capitalize('".$_POST['txtAddress3']."'),capitalize('".$_POST['txtCity']."'),capitalize('".$_POST['txtState']."'),'".$_POST['txtPoscode']."','".$_SESSION['ic']."')";
		$queryInsert=mysqli_query($con,$sqlIns) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully add address!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=userInfo.php\">";
	
mysqli_close($con);
?>