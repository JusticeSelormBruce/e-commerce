<?php
  if(session_id() == '' || !isset($_SESSION)){session_start();}
  require '../../functions/connection.php';

?>



<!DOCTYPE html>
<php>
<head>
<title>Login As Admin</title>
<link rel="icon" href="images/Fevicon.png" type="image/png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

<link href="../../css/alert.css" rel="stylesheet">

</head> 
   
 <body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
               
          <?php
         
         $admin_email=mysqli_real_escape_string($con,$_POST['admin_email']);
         $regex_admin_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
         if(!preg_match($regex_admin_email,$admin_email)){
             
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
         $user_authentication_query="select id,fname,admin_email,password from admin where admin_email='$admin_email' and password='$pass'";
           
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
             //echo "Wrong admin_email or password.";
         }else{
             $curDate = date("Y-m-d H:i:s");
             mysqli_query($con,
             "UPDATE `users` SET `date`='".$curDate."' 
             WHERE `admin_email`='".$admin_email."';"
             );
             
             $row=mysqli_fetch_array($user_authentication_result);
           
             $_SESSION['admin_email']=$admin_email;
             
             $_SESSION['id']=$row['id'];  //user id
             $_SESSION['fname']=$row['fname']; 
           

             echo "<div class='alert-success col-md-12 text-center'>
             <span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>
             <center><strong>You are Welcome $admin_email </strong></center>
           </div>";
           
       ?>
       <meta http-equiv="refresh" content="2;url= ../dashboard.php" />

       <?php

         }
         
       ?>
				</div>
			</div>
	
  </section>
  <br><br><br><br><br><br><br><br>
  <br><br><br><br>  <br><br><br><br><br><br><br><br>
  <br><br><br><br>   <br><br><br><br>  <br><br><br>
  

     <footer>
		<center>	Copyright &copy;All rights reserved. <i class="fa fa-heart" aria-hidden="true"></i> Developed by <a href="https://www.stageshub.com" target="_blank">Brooks Morgan</a></center>
  		</footer>
      
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>






