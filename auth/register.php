
<?php
  if(session_id() == '' || !isset($_SESSION)){session_start();}
  require '../functions/connection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
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
  <?php require_once 'navbar.php';?>
	<!--================ End Header Menu Area =================-->
  
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">

      <?php
         
    $fname= mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
    $contact=mysqli_real_escape_string($con,$_POST['contact']);
    $address=mysqli_real_escape_string($con,$_POST['address']);
    $country=mysqli_real_escape_string($con,$_POST['country']);
    $city=mysqli_real_escape_string($con,$_POST['city']);
    $zip=mysqli_real_escape_string($con,$_POST['zip']);
    $email=mysqli_real_escape_string($con,$_POST['email']);

    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        print "<div class='alert-warning col-md-12 text-center'>
			<span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
			<center>Sorry your email is incorrect. Try again.</center>
		  </div>";
        ?>
        <meta http-equiv="refresh" content="1;url= ../register.php" />
        <?php
    }
    $pass=md5(md5(mysqli_real_escape_string($con,$_POST['pass'])));
    if(strlen($pass)<6){
        print "<div class='alert-warning col-md-12 text-center'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        <center>Password should have atleast 6 characters.</center>
      </div>";

        ?>
        <meta http-equiv="refresh" content="1;url= ../register.php" />
        <?php
    }
   
    $duplicate_user_query="select id from users where email='$email'";
    $duplicate_user_result=mysqli_query($con,$duplicate_user_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($duplicate_user_result);
    if($rows_fetched>0){
        //duplicate registration
     print "<div class='alert-warning col-md-12 text-center'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        <center>Email already taken!</center>
      </div>";
        ?>
        
        <meta http-equiv="refresh" content="1;url= ../register.php" />

        <?php
    }else{
        $user_registration_query="insert into users(fname,lname,contact, address,country, city, zip, email, password,date) VALUES('$fname', '$lname','$contact', '$address','$country', '$city','$zip','$email', '$pass',NOW())";
        //die($user_registration_query);
        $user_registration_result=mysqli_query($con,$user_registration_query) or die(mysqli_error($con));

      

        $_SESSION['email']=$email;
        //The mysqli_insert_id() function returns the id (generated with AUTO_INCREMENT) used in the last query.
        $_SESSION['id']=mysqli_insert_id($con); 
        //header('location: ../home.php');  //for redirecting

        echo "<div class='alert-success col-md-12 text-center'>
        <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
        <center><strong>You have successfully signed up</strong></center>
      </div>";


        ?>
        <meta http-equiv="refresh" content="2;url= ../index.php" />
        <?php
    }
    
    ?>
		</div>
	</section>
	<!--================End Login Box Area =================-->


 <!--================ Start footer Area  =================-->	
 <footer class="footer">
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
