<?php
	session_start();

	require "../../functions/database_functions.php";
	$conn = db_connect();


	
	if(!isset($_SESSION["admin_email"])){
		header("location:index.php");
	  }

	  
	if(isset($_POST['update'])){
		
		$id = $_POST['id'];
		$code = $_POST['code'];
		$name = $_POST['name'];
		$descript = $_POST['descript'];
		$brand = $_POST['brand'];
		$category = $_POST['category'];
		$weight = $_POST['weight'];
		$size = $_POST['size'];
		$color = $_POST['color'];
		$overall = $_POST['overall'];
		$unit = $_POST['unit'];	
		$new_price = $_POST['new_price'];
		$old_price = $_POST['old_price'];	
		$fees = $_POST['fees'];
		
			
		if(isset($_FILES['image1']) && $_FILES['image1']['name'] != ""){
			$image1 = $_FILES['image1']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../../productimages/";
			$uploadDirectory .= $image1;
			move_uploaded_file($_FILES['image1']['tmp_name'], $uploadDirectory);
		}

		if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../../productimages/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}

		if(isset($_FILES['imag']) && $_FILES['imag']['name'] != ""){
			$imag = $_FILES['imag']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../../productimages/";
			$uploadDirectory .= $imag;
			move_uploaded_file($_FILES['imag']['tmp_name'], $uploadDirectory);
		}
       


		$query = "UPDATE products SET product_code ='" .$code ."', product_name = '" . $name ."', product_desc = '" . $descript ."', product_brand = '" . $brand."', category = '" . $category."', weight = '" . $weight."', size = '" . $size ."', color = '" . $color."', overall = '" . $overall."', qty ='" .$unit."', price = '" . $new_price."', old_price ='" . $old_price."', shipping_fees ='" . $fees."' WHERE id = '" . $id."' ";
	
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't add new data " . mysqli_error($conn);
			exit;
		} else {
		   
			header("Location: ../items.php");
		}
		
		if($image1!=""){
			$query = "UPDATE products SET product_img_name  = '" . $image1 ."' WHERE id = '" . $id."' ";
	
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Can't add new data " . mysqli_error($conn);
				exit;
			} else {
			   
				header("Location: ../items.php");
				
			}
		}


		if($image!=""){
			$query = "UPDATE products SET product_img_names  = '" . $image ."' WHERE id = '" . $id."' ";
	
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Can't add new data " . mysqli_error($conn);
				exit;
			} else {
			   
				header("Location: ../items.php");
				
			}
		}

		if($imag!=""){
			$query = "UPDATE products SET product_img_namess  = '" . $imag ."' WHERE id = '" . $id."' ";
	
			$result = mysqli_query($conn, $query);
			if(!$result){
				echo "Can't add new data " . mysqli_error($conn);
				exit;
			} else {
			   
				header("Location: ../items.php");
				
			}
		}

	}
?>
