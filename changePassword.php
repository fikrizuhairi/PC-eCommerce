<?php
session_start();
	include_once('connectdb.php');
	$sql="SELECT password FROM login_user WHERE password='".md5($_POST['txtPassword'])."' and no_ic='".$_POST['txtIC']."'";
	$query=mysqli_query($con,$sql);
	$result = mysqli_fetch_assoc($query);
	if ($result)
	{		
		$sqlIns2="UPDATE login_user SET password='".md5($_POST['txtConfirmPassword'])."' WHERE no_ic='".$_POST['txtIC']."'";
		$queryInsert2=mysqli_query($con,$sqlIns2) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully change! Please Login!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=loginRegister.php\">";
	}
	else
	{
		echo"<script type='text/javascript'>
	 	 alert('Current Password Wrong!')
		 </script>";
	}
mysqli_close($con);
?>