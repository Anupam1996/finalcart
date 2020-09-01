<?php
@ob_start();
session_start();
require'../Connect/Connect.php';?>

<?php
if(isset($_POST["searchclk"]))
{
  $searchinput=$_POST["searchform"];
  header('Refresh: 1;url=../Store/Store?q='.$searchinput.'&&sorting=none');
}
?>
<?php
if(isset($_SESSION["ID"])){
	$ID=$_SESSION["ID"];
	$NAME=$_SESSION["FNAME"]." ".$_SESSION["LNAME"];
	$GENDER=$_SESSION["GENDER"];
	$PHONE=$_SESSION["PHONE"];
  }
	
	else
	{
		$ID='';
		$NAME='';
		$GENDER='';
		$PHONE='';
	}
?>
<?php
$output="";
$q="";
$name='';
$price='';
$id1='';

   
   if(isset($_GET['v']) && $_GET['v'] !== " " && $_GET['v'] !== ""){
	   
	$similarq=$_GET['v'];
	$similarq=strtolower($similarq);
	
	
	$q =mysqli_query($db,"SELECT * FROM `test` WHERE `id` LIKE '%".$similarq."%'");
	
	$c=mysqli_num_rows($q);
	
	if($c == 0){
		$output='<div class="product-card"><h1>No result found</h1></div>';  
	  }
	  else{
		  $row=mysqli_fetch_array($q);
			$name=$row['product-name'];
			$price=$row['price'];
			$subcategory=$row['subcategory'];
			$productname=$name;
			$id1=$row['id'];
#$data=array();
#array_push($data,$productname);
#$myfile='test.json';
#$handle=fopen($myfile,'w');
#$json=json_encode($data);
#fwrite($handle,$json);
$exec=shell_exec('python recommend.py ' . $subcategory);
#$exec=passthru('python recommend.py 1 2>&1');
#$myfile1='written.json';
#$handle1=fopen($myfile1,'r');
#$d=fread($handle1,filesize($myfile1));
$decode=json_decode($exec);
$count=count($decode);
if($count==0){
	$output='<div class="product-card"><h1>No similar product found</h1></div>';
}

else{
  for($i=0;$i<$count;$i++){
	  
	$q1 =mysqli_query($db,"SELECT * FROM `test` WHERE id=".$decode[$i]." ");
	while($row1=mysqli_fetch_array($q1)){
			$name1=$row1['product-name'];
			$price1=$row1['price'];
			$id=$row1['id'];
	
#echo $decode[1];
			$output .= '
			<a  href="../Product/Product?v='.$id.'"><div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="../img/product01.png" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="../Product/Product?v='.$id.'">'.$name1.'</a></h3>
								<h4 class="product-price">'.$price1.' <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div id="'.$ID.'" class="product-btns">
									<button id="'.$id.'" style="outline:none;" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button style="outline:none;" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button style="outline:none;" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div id="'.$ID.'" class="add-to-cart">
								<button id="'.$id.'" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div></a>';
	}
	
 }
	
}
		  }
	  }
	  
	  
   
   
   
   
   mysqli_close($db);
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Ecommerce</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="../css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="../css/slick2.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="../css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="../css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </head>
	<body>
    
      <!--login-->
    <div class="bg-modal" id="mylogin">
    <div class="box">
    <p class="closed"><a href="#" id="loginclose">+</a></p>
    <form  id="logdef" action="" method="post">
  <h1>Login</h1>
  <input type="email" id="logemail" required placeholder="Email">
  <input type="password" id="logpass" required placeholder="Password">
  <button id="logsubmit" name="submit">Login</button>
</form>
   <p style="cursor:pointer"><a href="#" id="forgot">Forgot password?</a></p><br>
   <p>Don't have a account?<a href="#" id="register">Register Here</a></p>
   </div>

  </div>   
  <!--register-->
  
   <div class="bg-modal" id="myregister">
    <div class="box">
    <p class="closed"><a href="#" id="registerclose">+</a></p>
    <form id="regdef" method="post">
  <h1>Register</h1>
  <span class="cr" id="errorn"></span>
  <span class="cr" id="error"></span>
  <span class="cr" id="success"></span>
  <input type="text" name="fname" id="fname" placeholder="First Name" required>
  <input type="text" name="lname" id="lname" placeholder="Last Name" required>
  <input type="email" name="email" id="email" placeholder="Email" required>
  <span class="cr" id="emailexist"></span>
  <input type="password" name="pass" id="pass" placeholder="Password" autocomplete="off" required>
  <input type="password" name="confirmpass" id="confirmpass" placeholder="Confirm Password" autocomplete="off" required>
  <button id="regsubmit">Register</button>
</form>
   <br>
   <p>Have a account?<a href="#" id="login">Login Here</a></p>
   </div>

  </div>
  
  <!--confirmotp-->
  
   <div class="bg-modal" id="myconfirm">
    <div class="box">
    <p class="closed"><a href="#" id="confirmclose">+</a></p>
    <form id="condef" method="post">
  <h1>Confirm OTP</h1>
  <span id="error"></span>
  <span id="success"></span>
  <input type="text" name="otp" id="otp" placeholder="Enter OTP">
  <span id="emailexist"></span>
  <span id="emailnf"></span>
  <button id="confirmsubmit">Confirm</button>
