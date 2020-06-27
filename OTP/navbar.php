 <!--================ Start Header Menu Area =================-->
 <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
        <a class="navbar-brand logo_h" href="home.php"><h3><img src="img/Fevicon.png" style="heigth:50px; width:50px;" alt=""> <span> PROJECT SHOP</span></h3> </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item active"><a class="nav-link" href="../home.php">Home</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Shop</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="../category.php">Shop Category</a></li>
                  <li class="nav-item"><a class="nav-link" href="../cart.php">Shopping Cart</a></li>
                  <li class="nav-item"><a class="nav-link" href="../myorders.php">My Orders</a></li>
                 
               
                </ul>
			</li>
             
							
              <li class="nav-item"><a class="nav-link" href="../contact.php">Contact</a></li>
            </ul>

            <ul class="nav-shop">
              <?php

              if(!empty($_SESSION["cart"])) {
                $cart_count = count(array_keys($_SESSION["cart"]));
              
              echo ' <li class="nav-item"><strong><button> <a href="../cart.php"><i class="ti-shopping-cart" style="font-size:30px"></i><span class="nav-shop__circle" style="font-size:11px">'.$cart_count.'</span> </button></strong></li>';

                }
                
                else {
                  echo ' <li class="nav-item"><strong><button> <a href="../cart.php"><i class="ti-shopping-cart" style="font-size:30px"></i><span class="nav-shop__circle" style="font-size:11px">0</span> </button></strong></li>';
                }
                
                ?>

             <li class="nav-item"><a class="button button-header" href="../auth/logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->