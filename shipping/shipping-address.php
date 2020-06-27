<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Stages-Hub</title>
  <meta content="width=device-width, initial-scale=1.0" fname="viewport">
  <meta content="" fname="keywords">
  <meta content="" fname="description">

 
  <link href="css/alert.css" rel="stylesheet">
 
 
</head>



<?php
	session_start();

	require "../functions/connection.php";
	

	if(isset($_POST['submit'])){
	
	
		$fname = trim($_POST['fname']);
        $fname = mysqli_real_escape_string($con, $fname);
        
        $lname = trim($_POST['lname']);
		$lname = mysqli_real_escape_string($con, $lname);

		$email = trim($_POST['email']);
		$email = mysqli_real_escape_string($con, $email);
		
		$contact = trim($_POST['contact']);
		$contact = mysqli_real_escape_string($con, $contact);
		
		$address = trim($_POST['address']);
		$address = mysqli_real_escape_string($con, $address);
        	
        $city = trim($_POST['city']);
        $city = mysqli_real_escape_string($con, $city);
        
        $country = trim($_POST['country']);
        $country = mysqli_real_escape_string($con, $country);

        $zip = trim($_POST['zip']);
        $zip = mysqli_real_escape_string($con, $zip);
        
		
		$query = "INSERT INTO shipping_address (fname , lname , contact , address, city, email, zip, country, date) VALUES  ('" . $fname . "', '" . $lname . "', '" . $contact . "', '" . $address . "', '" . $city . "','" . $email . "','" . $zip . "','" . $country . "', NOW())";
		$result = mysqli_query($con, $query);
	if(!$result){
			print "<div class='alert-warning col-md-7 text-center'>
			<span class='closebtn' onclick='this.parencontactement.style.display='none';'>&times;</span>
			<center>An Error Occured </center>
		  </div>";
		  header('location:../checkout.php');
			exit;
		
	?>	
	<body>

	<?php } else {
			
			header('location:../orders-update.php');
		}
		
	}
?>
 
</body>
</html>
