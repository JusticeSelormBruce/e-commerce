<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'functions/config.php';
include 'functions/connection.php';

if(!isset($_SESSION["email"])){
  header("location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Account Verification</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">

  <link rel="stylesheet" href="css/stylesstages.css">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <?php require_once 'navbar.php';?>
	<!--================ End Header Menu Area =================-->

	<!-- ================ start banner area ================= -->	
	
  <div class="blog-banner" style="background-image:url(img/home/parallax-bg.png); height:200px;">
        <br>
	 <div class="text-center">
   <h1>Product Checkout</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
				</div>
			</div>
	<!-- ================ end banner area ================= -->
  
  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
          <marquee behavior="alternate" scrollamount="20" style="font-size:30px; color:red;"><strong>Proceeding To Payment Plan</strong>  </marquee>
            <div class="table-responsive">
            <a class="gray_btn" href="home.php">Keep Shopping</a>
            <br>
              <?php

                echo '<p><h3>Order Summary</h3></p>';    

                if(isset($_SESSION['cart'])) {

             ?>


                      <?php
                            $total = 0;
                            $shippingtotal = 0; 
                            foreach($_SESSION['cart'] as $product_id => $quantity) {

                            $result = $mysqli->query("SELECT product_img_name,shipping_fees, product_name, qty, price FROM products WHERE id = ".$product_id);


                            if($result){

                                while($obj = $result->fetch_object()) {
                                  $cost = $obj->price * $quantity; //work out the line cost
                                  $total = $total + $cost; //add to the total cost

                                  $fees = $obj->shipping_fees * $quantity; //work out the line shipping fee cost
                                  $shippingtotal = $shippingtotal + $fees; //add to the shippingtotal cost

                                  $grandtotal = $total + $shippingtotal; //add to the grandtotal cost

                      ?>


                          <?php
                           }
                         }
                    }
                      ?>
                     
              </div>
          </div>
      </div>


        

  <!--================End Cart Area =================-->
  
  <!--================Checkout Area =================-->

    <div class="container">
       
        <div class="billing_details">
            <div class="row">
            <div class="col-lg-7">
              
                    <div class="order_box">
                        <h2><b style="color:green"> Your Order</b></h2>
                        <ul class="list">
                            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                            </ul>
                        <ul class="list list_2">
                        <li><a href="#">Sub total <span class="last"><?php echo $currency . $total . $dec?></span></a></li>
                                   
                         <li><a href="#">Shipping Fees <span><?php echo $currency . $shippingtotal . $dec ?></span></a></li>
                           <hr>
                        <li><a href="#"><strong>Grand Total <span><?php echo $currency .  $grandtotal . $dec ?></span></strong></a></li>
                      </ul>
                      <hr>
                      <br>
                      <div class="payment_item">


                         <h2><b style="color:green"> Proceed To Pay For Your Order / Orders</b></h2>
                            <div class="radion_btn">
                              
                              <a href="#" class="button button-postComment button--active" data-toggle="modal" data-target="#exampleModalmomo">
                              Proceed To Payment
                              </a>
                              
                            </div>
                          
                        </div>
                       
                    </div>
                </div>

              
               
            </div>
        </div>
    </div>

          <?php
               }
                  else {
                    echo "You have no items in your shopping cart.";
                  }
             ?>

             
  </section>
  <!--================End Checkout Area =================-->



  <!--================ Start footer Area  =================-->	
  <footer class="footer">
		<div class="footer-area">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title large_title">Our Mission</h4>
							<p>
							We sells all kinds of mobile phones and its accessories.

              We also develop all kind of software that you need to improve on you daily bussines.</p>
							<p>
              Been Andriod Applications Webased Applications, Desktop Applications and many more.
							
							</p>
						</div>
					</div>
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
								<li><a href="home.php">Home</a></li>
								<li><a href="category.php">Shop</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
						</div>
					</div>
				
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Contact Us</h4>
							<div class="ml-40">
								<p class="sm-head">
									<span class="fa fa-location-arrow"></span>
									Head Office
								</p>
								<p>Koforidua,Koforidua Technical University</p>
	
								<p class="sm-head">
									<span class="fa fa-phone"></span>
									Phone Number
								</p>
								<p>
								<a href="tel:+233 244644700">+233 244644700</a>	 <br>
									
								</p>
	
								<p class="sm-head">
									<span class="fa fa-envelope"></span>
									Email
								</p>
								<p>
                  <a href="mailto:brooksmorgan@hotmail.com">brooksmorgan@hotmail.com</a>
								
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>






		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;All rights reserved. <i class="fa fa-heart" aria-hidden="true"></i> Developed by <a href="https://www.projectgroup.com" target="_blank">Project Group</a>
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->


   <!-- Mobile Payment Confirmation Modal -->
 <div class="modal fade" id="exampleModalmomo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase text-center" id="exampleModalLongTitle"><strong style=" color:red;">Confirm Your Account For Payment</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
	  <center>
		<div class="container">
			
				<div class="col-lg-12">
       
        
						<h5>Account Confirmation</h5>
						<form class="row login_form" action="auth confirm/login1.php" method="POST" id="register_form" >
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="pass" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required="true">
							</div>
							
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-login w-100">Confirm Account</button>
							</div>
						</form>
				
				
        </div>
      </div>
      </center>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
     
      </div>
    </div>
  </div>
</div>
<!-- //Mobile Payment Ends Modal -->







  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>