<?php
session_start();
	include_once('connectdb.php');

	$sql="SELECT no_ic,password,role FROM login_user WHERE no_ic='".$_POST['ic']."' and password='".md5($_POST['password'])."'";
	$query=mysqli_query($con,$sql);
	$result = mysqli_fetch_assoc($query);

	if (!$result)
	{
		echo"<script type='text/javascript'>
	 	 alert('Sorry!IC No or Password')
		 location.href='loginRegister.php'
		 </script>";
	}
	else
	{
		 $_SESSION['ic'] = $_POST['ic'];
		 if($result['role'] == "admin")
		 {
			 echo "<meta http-equiv=\"refresh\" content=\"0; URL=adminMenu.php\">";
		 }
		 else if ($result['role'] == "customer")
		 {
			 echo "<meta http-equiv=\"refresh\" content=\"0; URL=homePage.php\">";
		 }
		 else
		 {
			echo"<script type='text/javascript'>
	 		alert('Sorry!IC No or Password')
		 	location.href='loginRegister.php'
		 	</script>"; 
		 }
		 
	}
	mysqli_close($con);
?>