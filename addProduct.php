<?php
		session_start();
		include_once('connectdb.php');
		
		if($_SESSION['ic'] == "")
		{
			echo"<script type='text/javascript'>
	 	 	alert('Session end! Please login again!')
		    location.href='loginRegister.php'
		 	</script>";
			exit();
		}
		
			$sqlSlc="SELECT * FROM supplier where no_ic='".$_SESSION['ic']."'";
			$querySlc=mysqli_query($con,$sqlSlc) or die(mysqli_error($con));
			$resultData=mysqli_fetch_assoc($querySlc);
			
			$sqlSlc1="SELECT * FROM login_user where no_ic='".$_SESSION['ic']."'";
			$querySlc1=mysqli_query($con,$sqlSlc1) or die(mysqli_error($con));
			$resultData1=mysqli_fetch_assoc($querySlc1);	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Easy PCTech</title>
    <link rel="icon" href="images/New.png" type="image/png" >
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
  
  <script>
function myFunction() {
    if(document.getElementById("productSelect").value == "Monitor")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Acer'>Acer</option>"+
                      "<option value='Philips'>Philips</option>"+
                      "<option value='Dell'>Dell</option>"+
					  "<option value='Asus'>Asus</option>";
	}
	else if(document.getElementById("productSelect").value == "Processor")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Intel'>Intel</option>"+
                      "<option value='AMD'>AMD</option>";
 	}
	else if(document.getElementById("productSelect").value == "Graphic Card")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Asus'>Asus</option>"+
                      "<option value='Gigabyte'>Gigabyte</option>"+
					  "<option value='MSI'>MSI</option>"+
					  "<option value='Sapphire'>Sapphire</option>";
 	}
	else if(document.getElementById("productSelect").value == "Keyboard")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Corsair'>Corsair</option>"+
                      "<option value='Armaggeddon'>Armaggeddon</option>"+
					  "<option value='Logitech'>Logitech</option>"+
					  "<option value='Razer'>Razer</option>";
 	}
	else if(document.getElementById("productSelect").value == "Mouse")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Steelseries'>Steelseries </option>"+
                      "<option value='Alcatroz'>Alcatroz</option>"+
					  "<option value='Microsoft'>Microsoft</option>"+
					  "<option value='Razer'>Razer</option>";
 	}
	else if(document.getElementById("productSelect").value == "Motherboard")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Gigabyte'>Gigabyte </option>"+
                      "<option value='Asus'>Asus</option>"+
					  "<option value='Asrock'>Asrock</option>"+
					  "<option value='MSI'>MSI</option>";
 	}
	else if(document.getElementById("productSelect").value == "Fans & Heatsinks")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Cooler Masterabyte'>Cooler Master </option>"+
                      "<option value='Corsair'>Corsair</option>"+
					  "<option value='Xigmatek '>Xigmatek </option>";
 	}
	else if(document.getElementById("productSelect").value == "Power Supply")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Corsair'>Corsair </option>"+
                      "<option value='Cooler Master'>Cooler Master</option>"+
					  "<option value='Powerlogic'>Powerlogic</option>";
 	}
	else if(document.getElementById("productSelect").value == "RAM")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Corsair'>Corsair </option>"+
                      "<option value='Kingston'>Kingston</option>"+
					  "<option value='Transcend'>Transcend</option>"+
					  "<option value='Apacer'>Apacer</option>";
 	}
	else if(document.getElementById("productSelect").value == "Network Component")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='D-link'>D-link </option>"+
                      "<option value='Tp-link'>Tp-link</option>"+
					  "<option value='Asus'>Asus</option>"+
					  "<option value='Linksys'>Linksys</option>";
 	}
	else if(document.getElementById("productSelect").value == "Scanner")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='HP'>HP</option>"+
                      "<option value='Brother'>Brother</option>"+
					  "<option value='Canon'>Canon</option>"+
					  "<option value='Epson'>Epson</option>";
 	}
	else if(document.getElementById("productSelect").value == "Printer")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Epson'>Epson</option>"+
                      "<option value='Dell'>Dell</option>"+
					  "<option value='Canon'>Canon</option>"+
					  "<option value='Fuji Xerox'>Fuji Xerox</option>";
 	}
	else if(document.getElementById("productSelect").value == "Storage")
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Thecus'>Thecus</option>"+
                      "<option value='Transcend'>Transcend</option>"+
					  "<option value='WD My Book'>WD My Book</option>"+
					  "<option value='Qnap'>Qnap</option>";
 	}
	else
	{
		document.getElementById("productBrand").innerHTML = "<option value=''>Please Select Brand</option>"+
                      "<option value='Kapersky'>Kapersky</option>"+
                      "<option value='Microsoft '>Microsoft </option>"+
					  "<option value='Kaspersky'>Kaspersky</option>"+
					  "<option value='Trend Micro'>Trend Micro</option>"+
					  "<option value='Adobe'>Adobe</option>"+
					  "<option value='Autodesk'>Autodesk</option>";
 	}
    
}
</script>
</head>


    
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="adminMenu.php"><span>Easy PCTech</span>Admin</a>
				<center><span>Welcome</span></center>
						
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<div class="divider"></div>
		
		<ul class="nav menu">
			<li><a href="adminMenu.php"><em class="fa fa-home">&nbsp;</em> Menu</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-product-hunt">&nbsp;</em> Product <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li class="active"><a class="" href="addProduct.php">
						<span class="fa fa-plus">&nbsp;</span> Add Product
					</a></li>
					<li><a class="" href="updateProduct.php">
						<span class="fa fa-refresh">&nbsp;</span> Update Product
					</a></li>
				</ul>	
			</li>
			<li><a href="adminShipping.php"><em class="fa fa-truck">&nbsp;</em> Shipping</a></li>
            <li><a href="adminStat.php"><em class="fa fa-area-chart">&nbsp;</em> Statistic Sold Item</a></li>
			<li><a href="custInfo.php"><em class="fa fa-users">&nbsp;</em> Customer Info</a></li>
            <li><a href="userInfoAdmin.php"><em class="fa fa-user">&nbsp;</em> User Info</a></li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="adminMenu.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Add Product</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add Product</h1>               
			</div>
		</div><!--/.row-->
