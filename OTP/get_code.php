<?php

	//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
   if(session_id() == '' || !isset($_SESSION)){session_start();}
   
	require "../functions/connection.php";
   require 'otp.php';
   
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
  <title>Verify Your Order</title>
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



<?php

  
/**
 *
 *  OTP Generator
 *
 *  Usage: php oneTime.php key
 *
 */

    /** Setting up OTP Class **/
   
  
    $OTP=new OTP();

    /** Passing the $key variable through command line **/
    $key=1;
    /** Getting the OTP **/
    $oneTime = $OTP->getOTP($key);

    /** Printing out the Key and the OTP **/
   
    if(isset($_POST['get'])){
	
      $query = "INSERT INTO otp (code, date) VALUES  ($oneTime, NOW())";
      $result = mysqli_query($con, $query);
   if(!$result){
		 print "OTP code is already in used. wait for 30 seconds to re-generate again";
		 
		 
         exit;
   } 

else {
   
   
     print "<br><br>";
     print "  <center>";
	 print "  <div class='container'>";
	 
	 print '<marquee behavior="alternate" scrollamount="10" style="font-size:35px; color:red;"><strong>OTP Code Generate Automatically</strong>  </marquee>';
               
     print "          <div class='col-lg-8'>";
     print "              <div class='login_form_inner'>";
     print "                  <h3>Order Confirmation</h3>";
     print "                  <form class='row login_form' action='verify_code.php' method='POST' id='register_form' >";
     print "                      <div class='col-md-12 form-group'>";
     print "                        <input type='text' class='form-control text-center' style='font-size:25px' id='code' name='veri' placeholder='Enter Code here...' onfocus='this.placeholder = ''' onblur='this.placeholder = 'Enter Code here...'' value='$oneTime' required='true'>";
     print "                     </div>";
                           
     print "                     <div class='col-md-12 form-group'>";
     print "                         <button type='submit' value='submit' class='button button-login w-100'>Confirm Order</button>";
     print "                      </div>";
     print "                  </form>";
     print "            <br><br>";
     print "            </div>";
     print "         </div>";
     print "     </div>";
     print "     </center>";
     print "   <br><br><br> "; 

}

}

    //print("OTP CODE: $oneTime\n");
?>




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






 	
 