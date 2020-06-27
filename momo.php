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
  <title>Momo</title>
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
  <!--================ Start Header Menu Area =================-->
  <?php require_once 'navbar.php';?>
	<!--================ End Header Menu Area =================-->
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
            <div class="table-responsive">
            <a class="gray_btn" href="home.php">Keep Shopping</a>
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

                                <?php echo  $quantity ?>
                              
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
                                  <a class="button" href="update-cart.php?action=empty">Empty Cart</a>
                                 
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

    
                         
              
              </div>
          </div>
      </div>


        

  <!--================End Cart Area =================-->
  
  <!--================Checkout Area =================-->

    <div class="container">
       
        <div class="billing_details">
            <div class="row">
            <div class="col-lg-4">
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
                       <!------ <div class="payment_item">
                         <h2><b style="color:green"> Choose Payment Plan</b></h2>
                            <div class="radion_btn">
                              
                               <a href="checkout.php" class="button button-postComment button--active">
                               <b> Mobile Money Payment</b>
                              </a>
                                
                            </div>
                            <p>Pay via our mobile money payment platform.</p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                            <a href="checkout.php" class="button button-postComment button--active">
                               <b> Credit Card </b>
                              
                              </a>
                              <img src="img/product/card.jpg" style="height:20px;" alt="">
                            </div>
                            <p>Pay via credit card; you can pay with your PayPal if you don’t have a Credit Card
                                account.</p>
                               
                        </div>
                      ---->
                     
                    </div>
                </div>


                <br>
                <div class="col-lg-8">
                <marquee behavior="alternate" scrollamount="20" style="font-size:30px; color:red;"><strong>Mobile Money Payment Plan</strong>  </marquee>
     
                    <h3>Payment Requirement</h3>
                    <div class="col-md-12">
                         <label style="color:red"><b>Make sure you have enought fund in your account to pay for your orders.</b> </label>
                       
                     </div>
                     <br>
                     <a href="#" class="button button-postComment button--active" data-toggle="modal" data-target="#exampleModalmomo">Make Payment</a>
                  
                    
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


  
 <!-- Mobile Payment Confirmation Modal -->
 <div class="modal fade" id="exampleModalmomo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-uppercase text-center" id="exampleModalLongTitle"><strong  style="color:red">Mobile Money Number Required For Payment</strong></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">

		<div class="container">
			
				<div class="col-md-12">
				
            <form class="row contact_form" action="payment/momo_submit.php" method="post">
                   
                   <input type="text" class="form-control" id="last" name="amount" placeholder="Card Number" required="true" hidden="true" value="<?php echo $currency .  $grandtotal . $dec ?>">
                   <input type="text" class="form-control" id="by" name="by"  required="true" hidden="true" value="MoMo">
       

                   <div class="col-md-12 form-group p_star">
                           <select class="country_select" name="operator">
                                  <option value="Mtn">Mtn</option>
                                  <option value="Vodafone Gh">Vodafone Gh</option>
                                  <option value="Glo">Glo</option>
                                  <option value="AirtelTigo">AirtelTigo</option>
                              
                           </select>
                       </div>
                   <div class="col-md-12 form-group p_star">
                           <input type="number" class="form-control" id="zip" name="zip" placeholder="Zip Code" required="true">
           
                       </div>
                       
                       <div class="col-md-12 form-group p_star">
                           <input type="number" class="form-control" id="tel" name="number" placeholder="Telephone Number" required="true">
                    
                       </div>
                      
                     <div class="col-md-12 form-group">
                       <div class="creat_account">
                         <input type="checkbox" id="f-option2" name="selector" required="true">
                         <label for="f-option2">Accept our payment terms and conditions</label>
                       </div>
                     </div>
                     
                       <div class="col-md-12">
                        <input type="submit" class="button button-paypal" name="submit" value="Make Payment Now">
                        </div>

                       
                   </form>
                   <br>
				
				
        </div>
      </div>
      
    
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