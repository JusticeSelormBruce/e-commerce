
<?php

	//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	if(session_id() == '' || !isset($_SESSION)){session_start();}
    require "../functions/connection.php";
    require "../functions/config.php";

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
  <title>Verifying Code</title>
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
	 
	<?php
  
    $veri=mysqli_real_escape_string($con,$_POST['veri']);
    
    $user_authentication_query="select ip,code from otp where code='$veri'";   
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        //no user
        //redirecting to same login page
        print "<div class='alert-warning col-md-12 text-center'>
			<span class='closebtn' onclick='this.parennumberement.style.display='none';'>&times;</span>
			<center>Sorry Invalid comfirmation code entered. Try another one</center>
		  </div>";
       
        ?>
       
        <meta http-equiv="refresh" content="0;url= ../payment/try_again.php"/>

        <?php
        //header('location: login');
        //echo "Wrong email or password.";
    }else{

       ////ADDING OTP TO USED TABLE

        $query = "INSERT INTO otp_used (code, date) VALUES  ('" . $veri . "', NOW())";
        $result = mysqli_query($con, $query);
     if(!$result){
          
           exit;
     }
  
        else {
        
       // print "<div class='text-center text-green'>	
           // <center>Successfuly comfirmed</center>       
              //  </div>";

               ///// REMOVING USED OTP FROM otp database 
                $query = "DELETE FROM otp WHERE code = '$veri'";
                $result = mysqli_query($con, $query);
            
                if(!$result){
                    print "<div class='alert-warning col-md-12 text-center'>
                    <center>An Error Occured</center>
                  </div>";
            
                    exit;
                }
            
                else {
                    
                    if(isset($_SESSION['cart'])) {

                        $total = 0;
                        $shippingtotal = 0;

                        foreach($_SESSION['cart'] as $product_id => $quantity) {
                      
                          $result = $mysqli->query("SELECT * FROM products WHERE id = ".$product_id);
                      
                         if($result){
                      
                            if($obj = $result->fetch_object()) {
                                           
                              $cost = $obj->price * $quantity;
                              $fees = $obj->shipping_fees * $quantity;
                                                            
                              //calculation all totals

                              $total = $total + $cost;
                              $shippingtotal = $shippingtotal + $fees;
                              $grandtotal = $total + $shippingtotal; 

                             //ends

                                $email = $_SESSION["email"];
                                $fname =$_SESSION['fname']; 
                                $lname =$_SESSION['lname']; 
                                $contact =$_SESSION['contact']; 
                                $address = $_SESSION['address']; 
                                $city =$_SESSION['city']; 
                                $country =$_SESSION['country']; 

                              
                              $query = $mysqli->query("INSERT INTO confirmed_orders (product_code,	product_name,	product_desc,	product_img_name,	weight,	size,	color,	price,	fees,	units,	total,	sub_total,	shipping_total,	grand_total,	email,	fname,	lname,	address,	contact,	country,	city,	status) VALUES('$obj->product_code', '$obj->product_name', '$obj->product_desc','$obj->product_img_name', '$obj->weight' , '$obj->size' , '$obj->color', '$obj->price', $fees, $quantity, $cost, $total, $shippingtotal, $grandtotal, '$email','$fname','$lname','$address','$contact','$country','$city','New Order')");
                      
                              if($query){
                                $newqty = $obj->qty - $quantity;
                                if($mysqli->query("UPDATE products SET qty = ".$newqty." WHERE id = ".$product_id)){
                      
                                }
                              }
                      
                              //send mail script
                              /*$query = $mysqli->query("SELECT * from orders order by date desc");
                              if($query){
                                while ($obj = $query->fetch_object()){
                                  $subject = "Your Order ID ".$obj->id;
                                  $message = "<html><body>";
                                  $message .= '<p><h4>Order ID ->'.$obj->id.'</h4></p>';
                                  $message .= '<p><strong>Date of Purchase</strong>: '.$obj->date.'</p>';
                                  $message .= '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
                                  $message .= '<p><strong>Product Name</strong>: '.$obj->product_name.'</p>';
                                  $message .= '<p><strong>Price Per Unit</strong>: '.$obj->price.'</p>';
                                  $message .= '<p><strong>Units Bought</strong>: '.$obj->units.'</p>';
                                  $message .= '<p><strong>Total Cost</strong>: '.$obj->total.'</p>';
                                  $message .= "</body></html>";
                                  $headers = "From: support@techbarrack.com";
                                  $headers .= "MIME-Version: 1.0\r\n";
                                  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                      
                                  $sent = mail($user, $subject, $message, $headers) ;
                                  if($sent){
                                    $message = "";
                                  }
                                  else {
                                    echo 'Failure';
                                  }
                                }
                              }*/
                      
                      
                      
                            }
                          }
                        }
                      }
                      
                      unset($_SESSION['cart']);
                      header("location:success.php");
                       
                 
                }

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



