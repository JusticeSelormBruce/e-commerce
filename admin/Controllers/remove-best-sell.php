<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}
require '../../functions/connection.php';


if(!isset($_SESSION["admin_email"])){
	header("location:index.php");
  }

    $bestsell = $_GET['bestsell'];

	$query = "UPDATE products SET best_sell_product = '0' WHERE id = '$bestsell'";
				
	$result = mysqli_query($con, $query);
	if(!$result){
	echo "Can't update data " . mysqli_error($con);
	exit;
	} else {

    header("Location: ../items.php?id=$bestsell");
    
	}



?>