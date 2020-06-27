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
  <title>Checkout</title>
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

                <?php

                    $id = $_SESSION['id'];
                    $sql = mysqli_query($con, "SELECT * FROM users WHERE id = '$id'");
                    $rowbr=mysqli_fetch_array($sql,MYSQLI_ASSOC);
               
               ?>                

                <div class="col-lg-8">

                  <marquee behavior="alternate" scrollamount="20" style="font-size:30px; color:red;"><strong>Shipping Address Details</strong>  </marquee>

                    <h3>Shipping Address</h3>
                    <form class="row contact_form" action="shipping/shipping-address.php" method="post" >
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="fname" placeholder="First name" value="<?php echo  $rowbr['fname'];?>" readOnly="" required="true">
                          
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="last" name="lname" placeholder="Last name" value="<?php echo  $rowbr['lname'];?>" readOnly="" required="true">
            
                        </div>
                       
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="contact" placeholder="Contact" value="<?php echo  $rowbr['contact'];?>" readOnly="" required="true">
                            
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo  $rowbr['email'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" readOnly="" required="true">
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo  $rowbr['country'];?>" readOnly="" required="true">
                     
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="address" placeholder="Address line 01" value="<?php echo  $rowbr['address'];?>" readOnly="" required="true">
                     
                        </div>
                       
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Town/City"  value="<?php echo  $rowbr['city'];?>" readOnly="" required="true">
                            
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP"  value="<?php echo  $rowbr['zip'];?>" readOnly="" required="true">
                        </div>
                       
                        
                         <?php
                         if(isset($_SESSION['email'])) {
                          echo ' <center><input type="submit" class="button button-paypal" name="submit" value="Use this Shipping Address" style="margin:20px;"></center>';
                         
                          echo '<center><a href="shipping_update.php" class="btn btn-primary" style="margin:25px;" >Update Shipping Address</a></center>';
                          
                          
                        }
              
                        else {
                          echo '<center><a href="index.php" class="button button-paypal" style="margin:20px;">Login</a></center>';
                        }
                         ?>

                    
                    </form>
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