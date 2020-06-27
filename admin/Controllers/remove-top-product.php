<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}
require '../../functions/connection.php';



if(!isset($_SESSION["admin_email"])){
	header("location:index.php");
  }

  
    $topsell = $_GET['topsell'];

	$query = "UPDATE products SET top_product = '0' WHERE id = '$topsell'";
				
	$result = mysqli_query($con, $query);
	if(!$result){
	echo "Can't update data " . mysqli_error($con);
	exit;
	} else {

    header("Location: ../items.php?id=$topsell");
    
	}



?>