<?php
session_start();
	include_once('connectdb.php');
				
			$sqlUpd="UPDATE supplier SET supplier_name='".$_POST['txtName']."', supplier_nophone='".$_POST['txtPhone']."', supplier_email='".$_POST['txtEmail']."'";
			$queryUpd=mysqli_query($con,$sqlUpd) or die(mysqli_error($con));
				
			echo"<script type='text/javascript'>
				 alert('Successfully updated!')
				 location.href='userInfoAdmin.php'
			</script>";
				 	
mysqli_close($con);
?>