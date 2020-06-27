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
  <title>My Orders</title>
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
              <li class="breadcrumb-item active" aria-current="page">Shopping Orders</li>
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
          
              <?php
            echo '<p><h3>My Orders </h3></p>';
            echo "<hr>";   
                $email = $_SESSION["email"];
                $result = $mysqli->query("SELECT * from confirmed_orders where email='".$email."'");
                if($result) {
                while($obj = $result->fetch_object()) {

             ?>

                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col"><strong>Product</strong></th>
                              <th scope="col"><strong>Price</strong></th>
                              <th scope="col"><strong>Quantity</strong></th>
                              <th scope="col"><strong>Paid Amount</strong></th>
                              <th scope="col"><strong>Status</strong></th>
                           
                          </tr>
                      </thead>

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
                                  <h5><?php echo $obj->price?></h5>
                              </td>
                              <td>
                                  <h5><?php echo $obj->units ?></h5>
                              </td>
                            
                              <td>
                                  <h5><?php echo $obj->total ?></h5>
                              </td>
                              <td>
                              <?php

                                if($obj->status > 0){

                                  //when added to best sell

                                  echo '<center><a href="#" style="color:green;" class="fa fa-check"> Shipped</a></center>';

                                }


                                else {					

                                  //when not added to best sell
                                  echo '<center><b style="color:red;" class="fa fa-shopping "> '.$obj->status.'</b></center>';	
                                }

                                ?>

                              </td>
                          </tr>
                </table>
                          <?php
                           }
                    }

                 
                 ?>
                          
               </div>     
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