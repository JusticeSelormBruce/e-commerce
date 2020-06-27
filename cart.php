<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'functions/config.php';


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
  <title>Cart</title>
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
					<h1>Shopping Cart</h1>
		<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
				</div>
			</div>
  
	
	<!-- ================ end banner area ================= -->
  
  

  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
            <div class="table-responsive">

            <marquee scrollamount="20" behavior="alternate" style="font-size:30px; color:red;"><strong>Shopping Cart</strong>  </marquee>

            <a class="gray_btn" href="category.php">Keep Shopping</a>
              <?php

                echo '<p><h3>Your Shopping Cart</h3></p>';    

                if(isset($_SESSION['cart'])) {

             ?>

                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Shipping Fees</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total</th>
                          </tr>
                      </thead>

                      <?php
                            $total = 0;
                            $shippingtotal = 0; 
                            $grandtotal = 0;
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

                      <tbody>
                     
                          <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img src="productimages/<?php echo $obj->product_img_name ?>" alt="" style="heigth:50px; width:50px;">
                                      </div>
                                      <div class="media-body">
                                          <p><?php echo $obj->product_name ?></p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5><?php echo $currency . $obj->price?></h5>
                              </td>
                              <td>
                                  <h5><?php echo $currency . $fees. $dec ?></h5>
                              </td>
                              <td>

                                <?php echo  '&nbsp;<a class="btn btn-primary" style="padding:3px;" href="add_to_cart/cart_cart.php?action=add&id='.$product_id.'">+</a>'; ?>
                                <?php echo  $quantity ?>
                                <?php echo '&nbsp;<a class="btn btn-danger" style="padding:3px;" href="add_to_cart/cart_cart.php?action=remove&id='.$product_id.'">-</a>'; ?>
              
                              </td>
                              <td>
                                  <h5><?php echo $currency . $cost. $dec ?></h5>
                              </td>
                          </tr>

                          <?php
                           }
                         }
                    }
                      ?>
                     <tr class="bottom_button">
                              <td>
                                  <a class="button" href="add_to_cart/cart_cart.php?action=empty">Empty Cart</a>
                                 
                              </td>
                              <td>

                              </td>
                              <td>
                             
                              </td>
                              <td>
                                  
                              </td>
                              <td>
                                  
                              </td>

                          </tr>

                         
                         
                      </tbody>
                  </table>

                  <div class="col-lg-8">
                              <div class="order_box">
                              <h2><b style="color:green"> Your Order</b></h2>
                                <ul class="list">
                                    <li><a href="#"><h4>Details <span>Totals</span></h4></a></li>
                                    <hr>
                                </ul>
                                <ul class="list list_2">
                                     <li><a href="#">Sub total <span class="last"><?php echo $currency . $total . $dec?></span></a></li>
                                   
                                    <li><a href="#">Shipping Fees <span><?php echo $currency . $shippingtotal . $dec ?></span></a></li>
                                   <hr>
                                    <li><a href="#"><strong>Grand Total <span><?php echo $currency .  $grandtotal . $dec ?></span></strong></a></li>
                                </ul>
                 </div>
             </div>     
                   <br>     
            <center><a href="checkout.php" class="button button-postComment button--active">Proceed to checkout</a></center>
                        
                         
               <?php
               }
                  else {
                    echo "You have no items in your shopping cart.";
                  }
                ?>

              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->



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