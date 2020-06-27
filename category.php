<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'functions/category_connection.php';
include 'functions/config.php';

if(!isset($_SESSION["email"])){
  header("location:index.php");
}

?>

 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Category</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/nouislider/nouislider.min.css">
  <link href="css/alert.css" rel="stylesheet">
 

    <link rel="stylesheet" href="css/bootstrapother.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    
  <link rel="stylesheet" href="css/stylesstages.css">

  <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
  
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <?php require_once 'navbar.php';?>
	<!--================ End Header Menu Area =================-->

	<!-- ================ start banner area ================= -->	

  <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-2 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/home/hero-banner.png" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h4>Shop is fun</h4>
              <h3>Browse Category For <span> Our Premium Product</span></h3>
             <center> <a class="button button-hero" href="category.php">Browse Now</a></center>
            </div>
          </div>
        </div>
      </div>
    </section>
	<!-- ================ end banner area ================= -->

      
	<!-- ================ category section start ================= -->		  
  <section class="section-margin--small mb-5">
    <div class="container">
      <div class="row">
        
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Browse Categories</div>
            <ul class="main-categories">
            <?php

              $query = "SELECT DISTINCT(category) FROM products WHERE product_status = '1' ORDER BY category DESC";
              $statement = $connect->prepare($query);
              $statement->execute();
              $result = $statement->fetchAll();
              foreach($result as $row)
              {
               ?>
                 
                <label><li class="filter-list"><input class="pixel-radio common_selector catego" type="checkbox" id="men"  value="<?php echo $row['category']; ?>"><strong><?php echo $row['category']; ?></strong></label></li> 
             
               <?php
                 }

               ?>
            </ul>
          </div>

          <div class="sidebar-filter">
            <div class="top-filter-head">Filter Product</div>
            <div class="common-filter">
              <div class="head">Brands</div>
             
                <ul>

                <?php

                  $query = "SELECT DISTINCT(product_brand) FROM products WHERE product_status = '1' ORDER BY id DESC ";
                  $statement = $connect->prepare($query);
                  $statement->execute();
                  $result = $statement->fetchAll();
                  foreach($result as $row)
                  {
                  ?>

                 <label><li class="filter-list"><input class="pixel-radio common_selector brand" type="checkbox" id="men"  value="<?php echo $row['product_brand']; ?>"> <strong><?php echo $row['product_brand']; ?></strong></label></li>
              
                  <?php    
                    }

                    ?>

                </ul>
              
            </div>
            
            <div class="common-filter">
              <div class="head">Price</div>
              <div class="price-range-area">
                <div id="price-range"></div>
                <div class="value-wrapper d-flex">
                  <div class="price">Price:</div>
                  <span>₵</span>
                  <div id="lower-value"></div>
                  <div class="to">to</div>
                  <span>₵</span>
                  <div id="upper-value"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
               
    
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
          <div class="sorting">
              
              </div>
              <div class="sorting mr-auto">
                
            </div>
          <form method="get">
            <div>
              <div class="input-group filter-bar-search">
                <input type="text" placeholder="Search" name="search" class="col-md-8" required="true">
                <div class="input-group-append">
                <button><i class="ti-search"></i></button>
                </div>
              </div>
            </div>
          </form>
         </div>

           
          <!-- End Filter Bar -->

         


          <!-- Start Searching  -->
          



          
      <section class="lattest-product-area pb-40 category-list">      
          <div class="row">
         
         
             <?php
          
          require_once 'functions/dbconnect.php';

          if (isset($_GET['search'])){

            $search = $db->escape_string($_GET['search']);
          
          $query =$db->query("
                SELECT * FROM products 
                WHERE category LIKE '%{$search}%'
                OR color LIKE '%{$search}%'
          ");
        ?>

         
          <?php

          if($query->num_rows){
              while($r = $query->fetch_object()){
          ?>
        

              <div class="col-md-6 col-lg-3">

                <div class="card text-center card-product">
                <div class="card-product__img">
                <img class="card-img" src="productimages/<?php echo $r->product_img_name ?>" alt="">
                <ul class="card-product__imgOverlay">

               <li><button><a href="view-product-view.php?viewid=<?php echo $r->id ?>"><i class="ti-eye"></i> </a></button></li>
            
                <?php   
                if($r->qty > 0){

                echo '<li><button><a href="add_to_cart/category_add.php?action=add&id='.$r->id.'"><i class="ti-shopping-cart"></i></button></li>';
                }
                else {
                  echo '<strong style="color: red;">Out Of Stock!</strong>';
                }
                ?>
                  
                </ul>
              </div>
              <div class="card-body">
                 <p style="font-size:13px;"><strong>Units</strong>: <?php echo $r->qty ?></p>
                <h4 class="card-product__title" style="font-size:15px;" ><a href="single-product.php"><b><?php echo $r->product_name ?></b></a></h4>
                <p class="card-product__price" style="color:brown; font-size:16px;"><strong>New</strong>: <?php echo $currency . $r->price ?></p>
                <p><del style="color:red; font-size:13px;"><?php echo $r->old_price ?></del></p>
                <hr>
              </div>
            </div>
            </div>
           
            <?php
        }
        }
        }
       ?>
         </div>      
     </section>

     
          <!-- End seaching Seller -->



          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
          <div class="row filter_data">
         
             


          
              </div>
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
	<!-- ================ category section end ================= -->		  

  <style>
        #loading
        {
            text-align:center; 
            background: url('loader.gif') no-repeat center; 
            height: 150px;
        }
      </style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var catego = get_filter('catego');
        var brand = get_filter('brand');
       
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, catego:catego, brand:brand },
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:1,
        max:100000,
        values:[1, 100000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

    

});
</script>




 
	<!-- ================ top product area start ================= -->	
	
  <section class="section-margin calc-60px">
      <div class="container">
      <div class="section-intro pb-60px">
        <p>Popular Item in the market</p>
        <h2>Top <span class="section-intro__style">Product</span></h2>
      </div>

        <div class="row">

        <?php
          $i=0;
        
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query("SELECT * FROM products WHERE top_product = '2'");
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

           ?>

          <div class="col-md-6 col-lg-2 col-xl-2">
            <div class="card text-center card-product">
              <div class="card-product__img">
                <img class="card-img" src="productimages/<?php echo $obj->product_img_name ?>" alt="">
                <ul class="card-product__imgOverlay">

               <li><button><a href="view-product-view.php?viewid=<?php echo $obj->id ?>"><i class="ti-eye"></i> </a></button></li>
            
                <?php   
                if($obj->qty > 0){

                echo '<li><button><a href="add_to_cart/category_add.php?action=add&id='.$obj->id.'"><i class="ti-shopping-cart"></i></button></li>';
                }
                else {
                  echo '<strong style="color: red;">Out Of Stock!</strong>';
                }
                ?>
                  
                </ul>
              </div>
              <div class="card-body">
                 <p style="font-size:13px;"><strong>Units</strong>: <?php echo $obj->qty ?></p>
                <h4 class="card-product__title" style="font-size:15px;" ><a href="single-product.php"><b><?php echo $obj->product_name ?></b></a></h4>
                <p class="card-product__price" style="color:brown; font-size:16px;"><strong>New</strong>: <?php echo $currency . $obj->price ?></p>
                <p><del style="color:red; font-size:13px;"><?php echo $obj->old_price ?></del></p>
              </div>
            </div>
          </div>

           <?php

              $i++;
                }

              }

              $_SESSION['product_id'] = $product_id;

            ?>

        </div>
      </div>
    </section>
	<!-- ================ top product area end ================= -->		

	<!-- ================ Subscribe section start ================= -->		  
  <section class="subscribe-position">
    <div class="container">
      <div class="subscribe text-center">
        <h3 class="subscribe__title">Get Update From Anywhere</h3>
        <p>Bearing Void gathering light light his eavening unto dont afraid</p>
        <div id="mc_embed_signup">
          <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe-form form-inline mt-5 pt-1">
            <div class="form-group ml-sm-auto">
              <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" >
              <div class="info"></div>
            </div>
            <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
            <div style="position: absolute; left: -5000px;">
              <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
            </div>

          </form>
        </div>
        
      </div>
    </div>
  </section>
	<!-- ================ Subscribe section end ================= -->		  

<br><br><br><br><br>

  <?php require_once 'footer/footer.php'; ?>


  


  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/nouislider/nouislider.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>