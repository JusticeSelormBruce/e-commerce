<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}
require '../../functions/connection.php';



if(!isset($_SESSION["admin_email"])){
	header("location:index.php");
  }
  
	$deleteid = $_GET['deleteid'];

	$query = "DELETE FROM products WHERE id = '$deleteid'";
	$result = mysqli_query($con, $query);

	
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($con);
		exit;
	}
	header("Location: ../items.php");
	
?>