</form>
   
   </div>

  </div>
  <!--forgot-->
   <div class="bg-modal" id="myforgot">
    <div class="box">
    <p class="closed"><a href="#" id="forgotclose">+</a></p>
    <form id="fordef" action="" method="post">
  <h1>Forgot Password?</h1>
  <input type="email" name="" placeholder="Email">
  <button id="forgetsubmit" name="submit">Send</button>
</form>
   <p><a href="#" id="loginnew">Login Here</a></p>
   </div>

  </div>
  
		<!-- HEADER -->
		<header>
						<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-right">
						<li><a href="#" id="account"><i class="fa fa-user-o"></i></a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="../index" class="logo">
									<img height="120"  src="../img/sabshop2.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="" method="post">

									<div id="inputwithimg">
									<input id="searchform" name="searchform" class="input" placeholder="Search here">
                                    <img id="searchimg" src="../img/mic.png" />
									<button id="searchclk" name="searchclk" class="search-btn">Search</button>
                                    </div>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div id="countwishlist" class="qty">2</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><span class="cartcount"></span></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
                                        <div id="userid" style="display:none"><?php echo $ID; ?></div>
											<!--<div id="prowi0" class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>Rs.<span id="payable0" class="payable">200.00</span></h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div id="prowi1" class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>Rs.<span id="payable1" class="payable">100.00</span></h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>-->
										</div>
										<div class="cart-summary">
											<small><span class="cartcount"></span> Item(s) selected</small>
											<h5>SUBTOTAL: Rs.<span id="subtotal">2940.00</span></h5>
                                            <h5>SHIPPING: Rs.<span id="shipping">40.00</span></h5>
                                            <h5>TOTAL: Rs.<span id="total">3000.00</span></h5>
										</div>
										<div class="cart-btns">
											<a href="../Cart/Cart">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#">Hot Deals</a></li>
						<li><a href="#">Categories</a></li>
						<li><a href="#">Laptops</a></li>
						<li><a href="#">Smartphones</a></li>
						<li><a href="#">Cameras</a></li>
						<li><a href="#">Accessories</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li><a href="#">Headphones</a></li>
							<li class="active"><?php echo $name; ?></li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="../img/product01.png" alt="">
							</div>

							<div class="product-preview">
								<img src="../img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="../img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="../img/product08.png" alt="">
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="../img/product01.png" alt="">
							</div>

							<div class="product-preview">
								<img src="../img/product03.png" alt="">
							</div>

							<div class="product-preview">
								<img src="../img/product06.png" alt="">
							</div>

							<div class="product-preview">
								<img src="../img/product08.png" alt="">
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $name; ?></h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price"><?php echo $price; ?> <del class="product-old-price">$990.00</del></h3>
								<span class="product-available">In Stock</span>
							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

							<div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option value="0">X</option>
									</select>
								</label>
								<label>
									Color
									<select class="input-select">
										<option value="0">Red</option>
									</select>
								</label>
							</div>

							<div id="<?php echo $ID; ?>" class="add-to-cart">
								<!--<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>-->
								<button id="<?php echo $id1; ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>

							<ul id="<?php echo $ID; ?>" class="product-btns">
								<li id="<?php echo $id1; ?>" class="addtowishlist"><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">Headphones</a></li>
								<li><a href="#">Accessories</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input class="input" type="text" placeholder="Your Name">
													<input class="input" type="email" placeholder="Your Email">
													<textarea class="input" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>
                    <?php print($output); ?>
					<!-- product --
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="../img/product01.png" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<!-- product --
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="../img/product02.png" alt="">
								<div class="product-label">
									<span class="new">NEW</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product --

					<div class="clearfix visible-sm visible-xs"></div>

					<!-- product --
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="../img/product03.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

					<!-- product --
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="../img/product04.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
						</div>
					</div>
					<!-- /product -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>

						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/slick.min.js"></script>
		<script src="../js/nouislider.min.js"></script>
		<script src="../js/jquery.zoom.min.js"></script>
		<script src="../js/main.js"></script>
        <script src="../js/logreg.js"></script>
        <script src="../js/formsub.js"></script>
        <script src="../js/confirm.js"></script>
        <script src="../js/login.js"></script>
        <script src="../js/cart2.js"></script>
        <script src="../js/addtocart.js"></script>
        <script src="../js/voicerecog.js"></script>
        <script src="../js/wishlist.js"></script>
<script>
	var id="<?php echo $ID; ?>";
   var name="<?php echo $NAME; ?>";
   
    function showlogin(id){
	   if(id != ''){
		 //alert('already logined');
		 window.location.href="../sidebar/myac";
	   }
	   else{
	     $("body").addClass("modal-open");
         $("#mylogin").fadeIn(500);
	   } 	
		
	}
	
	function loadlogin(id){
	   if(id != ''){
		 $("#account").html('<i class="fa fa-user-o"></i> Hi, '+name);
	   }
	   else{
		 $("#account").html('<i class="fa fa-user-o"></i> My Account');
	   } 	
		
	}
	
	loadlogin(id);
	
      $("#account").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	var id="<?php echo $ID; ?>";
	showlogin(id);
	
    });
</script>
	</body>
</html>
