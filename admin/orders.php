


  <?php
  if(session_id() == '' || !isset($_SESSION)){session_start();}
  require '../functions/connection.php';


  
$query = "SELECT * from confirmed_orders ORDER BY id DESC";
$result = mysqli_query($con, $query);
if(!$result){
  echo "Can't retrieve data " . mysqli_error($con);
  exit;
}


if(!isset($_SESSION["admin_email"])){
	header("location:index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>Orders</title>
<link rel="icon" href="images/Fevicon.png" type="image/png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
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
						
					
						<li ><a href="items.php"><i class="fa fa-shopping-cart "></i> <span>Products</span></a></li>    
						<li><a href="add_items.php"><i class="fa fa-plus-square"></i> <span>Add Product</span></a></li>   
						<li class="active"><a href="orders.php"><i class="fa fa-check"></i> <span>Orders</span></a></li>   
					     
						
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
				<h3 class="blank1">Orders </h3>
					 <div class="xs tabls">
						
						
						
						<div class="bs-example4" data-example-id="simple-responsive-table">
						<div class="table-responsive">
						  <table class="table">
							<thead>
							  <tr>
								<th>ID</th>
								<th>Code</th>
								<th>Prod Name</th>
								<th>Customer Name</th>
								<th>Email</th>
								<th>Paid</th>
								<th>Status</th>
								<th>Date</th>
								<th>Check</th>
								
							  </tr>
							</thead>
							<tbody>
							<?php while($row = mysqli_fetch_assoc($result)){ ?>
							  <tr>
								<th scope="row"><?php echo $row['id']; ?></th>
								<td><?php echo $row['product_code']; ?></td>
								<td><img src="../productimages/<?php echo $row['product_img_name'];?>" alt="" style="height:30px; width:30px;"><?php echo " " .$row['product_name']; ?></td>
								<td><?php echo $row['fname'] . " ". $row['lname']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['grand_total']; ?></td>

								<td>
								<?php

								if($row == $row['status'] > 0){

									//when added to best sell
							
									echo '<center><a href="#" style="color:green;" class="fa fa-check"> Shipped</a></center>';
								
								}

								
								else {					
								
									//when not added to best sell
									echo '<center><b style="color:red;" class="fa fa-shopping "> '.$row['status'].'</b></center>';	
								}

								?>

								</td>

								<td><?php echo $row['date']; ?></td>


									<!----------Actions for Status Shipped/Pending/ In Vehicle --------------->
								<td>
								
								<div class="profile_details">		
								
								<div class="dropdown profile_details_drop">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											
									<button class="btn btn-sm btn-success fa fa-arrow-down"> Actions</button>

									</a>
									<ul class="dropdown-menu drp-mnu">
										

								<!----------Adding and Removing from Top Product --------------->

										<li>

										<?php
											if($row == $row['status'] > 0){

												//remove from top product

												echo '<li> <a href="#"><i class="fa fa-eye"></i> View Orders</a> </li>';
												
		
												}

												else {					
												
													//add to top product
												echo '<li> <a href="#"><i class="fa fa-eye"></i> View Orders</a> </li>';
												echo '<li> <a href="Controllers/status-in-progress.php?inprogress_id= '.$row['id'].' "><i class="fa fa-spinner"></i> In Progress</a> </li>';
												echo '<li> <a href="Controllers/status-in-vehicle.php?vehicle_id='.$row['id'].'"><i class="fa fa-truck"></i> In Vehicle</a> </li>';
												echo '<li> <a href="Controllers/status-shipped.php?shipped_id='.$row['id'].'"><i class="fa fa-check"></i> Shipped</a> </li>';
											
												
												}
										?>

										
									</li>
								  <!--------------------Ends Here-------------------->


									
								
								</td>
							  </tr>

							<?php }?>

							</tbody>
						  </table>
						</div><!-- /.table-responsive -->
					</div>
				</div>
			</div>
		</div>
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