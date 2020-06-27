<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'functions/config.php';
require_once 'functions/dbconnect.php';

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
  <title>Home</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="vendors/nice-select/nice-select.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="css/stylesstages.css">
</head>
<body>
 
 <?php require_once 'navbar.php';?>

  <main class="site-main">
    
    <!--================ Hero banner start =================-->
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
              <h3>Browse Our Premium Product</h3>
             <center> <a class="button button-hero" href="category.php">Browse Now</a></center>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <section class="section-margin mt-0">
      <div class="owl-carousel owl-theme hero-carousel">
      
          <div class="hero-carousel__slide">
          <img src="img/home/hero-slide1.png" alt="" class="img-fluid">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>Best Sellers</h3>
         
         </a>
        </div>

        <div class="hero-carousel__slide">
          <img src="img/home/hero-slide2.png" alt="" class="img-fluid">
          <a href="#best" class="hero-carousel__slideOverlay">
            <h3>Trending</h3>
           
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="img/home/hero-slide3.png" alt="" class="img-fluid">
          <a href="#" class="hero-carousel__slideOverlay">
            <h3>On Shop Now</h3>
            
          </a>
        </div>
      </div>
    </section>
    <!--================ Hero Carousel end =================-->

    <!-- ================ trending product section start ================= -->  
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Item in the market</p>
          <h2>Trending <span class="section-intro__style">Product</span></h2>
        </div>

        <div class="row">

        <?php
          $i=0;
        
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query("SELECT * FROM products ORDER BY id DESC");
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

           ?>

          <div class="col-md-6 col-lg-3 col-xl-2">
            <div class="card text-center card-product">
              <div class="card-product__img">
                <img class="card-img" src="productimages/<?php echo $obj->product_img_name ?>" alt="">
                <ul class="card-product__imgOverlay">

               <li><button><a href="view-product.php?viewid=<?php echo $obj->id ?>"><i class="ti-eye"></i> </a></button></li>
            
                <?php   
                if($obj->qty > 0){

                echo '<li><button class="btn-round"><a href="add_to_cart/home_add.php?action=add&id='.$obj->id.'"><i class="ti-shopping-cart"></i></button></li>';
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
    <!-- ================ trending product section end ================= -->  


    <!-- ================ offer section start ================= --> 
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center">
              <h3>Up To 50% Off</h3>
              <h4>Winter Sale</h4>
              <p>Him she'd let them sixth saw light</p>
              <a class="button button--active mt-3 mt-xl-4" href="category.php">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ offer section end ================= --> 

    <!-- ================ Best Selling item  carousel ================= --> 
 

    <section class="section-margin calc-60px" id="best">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Item in the market</p>
          <h2>Best <span class="section-intro__style">Sellers</span></h2>
        </div>  


        <div class="row">

        <?php
          $i=0;
        
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query("SELECT * FROM products WHERE best_sell_product = '3'");
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

               <li><button><a href="view-product.php?viewid=<?php echo $obj->id ?>"><i class="ti-eye"></i> </a></button></li>
            
                <?php   
                if($obj->qty > 0){

                echo '<li><button class="btn-round"><a href="add_to_cart/home_add.php?action=add&id='.$obj->id.'"><i class="ti-shopping-cart"></i></button></li>';
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
    <!-- ================ Best Selling item  carousel end ================= --> 

    <!-- ================ Blog section start ================= -->  
   
   <!------
    <section class="blog">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Item in the market</p>
          <h2>Latest <span class="section-intro__style">News</span></h2>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-blog">
              <div class="card-blog__img">
                <img class="card-img rounded-0" src="img/blog/blog1.png" alt="">
              </div>
              <div class="card-body">
                <ul class="card-blog__info">
                  <li><a href="#">By Admin</a></li>
                  <li><a href="#"><i class="ti-comments-smiley"></i> 2 Comments</a></li>
                </ul>
                <h4 class="card-blog__title"><a href="single-blog.php">The Richland Center Shooping News and weekly shooper</a></h4>
                <p>Let one fifth i bring fly to divided face for bearing divide unto seed. Winged divided light Forth.</p>
                <a class="card-blog__link" href="#">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-blog">
              <div class="card-blog__img">
                <img class="card-img rounded-0" src="img/blog/blog2.png" alt="">
              </div>
              <div class="card-body">
                <ul class="card-blog__info">
                  <li><a href="#">By Admin</a></li>
                  <li><a href="#"><i class="ti-comments-smiley"></i> 2 Comments</a></li>
                </ul>
                <h4 class="card-blog__title"><a href="single-blog.php">The Shopping News also offers top-quality printing services</a></h4>
                <p>Let one fifth i bring fly to divided face for bearing divide unto seed. Winged divided light Forth.</p>
                <a class="card-blog__link" href="#">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-blog">
              <div class="card-blog__img">
                <img class="card-img rounded-0" src="img/blog/blog3.png" alt="">
              </div>
              <div class="card-body">
                <ul class="card-blog__info">
                  <li><a href="#">By Admin</a></li>
                  <li><a href="#"><i class="ti-comments-smiley"></i> 2 Comments</a></li>
                </ul>
                <h4 class="card-blog__title"><a href="single-blog.php">Professional design staff and efficient equipment you’ll find we offer</a></h4>
                <p>Let one fifth i bring fly to divided face for bearing divide unto seed. Winged divided light Forth.</p>
                <a class="card-blog__link" href="#">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->  
    <!-- ================ Blog section end ================= -->  

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

    

  </main>
  <br><br><br><br><br><br>

  <?php require_once 'footer/footer.php'; ?>



  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/skrollr.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="vendors/nice-select/jquery.nice-select.min.js"></script>
  <script src="vendors/jquery.ajaxchimp.min.js"></script>
  <script src="vendors/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>