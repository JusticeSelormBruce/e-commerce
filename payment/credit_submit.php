<?php

	//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	if(session_id() == '' || !isset($_SESSION)){session_start();}
	require "../functions/connection.php";
	if(!isset($_SESSION["email"])){
		header("location:../index.php");
	  }
	  
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Credit Card Payment</title>
	<link rel="icon" href="../img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="../vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="../vendors/linericon/style.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="../vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="../vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="../css/stylesstages.css">
  
  <link href="../css/alert.css" rel="stylesheet">
 
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
		<a class="navbar-brand logo_h" href="home.php"><h3><img src="../img/Fevicon.png" style="heigth:50px; width:50px;" alt=""> <strong> PROJECT SHOP</strong></h3> </a>
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			   <li class="nav-item "></li>
				<li class="nav-item "></li>
				<li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			  <li class="nav-item "></li>
			   <li class="nav-item "></li>
			    <li class="nav-item "></li>
              <li class="nav-item submenu dropdown">
               
                <ul class="dropdown-menu">
                 
                  
                </ul>
				</li>
             
			<li class="nav-item submenu dropdown">
                
              </li>
              <li class="nav-item active"><a class="nav-link" href="../contact.php"><b> Help</b></a></li>
            </ul>

            
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->
  
	
  
  <!--================Order Details Area =================-->
  <section class="order_details section-margin--small">
    <div class="container">
	<marquee behavior="alternate" scrollamount="10" style="font-size:30px; color:red;"><strong>After Payment. Get (OTP) CODE To Verify Your Order</strong>  </marquee>
   
	<?php
	


	if(isset($_POST['submit'])){
	
	
		$amount = trim($_POST['amount']);
        $amount = mysqli_real_escape_string($con, $amount);
        
        $by = trim($_POST['by']);
		$by = mysqli_real_escape_string($con, $by);

		$cardtype = trim($_POST['cardtype']);
		$cardtype = mysqli_real_escape_string($con, $cardtype);
		
		$number = trim($_POST['number']);
		$number = mysqli_real_escape_string($con, $number);
		
		$cvv = trim($_POST['cvv']);
		$cvv = mysqli_real_escape_string($con, $cvv);
        	
        $expirydate = trim($_POST['expirydate']);
        $expirydate = mysqli_real_escape_string($con, $expirydate);
        
       
		$query = "INSERT INTO payment (amount, paywith,	operator, card_number, cvv_number, expiry_date) VALUES ('" . $amount . "', '" . $by . "','" . $cardtype . "', '" . $number . "', '" . $cvv . "', '" . $expirydate . "')";
		$result = mysqli_query($con, $query);
	if(!$result){
			print "<div class='alert-warning col-md-12 text-center'>
			<span class='closebtn' onclick='this.parennumberement.style.display='none';'>&times;</span>
			<center>Sorry was not able to make payment on your purchase. </center>
		  </div>";

			exit;
		
		?>	
	   <meta http-equiv="refresh" content="5;url= ../credit.php" />

		<?php } else {
			
			print "<div class='alert-success col-md-12 text-center'>
			<span class='closebtn' onclick='this.parennumberement.style.display='none';'>&times;</span>
			<center>Your payment has successfully been received. Please make comfirmation to your order / orders</center>
		  </div>";

		  echo '<br>';
		echo ' <form action="../OTP/get_code.php" method="POST">';	 
		  echo ' <b><center><input type="submit" class="button button-paypal col-md-5 " name="get" value="Get comfirmation code now."></center></b>';
		echo '</form>';
		?>
		

		  <?php	  
		}
		
	}
?>

    </div>
  </section>
  <!--================End Order Details Area =================-->



  <?php require_once '../footer/footer.php'; ?>



  <script src="../vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="../vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../vendors/skrollr.min.js"></script>
  <script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="../vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="../vendors/jquery.ajaxchimp.min.js"></script>
  <script src="../vendors/mail-script.js"></script>
  <script src="../js/main.js"></script>
</body>
</html>



