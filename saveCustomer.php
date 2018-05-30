<?php
session_start();
	include_once('connectdb.php');
	$sql="SELECT no_ic FROM customer WHERE no_ic='".$_POST['noIc']."'";
	$query=mysqli_query($con,$sql);
	$result = mysqli_fetch_assoc($query);
	if ($result)
	{
		echo"<script type='text/javascript'>
	 	 alert('This IC No has been registered!')
		 location.href='loginRegister.php'
		 </script>";
		 
	}
	else
	{
		$sqlIns="INSERT INTO customer (no_ic,cust_name,cust_nophone,cust_email) VALUES ('".$_POST['noIc']."',capitalize('".$_POST['username']."'),'".$_POST['noPhone']."','".$_POST['email']."')";
		$queryInsert=mysqli_query($con,$sqlIns) or die(mysqli_error($con));
		
		$sqlIns2="INSERT INTO login_user (no_ic,role,password) VALUES ('".$_POST['noIc']."','customer','".md5($_POST['confirmPassword'])."')";
		$queryInsert2=mysqli_query($con,$sqlIns2) or die(mysqli_error($con));
		
		echo"<script type='text/javascript'>
	 	 alert('Successfully registered! Please Login!')
		 </script>";
		 
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=loginRegister.php\">";
	}
mysqli_close($con);
?>