<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include '../functions/config.php';


$fname = $_POST["fname"];
$lname = $_POST["lname"];
$address = $_POST["address"];
$city = $_POST["city"];
$country = $_POST["country"];
$zip = $_POST["zip"];
$email = $_POST["email"];
$number = $_POST["number"];


if($fname!=""){
  $result = $mysqli->query('UPDATE users SET fname ="'. $fname .'" WHERE id ='.$_SESSION['id']);
  if($result){
  }
}

if($lname!=""){
  $result = $mysqli->query('UPDATE users SET lname ="'. $lname .'" WHERE id ='.$_SESSION['id']);
  if($result){
  }
}

if($address!=""){
  $result = $mysqli->query('UPDATE users SET address ="'. $address .'" WHERE id ='.$_SESSION['id']);
  if($result){
  }
}

if($city!=""){
  $result = $mysqli->query('UPDATE users SET city ="'. $city .'" WHERE id ='.$_SESSION['id']);
  if($result){
  }
}

if($country!=""){
  $result = $mysqli->query('UPDATE users SET country ='. $country .' WHERE id ='.$_SESSION['id']);
  if($result){
  }
}


if( $number!=""){
  $query = $mysqli->query('UPDATE users SET number ="'. $number .'" WHERE id ='.$_SESSION['id']);
  if($query){
  }
}

if( $email!=""){
  $query = $mysqli->query('UPDATE users SET email ="'. $email .'" WHERE id ='.$_SESSION['id']);
  if($query){
  }
}
if( $zip!=""){
    $query = $mysqli->query('UPDATE users SET zip ="'. $zip .'" WHERE id ='.$_SESSION['id']);
    if($query){
    }
  }
  
//else {
//  echo 'Wrong Password. Please try again. <a href="account.php">Go Back</a>';
//}

header("location:../checkout.php");


?>
