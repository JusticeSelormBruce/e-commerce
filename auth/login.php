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
  <title>Login</title>
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
  <?php require_once '../navbar.php';?>
	<!--================ End Header Menu Area =================-->
  
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">

            <?php
         
          $email=mysqli_real_escape_string($con,$_POST['email']);
          $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
          if(!preg_match($regex_email,$email)){
              
              print "<div class='alert-warning col-md-12 text-center'>
            <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
            <center>Sorry your email is incorrect. Try again.</center>
            </div>";
              ?>

              <meta http-equiv="refresh" content="2;url= ../index.php" />
              <?php
          }
          $pass=md5(md5(mysqli_real_escape_string($con,$_POST['pass'])));
          if(strlen($pass)<6){
              
              print "<div class='alert-warning col-md-12 text-center'>
              <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
              <center>Password should have atleast 6 characters.</center>
            </div>";
              ?>
              <meta http-equiv="refresh" content="2;url= ../index.php" />
              <?php
          }
          $user_authentication_query="select id,email,password,contact,fname,lname,address,city,country,zip from users where email='$email' and password='$pass'";
            
          $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
          $rows_fetched=mysqli_num_rows($user_authentication_result);
          if($rows_fetched==0){
              print "<div class='alert-warning col-md-12 text-center'>
              <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
              <center>Invaild credentials entered.</center>
            </div>";

              ?>
              
              <meta http-equiv="refresh" content="2;url= ../index.php" />
              <?php
              //header('location: index');
              //echo "Wrong email or password.";
          }else{
              $curDate = date("Y-m-d H:i:s");
              mysqli_query($con,
              "UPDATE `users` SET `date`='".$curDate."' 
              WHERE `email`='".$email."';"
              );
              
              $row=mysqli_fetch_array($user_authentication_result);
            
              $_SESSION['email']=$email;
              
              $_SESSION['id']=$row['id'];  //user id
              $_SESSION['fname']=$row['fname']; 
              $_SESSION['lname']=$row['lname']; 
              $_SESSION['contact']=$row['contact']; 
              $_SESSION['address']=$row['address']; 
              $_SESSION['country']=$row['country']; 
              $_SESSION['city']=$row['city']; 
              $_SESSION['email']=$row['email']; 
              $_SESSION['zip']=$row['zip']; 

              echo "<div class='alert-success col-md-12 text-center'>
              <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
              <center><strong>You are Welcome $email </strong></center>
            </div>";
            
        ?>
        <meta http-equiv="refresh" content="2;url= ../home.php" />

        <?php

          }
          
        ?>
		</div>
	</section>
	<!--================End Login Box Area =================-->
<br><br><br>  <br><br><br><br><br><br>
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
