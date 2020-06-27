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
  <title>Payment</title>
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
          <marquee behavior="alternate" scrollamount="20" style="font-size:30px; color:red;"><strong>Payment Plan</strong>  </marquee>
            <div class="table-responsive">
            <a class="gray_btn" href="home.php">Keep Shopping</a>
            <br>
              <?php

                echo '<p><h3>Choose A Payment Plan</h3></p>';    

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


                         <h2><b style="color:green"> Choose Payment Plan</b></h2>
                            <div class="radion_btn">
                              
                               <a href="momo.php" class="button button-postComment button--active">
                               <b> Mobile Money Payment</b>
                              </a>
                              <img src="momologos.png" style="height:50px;" alt="">
                            </div>
                            <p>Pay via our mobile money payment platform.</p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                            <a href="credit.php" class="button button-postComment button--active">
                               <b> Credit Card </b>
                              
                              </a>
                              <img src="master_visa_logo.png" style="height:50px;" alt="">
                            </div>
                            <p>Pay via credit card; you can pay with your PayPal if you don’t have a Credit Card
                                account.</p>
                               
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



  <?php require_once 'footer/footer.php'; ?>



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