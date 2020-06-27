<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
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
<?php require_once 'navbar.php';?>
	<!--================ End Header Menu Area =================-->
  
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
						
							<a class="button button-account" href="index.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<form class="row login_form" action="auth/register.php" method="POST" id="register_form" >
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="fname" name="fname" placeholder="Firstname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Firstname'" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Lastname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lastname'" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="number" class="form-control" id="number" name="contact" placeholder="Contect" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Contact'" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="address" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required="true">
							</div>
							<div class="col-md-12 form-group">
                            <select  name="country" required="true">
                               
                                <option value="Ghana">Ghana</option>
                                <option value="USA">USA</option>
                                <option value="India">India</option>
                                <option value="China">China</option>
                            </select>
                        </div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="city" name="city" placeholder="City" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="number" class="form-control" id="zip" name="zip" placeholder="Zip Code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Zip Code'" required="true">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="true">
							</div>
							<div class="col-md-12 form-group">
							 <input type="password" class="form-control" id="password1" name="pass" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required="true">
							</div>
            				  <div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password2" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required="true">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector" required="true">
									<label for="f-option2">Do you agree to our Terms and Conditions?</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="button button-register w-100">Register</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<?php require_once 'footer/footer.php'; ?>


  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>

  <script>
        window.onload = function() {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else if(pass2 != pass1)
				document.getElementById("password1").setCustomValidity("Passwords Don't Match");
			else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
</body>
</html>