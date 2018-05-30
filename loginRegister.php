<!DOCTYPE html>
<html>
<head>

<title>Easy PCTech</title>
<link rel="icon" href="images/New.png" type="image/png" >

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="Easy PCTech">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>


<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/login.css" type="text/css" media="all">
<link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
<script language="javascript" type="text/javascript">
function validate()
{
var formName=document.registerForm;

if (formName.password.value != formName.confirmPassword.value)
{
formName.confirmPassword.focus()
alert("Passwords do no match!");
return false;
}

if(formName.password.value.length < 8)
{
formName.password.focus()
return false;	
}
 
 return true;
}
</script>

</head>
<?php 
	if(isset($_POST['guest']))
	{
		 echo "<meta http-equiv=\"refresh\" content=\"0; URL=homePageGuest.php\">";
	}
?>
<body>

	<h1><b>WELCOME TO EASY PCTECH</b></h1>

	<div class="w3layoutscontaineragileits">
	<h2>Login here</h2>
		<form name="loginForm" action="loginProcess.php" method="POST">
			<input type="text" name="ic" placeholder="NO IC" required>
			<input type="password" name="password" placeholder="PASSWORD" required>
			<div class="aitssendbuttonw3ls">
			<br/>
				<input name="login" type="submit" value="LOGIN" /></form>

				<br><br>OR<br><br>
				
                <form action="" method="post">
				<input type="submit" name="guest" value="GUEST" /></form>
				
				<p><a class="w3_play_icon1" href="#small-dialog2" style="color:white; align:right">Forgot Password?</a></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				
				<br>
				<p> To register new account <span>→</span> <a class="w3_play_icon1" href="#small-dialog1"> Click Here</a></p>
				<div class="clear"></div>
			</div>
			
			
		
	</div>
	
	
	<!-- for forgotpw popup -->
	<div id="small-dialog2" class="mfp-hide" width="50%">
		<div class="contact-form1" >
			<div class="contact-w3-agileits">
				<h3>Forgot Password</h3>
				<form name="forgotPWForm" action="forgotPW.php" method="POST">	
                        <div class="form-sub-w3ls">
							<input name="noIc" placeholder="No IC.       *Fill without dash(-).*"  type="text" pattern="[0-9]{12}" title="Must insert 12 digit number only! without (-)"  required>
							<div class="icon-agile">
								<i class="fa fa-address-card" aria-hidden="true"></i>
							</div>
						</div>
					<div class="submit-w3l">
						<input type="submit" value="Submit">
					</div>
				</form>
			</div>
		</div>	
	</div>
	<!-- //for forgotpw popup -->
	
	
	<!-- for register popup -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
				<h3>Register Form</h3>
				<form name="registerForm" action="saveCustomer.php" method="POST" onSubmit="return validate()">
						<div class="form-sub-w3ls">
							<input name="username" placeholder="Full Name"  type="text" pattern="[a-zA-Z\s./@]+[^0-9\x22]" title="Must insert alphabets only!" required>
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input name="noIc" placeholder="No IC.       *Fill without dash(-).*"  type="text" pattern="[0-9]{12}" title="Must insert 12 digit number only! without (-)"  required>
							<div class="icon-agile">
								<i class="fa fa-address-card" aria-hidden="true"></i>
							</div>
						</div>
                        <div class="form-sub-w3ls">
							<input name="noPhone" placeholder="Mobile Number.      *Fill without dash(-).*"  pattern="[0-9]{10,11}" type="text" title="Must insert without dash(-)"  required>
							<div class="icon-agile">
								<i class="fa fa-address-card" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input name="email" placeholder="youremail@domain.com" class="mail" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Please include an @ in the email address! eg:youremail@domain.com" required>
							<div class="icon-agile">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input name="password" placeholder="Password.       *Atleast 8 characters long.*"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters!" required>
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input name="confirmPassword" placeholder="Confirm Password"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 characters!" required>
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>
					<div class="submit-w3l">
						<input type="submit" value="Register">
					</div>
				</form>
			</div>
		</div>	
	</div>
	<!-- //for register popup -->
	
	<div class="w3footeragile">
		<p> &copy; Easy PCTech System (UNIVERSITI TEKNIKAL MALAYSIA MELAKA)</p>
	</div>

	
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

	<!-- pop-up-box-js-file -->  
		<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
	<!--//pop-up-box-js-file -->
	<script>
		$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});
	</script>
	
</body>
<!-- //Body -->

</html>