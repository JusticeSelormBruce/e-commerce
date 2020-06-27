<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
require '../functions/connection.php';



$editproduct_id = $_GET['editproduct_id'];

// get product data

$query = "SELECT * FROM products WHERE id = '$editproduct_id'";
$result = mysqli_query($con, $query);
if(!$result){
	echo "Can't retrieve data " . mysqli_error($con);
	exit;
}

$row = mysqli_fetch_assoc($result);



if(!isset($_SESSION["admin_email"])){
	header("location:index.php");
  }
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Edit Product</title>
<link rel="icon" href="images/Fevicon.png" type="image/png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

</head> 
   
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
 <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="dashboard.php"><span>Admin</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="dashboard.php"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
				<ul class="nav nav-pills nav-stacked custom-nav">
						<li><a href="dashboard.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
						
					
						<li class="active"><a href="items.php"><i class="fa fa-shopping-cart "></i> <span>Products</span></a></li>    
						<li ><a href="add_items.php"><i class="fa fa-plus-square"></i> <span>Add Product</span></a></li>   
						<li><a href="orders.php"><i class="fa fa-check"></i> <span>Orders</span></a></li>   
					     
						
						<li class="menu-list"><a href="#"><i class="fa fa-user"></i>  <span>Profile</span></a> 
							<ul class="sub-menu-list">
							<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>  
								<li><a href="admin_auth/logout.php" class="fa fa-sign-out"> Logout</a> </li>
								<li><a href="register.php" class="fa fa-plus-circle"> Sign Up</a></li>
								
							</ul>
						</li>

						<li><a href="users.php"><i class="fa fa-users"></i> <span>Site Users</span></a></li>   
					
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->
    
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			 
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details_left">
						<ul class="nofitications-dropdown">
							
							<li class="login_box" id="loginContainer">
									<div class="search-box">
										<div id="sb-search" class="sb-search">
											<form>
												<input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search">
												<input class="sb-search-submit" type="submit" value="">
												<span class="sb-icon-search"> </span>
											</form>
										</div>
									</div>
										<!-- search-scripts -->
										<script src="js/classie.js"></script>
										<script src="js/uisearch.js"></script>
											<script>
												new UISearch( document.getElementById( 'sb-search' ) );
											</script>
										<!-- //search-scripts -->
							</li>
							
							   							   		
							<div class="clearfix"></div>	
						</ul>
					</div>
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
										
										<span><img src="images/avatar.jpg" alt="profile" class="cirlce" style="height:40px; width:40px;"></span>
										 <div class="user-name">
											<p><?php echo $_SESSION["fname"]; ?><span> Admin</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>		
								</a>
								<ul class="dropdown-menu drp-mnu">
								<li><a href="admin_auth/logout.php" class="fa fa-sign-out"> Logout</a> </li>
								<li><a href="register.php" class="fa fa-plus-circle"> Sign Up</a></li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		
					       	
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->


			<div id="page-wrapper">
				<div class="graphs">
				<div class="tab-content">
				<h3 class="blank1">Make Changes To Product </h3>
						<div class="tab-pane active" id="horizontal-form">

							<form class="form-horizontal"  method="post" action="Controllers/edit-product.php" enctype="multipart/form-data">

								<div class="form-group">
								<label for="focusedinput" class="col-sm-2 control-label"><strong style="color:red">Product Details</strong></label>
								
								</div>
								<div class="form-group">
							
									<div class="col-sm-5">
										<input type="text" class="form-control1" name="id" hidden="true" value="<?php echo $row['id'];?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Product Code</label>
									<div class="col-sm-5">
										<input type="text" class="form-control1" name="code"  placeholder="Produc Code" style="color:blue;" value="<?php echo $row['product_code'];?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Product Name</label>
									<div class="col-sm-5">
										<input type="text" class="form-control1"  name="name"  placeholder="Product Name"  style="color:blue;"  value="<?php echo $row['product_name'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="txtarea1"  class="col-sm-2 control-label">Description</label>
									<div class="col-sm-5"><textarea  name="descript" id="txtarea1" cols="100" rows="10" name="descript"  style="color:blue;"  class="form-control1" placehoder="Product Description"><?php echo $row['product_desc'];?></textarea></div>
								</div>
								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Product Brand</label>
									<div class="col-sm-5">
										<input type="text" class="form-control1"  name="brand"  placeholder="Product Brand" style="color:blue;"  value="<?php echo $row['product_brand'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword" class="col-sm-2 control-label">Category</label>
									<div class="col-sm-5">
										<input type="text" class="form-control1"  name="category"  placeholder="Category eg. Electronics" style="color:blue;"  value="<?php echo $row['category'];?>">
									</div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Weight</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" name="weight"  placeholder="Weight" style="color:blue;"  value="<?php echo $row['weight'];?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Size</label>
									<div class="col-sm-3">
										<input type="text" class="form-control1" name="size"  placeholder="Size" style="color:blue;"  value="<?php echo $row['size'];?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Color</label>
									<div class="col-sm-3">	
										<input type="text" class="form-control1" name="color" placeholder="Color" style="color:blue;"  value="<?php echo $row['color'];?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Rating Star <strong style="color:red;"> (Max. 5.0 and Min. 1.0)</strong></label>
									<div class="col-sm-3">
									<select name="overall"  class="form-control1" style="color:blue;" >
										<option value="<?php echo $row['overall'];?>"><?php echo $row['overall'];?></option>
										<option value=""></option>
										<option value="">Select new rate</option>
										<option value="5.0">5.0</option>
										<option value="4.0">4.0</option>
										<option value="3.0">3.0</option>
										<option value="2.0">2.0</option>
										<option value="1.0">1.0</option>
										</select>
									</div>
									
								</div>
								
									 
								<div class="form-group">
											<label for="focusedinput" class="col-sm-2 control-label">Units (Qunatity)</label>
											<div class="col-sm-3">
												<input type="number" class="form-control1"  name="unit" placeholder="Units" style="color:blue;"  value="<?php echo $row['qty'];?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">New Price</label>
									<div class="col-sm-3">
										<input type="number" class="form-control1" name="new_price" placeholder="New Price" style="color:blue;"  value="<?php echo $row['price'];?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Old Price</label>
									<div class="col-sm-3">
										<input type="number" class="form-control1" name="old_price" placeholder="Old Price" style="color:blue;"  value="<?php echo $row['old_price'];?>">
									</div>
									
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Shipping Fees</label>
									<div class="col-sm-3">
										<input type="number" class="form-control1" name="fees" placeholder="Shipping Fees" style="color:blue;"  value="<?php echo $row['shipping_fees'];?>">
									</div>
									
								</div>
								
								<div class="form-group">
								<label for="focusedinput" class="col-sm-2 control-label" >Front View</label>
                                <img src="../productimages/<?php echo $row['product_img_name'];?>" alt="" style="height:75px; width:75px;">
                                    
                                <div class="col-sm-3">
										<input type="file" class="form-control1" name="image1">
									</div>
									
								</div>
								<div class="form-group">	
                                <label for="focusedinput" class="col-sm-2 control-label" >Back View</label>
                                <img src="../productimages/<?php echo $row['product_img_names'];?>" alt="" style="height:75px; width:75px;">
		
									<div class="col-sm-3">
										<input type="file" class="form-control1" name="image">
									</div>
									
								</div>
								<div class="form-group">	
								<label for="focusedinput" class="col-sm-2 control-label" >Others</label>
                                <img src="../productimages/<?php echo $row['product_img_namess'];?>" alt="" style="height:75px; width:75px;">
									<div class="col-sm-3">
										<input type="file" class="form-control1" name="imag">
									</div>
								
							
								<br>
								<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
								
									<input type="submit" name="update" class="btn-success btn" value="Make Changes">
									<a href="items.php"class="btn-default btn" > Back</a>
								
								</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br><br><br>
		<!--footer section start-->
			<!--footer section start-->
			<footer>
					Copyright &copy;All rights reserved. <i class="fa fa-heart" aria-hidden="true"></i> Developed by <a href="https://www.projectgroup.com" target="_blank">Project Group</a>
			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>