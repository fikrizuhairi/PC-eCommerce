<?php
session_start();
	include_once('connectdb.php');
				
			$sqlUpd="UPDATE customer SET cust_name='".$_POST['txtName']."', cust_nophone='".$_POST['txtPhone']."', cust_email='".$_POST['txtEmail']."' WHERE no_ic='".$_SESSION['ic']."'";
			$queryUpd=mysqli_query($con,$sqlUpd) or die(mysqli_error($con));
				
			echo"<script type='text/javascript'>
				 alert('Successfully updated!')
				 location.href='userInfo.php'
			</script>";
				 	
mysqli_close($con);
?>