<?php  
	if(isset($_POST['submit']))
	{
		$files   = $_FILES['file']['name'];
		$tmp = explode('.', $files);
		$file_ext=strtolower(end($tmp));     
		$extensions= array('image/png','image/jpg','image/jpeg');
		$file_basename = substr($files, 0, strripos($files, '.')); // get file extention
        $file_ext1 = substr($files, strripos($files, '.')); // get file name 
		/*--------------------------------------*/
		/*---------------------------------------*/
		if(in_array($_FILES['file']['type'],$extensions))
		{
			for($seq = 1; file_exists("imgProduct/".$files); $seq++ )
			{
				if(file_exists("imgProduct/".$files))
				{
					$files = $file_basename. '('.$seq.')'. $file_ext1;
				}
			}
			
			if(move_uploaded_file($_FILES['file']['tmp_name'], "imgProduct/".$files))
					{
						$sqlIns="INSERT INTO product VALUES ('',capitalize('".$_POST['productName']."'),'".$_POST['productType']."',capitalize('".$_POST['productBrand']."'),UPPER('".$_POST['productModel']."'),'".$_POST['productPrice']."','".$_POST['productDesc']."','".$files."','".$_POST['productQuantity']."','1','".$_SESSION['ic']."','".$_POST['chkPCGaming']."','".$_POST['chkOffice']."','".$_POST['chkPersonalUses']."')";
						$queryIns=mysqli_query($con,$sqlIns) or die(mysqli_error($con));
						
						echo"<script type='text/javascript'>
						 alert('Successfully inserted!')
						 location.href='addProduct.php'
						 </script>";
					}
					else
					{		
						echo "ERROR: Could not able to execute. " .mysqli_error($con);
					}
		}
		else
		{
			echo ("<SCRIPT LANGUAGE='JavaScript'>
           window.alert('Please send only jpeg, jpg and png format .')
            location.href='addProduct.php'
               </SCRIPT>");
		}
			
		
		
		
	}
	
?>
		<div class="row">
              <form role="form" action="" method="POST" enctype="multipart/form-data" >
                <div class="col-md-6">
                
                <div class="form-group">
               <label for="productname" class="loginFormElement">Product Name:</label>
               <input class="form-control" id="productname" name="productName" type="text" required>
               </div>
               <div class="form-group">
                <label for="productType" class="loginFormElement">Product Type:</label>
                    <select class="form-control" id="productSelect" name="productType"  required="required" oninput="myFunction()"><option value="">Please Select Type</option>
                      <option value="Monitor">Monitor</option>
                      <option value="Processor">Processor</option>
                      <option value="Graphic Card">Graphic Card</option>
                      <option value="Keyboard">Keyboard</option>
                      <option value="Mouse">Mouse</option>
                      <option value="Motherboard">Motherboard</option>
                      <option value="Fans & Heatsinks">Fans & Heatsinks</option>
                      <option value="Power Supply">Power Supply</option>
                      <option value="RAM">RAM</option>
                      <option value="Network Component">Network Component</option>
                      <option value="Scanner">Scanner</option>
                      <option value="Printer">Printer</option>
                      <option value="Storage">Storage</option>
                      <option value="Software">Software</option>
                    </select>
                 </div>
                <div class="form-group">
               <label for="productbrand" class="loginFormElement">Product Brand:</label>
               <input class="form-control" id="productbrand" name="productBrand" type="hidden" required>
			   <select class="form-control" id="productBrand" name="productBrand"  required="required"><option value="">Please Select Brand</option>
                      
               </select>
               </div>
                
               <div class="form-group">
               <label for="productmodel" class="loginFormElement">Product Model:</label>
               <input class="form-control" id="productmodel" name="productModel" type="text" required>
               </div>
               
               <div class="form-group">
               <label for="productSuitable" class="loginFormElement">Suitable for:</label>
               PC Gaming? &nbsp; &nbsp;
                   <input type="radio" id="chkYes" name="chkPCGaming" value="1" required="required"  />
                     Yes
                   <input type="radio" id="chkNo" name="chkPCGaming" value="0" required="required"/>
                     No
               <br/>
               Office? &nbsp; &nbsp;
                   <input type="radio" id="chkYes" name="chkOffice" value="1" required="required"  />
                     Yes
                   <input type="radio" id="chkNo" name="chkOffice" value="0" required="required"/>
                     No
               <br/>
               Personal Uses? &nbsp; &nbsp;
                   <input type="radio" id="chkYes" name="chkPersonalUses" value="1" required="required"  />
                     Yes
                   <input type="radio" id="chkNo" name="chkPersonalUses" value="0" required="required"/>
                     No
               
               
               </div>
               
               </div>
               <div class="col-md-6">
                <div class="form-group">
               <label for="productprice" class="loginFormElement">Product Price (RM):</label>
               <input class="form-control" id="productprice" name="productPrice" type="text" placeholder="eg: 23" required>
               </div>
               <div class="form-group">
               <label for="productquantity" class="loginFormElement">Product Quantity:</label>
               <input class="form-control" id="productquantity" name="productQuantity" type="number" pattern="[1-9]{1,}" value="1" min="1" required>
               </div>
               
                <div class="form-group">
               <label for="productdescription" class="loginFormElement">Product Description:</label>
                    <textarea name="productDesc" style="width: 100%;">
                    </textarea>
               </div>
               <div class="form-group">
               <label for="productImage" class="loginFormElement">Product Image:</label>
               <input class="filestyle" data-icon="false" type="file" name="file" title="Please upload image!" required>
               </div>
               <br> 
             </div>
             	
             <br>			
			<div class="col-sm-12">
			<center><button type="submit" id="addProduct" name="submit" class="btn btn-success loginFormElement">Add Product</button>
             <a href="adminMenu.php"><button type="button" id="cancel" name="cancel" class="btn btn-danger loginFormElement">Cancel</button></a></center>
				<br/>
			</div></form>
           <!-- <p class="back-link">Easy PCTech </p>-->
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
	<?php mysqli_close($con); ?>
</body>
</html>