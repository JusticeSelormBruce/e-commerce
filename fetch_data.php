


<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'functions/category_connection.php';



//fetch_data.php



if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM products WHERE product_status = '1'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["catego"]))
	{
		$catego_filter = implode("','", $_POST["catego"]);
		$query .= "
		 AND  category IN('".$catego_filter."')
		";
	}
	if(isset($_POST["brand"]))
	{
		$ram_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND product_brand IN('".$ram_filter."')
		";
	}
	
	
	$product_id = array();
	$product_quantity = array();
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
		
			$output .= '

				 <div class="col-md-6 col-lg-3">
				<div class="card text-center card-product">
				<div class="card-product__img">
				<img class="card-img" src="productimages/'. $row['product_img_name'] .'" alt="">
				
				
				<ul class="card-product__imgOverlay">
				<li><button><a href="view-product-view.php?viewid='.$row['id'] .'"><i class="ti-eye"></i> </a></button></li>
            
			';
					
			if($row == $row['qty'] > 0){
				
				$output .= '
				<li><button><a href="add_to_cart/category_add.php?action=add&id= '.$row['id'] .'"><i class="ti-shopping-cart"></i></button></li>
				';
			}

			else {					
				$output .= '
				<strong style="color: red;">Out Of Stock!</strong			
				';
				}


			$output .= '
				
					</ul>
					</div>
					<div class="card-body">
					<p style="font-size:13px;"><strong>Units</strong>: '. $row['qty'] .'</p>
						<h4 class="card-product__title" style="font-size:15px;"><a href="#"><b>'. $row['product_name'] .'</b></a></h4>
						<p class="card-product__price" style="color:brown; font-size:16px;"> <strong>New</strong>: ₵'. $row['price'] .'</p>
						<p><del style="color:red; font-size:13px;">₵'. $row['old_price'] .'</del></p>
					</div>
					</div>
				</div>

		
				
		';
		
		}
	}

	else{
		$output = '
		<div class="alert-warning col-md-12 text-center">
		<span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>
		<center><strong>Products not available</strong></center>
	  </div> 
	 ';
	}

	
	echo $output;
}

?>

			