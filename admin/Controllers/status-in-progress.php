<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}
require '../../functions/connection.php';



if(!isset($_SESSION["admin_email"])){
	header("location:index.php");
  }
  
    $inprogress_id = $_GET['inprogress_id'];

	$query = "UPDATE confirmed_orders SET status = 'In Progress' WHERE id = '$inprogress_id'";
				
	$result = mysqli_query($con, $query);
	if(!$result){
	echo "Can't update data " . mysqli_error($con);
	exit;
	} else {

    header("Location: ../orders.php?id=$inprogress_id");
    
	}



?>