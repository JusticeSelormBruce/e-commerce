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
  <title>Shipping Address</title>
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
					<h1>Update Shipping Address</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Update Address</li>
            </ol>
          </nav>
				</div>
			</div>
	<!-- ================ end banner area ================= -->
  
  
  <!--================Tracking Box Area =================-->
  <section class="tracking_box_area section-margin--small">
      <div class="container">

      
       

        <?php

        $query = ('SELECT * FROM users WHERE id='.$_SESSION['id']);
        $result = mysqli_query($con, $query);
            if(!$result){
            echo "Can't retrieve data " . mysqli_error($con);
            exit;
            }
        $row = mysqli_fetch_assoc($result);

     ?>                

          <div class="tracking_box_inner"> 
          <marquee behavior="alternate" scrollamount="20" style="font-size:30px; color:red;"><strong>Make Changes To Address</strong>  </marquee>

          <h3>Shipping Address</h3>
          <hr>
              <form class="row tracking_form" action="shipping/update.php" method="post">
                  
                       <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="fname" placeholder="First name" value="<?php echo $row['fname']; ?>"  required="true">
                          
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="last" name="lname" placeholder="Last name" value="<?php echo  $row['lname'];?>"  required="true">
            
                        </div>
                       
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number" placeholder="Contact" value="<?php echo  $row['contact'];?>"  required="true">
                            
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="email" readOnly="" placeholder="Email Address" value="<?php echo $row['email'];?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  required="true">
                        </div>
                        
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="add1" name="address" placeholder="Address line 01" value="<?php echo $row['address'];?>"  required="true">
                     
                        </div>
                       
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Town/City"  value="<?php echo $row['city'];?>"  required="true">
                            
                        </div>
                        
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP"  value="<?php echo $row['zip'];?>"  required="true">
                        </div>
                       
                  <div class="col-md-12 form-group">
                      <button type="submit" value="submit" class="button button-tracking">Update Address</button>
                  </div>
              </form>
          </div>
      </div>
  </section>
  <!--================End Tracking Box Area =================-->


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