<?php
@ob_start();
session_start();
require'../Connect/Connect.php';?>
<?php
if(isset($_POST["searchclk"]))
{
  $searchinput=$_POST["searchform"];
  header('Refresh: 1;url=Store?q='.$searchinput.'&&sorting=none');
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
function sorting($result){
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
	
	$output='';
		if(mysqli_num_rows($result) > 0){
			
			while($row = mysqli_fetch_array($result)){
	$output .= '
			<a  href="../Product/Product?v='.$row['id'].'"><div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product01.png" alt="">
										<div class="product-label">
											<span class="sale">-30%</span>
											<span class="new">NEW</span>
										</div>
									</div>
									<div class="product-body">
										<p class="product-category">Category</p>
										<h3 class="product-name"><a href="../Product/Product?v='.$row['id'].'">'.$row['product-name'].'</a></h3>
										<h4 class="product-price">Rs.'.$row['price'].' <del class="product-old-price">$980.00</del></h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div id="'.$ID.'" class="product-btns">
											<button id="'.$row['id'].'" style="outline:none;" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
											<button style="outline:none;" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
											<button style="outline:none;" class="quick-view"><i  class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
										</div>
									</div>
									<div id="'.$ID.'" class="add-to-cart">
										<button id="'.$row['id'].'" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
									</div>
								</div>
							</div></a>';
							
							
							
			}
        
        // Close result set
			//mysqli_free_result($result);
			
		}
		 	else{
        $output= "No records matching your query were found.";
		}
		
							
							return $output;
							
}

/*function category($result){
	$cat='';
	$i=1;
	$j=1;
	$k=1;
		if(mysqli_num_rows($result) > 0){
			
			while($row = mysqli_fetch_array($result)){
				
							if($row['subcategory']=='Laptops'){
								
							   $cat ='<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Laptops
										<small>('.$i.')</small>
									</label>
								</div>';
								$i++;	
							}
							else if($row['subcategory']=="Mobiles"){
								
							  $cat ='<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Mobiles
										<small>('.$j.')</small>
									</label>
								</div>';
								$j++;	;	
							}
							else if($row['subcategory']=='Clothing'){
								
							   $cat ='<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Clothing
										<small>('.$k.')</small>
									</label>
								</div>';
								$k++;	
							}
							else{
								$cat= 'failed';
							}
							
			}
			
			//mysqli_free_result($result);
			
		}
		
		else{
        $cat= 'failed';
		}
		
		return $cat;
		
}*/



?>
<?php
$output="";
$cat="";
$q="";
$price_min='';
$price_max='';
$pagination='';
$productperpage=5;
   
   if(isset($_GET['q']) && $_GET['q'] !== " " && $_GET['q'] !== "" && isset($_GET['sorting']) && $_GET['sorting'] !== ""){
	$searchq=isset($_GET['q']) ? $_GET['q'] : '';
	$searchq=strtolower($searchq);
	$_SESSION['searchq']=$searchq;
	$searchq1=explode(" ",$searchq);
	$newcount=count($searchq1);
	for($i=0;$i<$newcount;$i++){
		
	
	$sort=isset($_GET['sorting']) ? $_GET['sorting'] : '';
	$_SESSION['sort']=$sort;
	
	if($sort=='none'){
	  $sort='';	
	}
	else if($sort=='featured'){
      $sort='ORDER BY `test`.`featured` DESC';
	}
	else if($sort=='popularity'){
      $sort='ORDER BY `test`.`product-ratings` DESC';
	}
	else if($sort=='price_asc'){
      $sort='ORDER BY `test`.`price` ASC';
	}
	else if($sort=='price_desc'){
      $sort='ORDER BY `test`.`price` DESC';
	}
	else if($sort=='newest'){
      $sort='ORDER BY `test`.`timestamp` DESC';
	}
	else{
	  $sort='';	
	}

    
	$price_min=isset($_GET['price_min']) ? $_GET['price_min'] : '0';
	$_SESSION['price-min']=$price_min;
	$price_max=isset($_GET['price_max']) ? $_GET['price_max'] : '55000';
	$_SESSION['price-max']=$price_max;

    $j=$newcount-1;
	if(isset($_POST["showingpage"])){
		$productperpage=$_POST["showingpage"];
	}
	$search_per_page=$productperpage;
	$pagination_per_page=5;
	
	if(isset($_GET['page']) && !empty($_GET['page']))
			{
			    $page=$_GET['page'];	
				
			}
			
	else
		$page=1;
		$offset=($page-1)*$search_per_page;
		
			   	
			
	if(!empty($_POST["brand"])&&$i==$j)
	{
		foreach ($_POST["brand"] as $brand)
		{
/*   */
	$q =mysqli_query($db,"SELECT * FROM test  WHERE brand = '$brand' AND (price BETWEEN ".$price_min." AND ".$price_max.") AND  (`product-name` LIKE '%".$searchq1[$i]."%' OR category LIKE '%".$searchq1[$i]."%' OR subcategory LIKE '%".$searchq1[$i]."%' OR price LIKE '%".$searchq1[$i]."%' OR brand LIKE '%".$searchq1[$i]."%' )".$sort."");
			$counting=mysqli_num_rows($q);
			
			
			
			   $q =mysqli_query($db,"SELECT * FROM test  WHERE brand = '$brand' AND (price BETWEEN ".$price_min." AND ".$price_max.") AND  (`product-name` LIKE '%".$searchq1[$i]."%' OR category LIKE '%".$searchq1[$i]."%' OR subcategory LIKE '%".$searchq1[$i]."%' OR price LIKE '%".$searchq1[$i]."%' OR brand LIKE '%".$searchq1[$i]."%' )".$sort." LIMIT $search_per_page OFFSET $offset");
			   $c=mysqli_num_rows($q);
			   
		}
	}
	
	else{
		$q =mysqli_query($db,"SELECT * FROM test  WHERE price BETWEEN ".$price_min." AND ".$price_max." AND  (`product-name` LIKE '%".$searchq1[$i]."%' OR category LIKE '%".$searchq1[$i]."%' OR subcategory LIKE '%".$searchq1[$i]."%' OR price LIKE '%".$searchq1[$i]."%' OR brand LIKE '%".$searchq1[$i]."%' )".$sort."");
			$counting=mysqli_num_rows($q);
			
			   $q =mysqli_query($db,"SELECT * FROM test  WHERE price BETWEEN ".$price_min." AND ".$price_max." AND  (`product-name` LIKE '%".$searchq1[$i]."%' OR category LIKE '%".$searchq1[$i]."%' OR subcategory LIKE '%".$searchq1[$i]."%' OR price LIKE '%".$searchq1[$i]."%' OR brand LIKE '%".$searchq1[$i]."%' )".$sort." LIMIT $search_per_page OFFSET $offset");
			   $c=mysqli_num_rows($q);
	}
	}
	//end of for loop
	
	$totalpages=ceil($counting/$search_per_page);
	$totalpagination=ceil($totalpages/$pagination_per_page);
	
	 $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	 $actual_link =  explode('&&page', $actual_link);
	 $actual_link=$actual_link[0];
	
	if($c == 0){
		$output='<div class="product-card"><h1>No result found</h1></div>';  
	  }
	 
	  else
	  {
			$min_product=$page*$search_per_page-($search_per_page-1);
			$max_product=$min_product+($c-1);
			$pagination .='<span class="store-qty">Showing '.$min_product.'-'.$max_product.' products</span>'; 
			$pagination .='<ul class="store-pagination">';
		      $first=$page-1;
			  $last=$page+1;
			  $page_link=$totalpages-5;
			  if($page==1){
		      $pagination .='<li><a href=""><i class="fa fa-angle-left"></i></a></li>';
			  }
			   else{   
              $pagination .= '<li><a href="'.$actual_link.'&&page='.$first.'"><i class="fa fa-angle-left"></i></a></li>';
			  $pagination .='<li><a  href="">....</a></li>';
			   }
			   
			   if($page+5<=$totalpages)
			   $show=$page+4;
			   else
			   $show=$totalpages;
			   
			  for($i=$page;$i<=$show;$i++)
			  {
				  
				  
				  if($i==$page){
			      $pagination .='<li class="active">'.$i.'</a></li>';
			      }
				  
				  else if($i==$totalpages){	  
				  $pagination .='<li><a href="'.$actual_link.'&&page='.$i.'">'.$i.'</a></li>'; 
				  }
				  else{
				  $pagination .='<li><a  href="'.$actual_link.'&&page='.$i.'">'.$i.'</a></li>';
				  }
				  
				  
			  }
			  if($page==$totalpages){
			  $pagination .='<li><a href=""><i class="fa fa-angle-right"></i></a></li>';
			  }
			  else{	  
			  $pagination .='<li><a href="'.$actual_link.'&&page='.$last.'"><i class="fa fa-angle-right"></i></a></li>';
			  }
			  $pagination .='</ul>';
			
			
			   
			   
		    
		     if($sort== "ORDER BY `test`.`featured` DESC")
          	{	
				$output = sorting($q);
			}
	 		else if($sort== "`test`.`timestamp` DESC")
			{
				$output = sorting($q);
			}

			else if($sort == "`test`.`product-ratings` DESC")
			{
				$output = sorting($q);
			}
			else if($sort == "`test`.`price` ASC" || "`test`.`price` DESC" ){
				$output = sorting($q);
			}
			
		    	
			
			
	  }
	  
	  
   }
   else{
	$output= '<div class="product-card"><h1>Please enter something!</h1></div>';   
   }
   
   
   //mysqli_close($db);
?>
<!--category-->

<?php
$bag='';
$handbag='';
$laptop='';
$mobile='';
$clothing='';
$error='';

if(isset($_GET['q']) && $_GET['q'] !== " " && $_GET['q'] !== ""){
	
	$searchq=isset($_GET['q']) ? $_GET['q'] : '';
	$searchq=strtolower($searchq);
	$_SESSION['searchq']=$searchq;
	$searchq1=explode(" ",$searchq);
	$newcount=count($searchq1);
	for($i=0;$i<$newcount;$i++){
		
		$q =mysqli_query($db,"SELECT * FROM test  WHERE`product-name` LIKE '%".$searchq1[$i]."%' OR category LIKE '%".$searchq1[$i]."%' OR subcategory LIKE '%".$searchq1[$i]."%' OR price LIKE '%".$searchq1[$i]."%' OR brand LIKE '%".$searchq1[$i]."%' ");
	}
		$c=mysqli_num_rows($q);
		
		
		if($c > 0){
			$b=array();
			$a=array();
			while($row = mysqli_fetch_array($q)){
				          
						  array_push($b,strtolower($row['subcategory']));
						  
							
			}
			$count= count($b);
			$a=array_unique($b);
			//print_r(array_count_values($b));
			$no_count=array_count_values($b);
			//print_r($a);
			for($i=0;$i<$count;$i++){
				if(!array_key_exists($i,$a))
				continue;
				else{
					
					//echo $a[$i];
				    		if($a[$i]=='laptops'){
								
							   $laptop ='<div class="input-checkbox">
							        <input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Laptops
										<small>('.$no_count[$a[$i]].')</small>
									</label>
								</div>';
									
							}
							else if($a[$i]=="mobiles"){
							   
							  $mobile ='<div class="input-checkbox">
							       <input type="checkbox" id="category-2">
									<label for="category-2">
										<span></span>
										Mobiles
										<small>('.$no_count[$a[$i]].')</small>
									</label>
								</div>';
									
							}
							else if($a[$i]=='clothing'){
							   $clothing ='<div class="input-checkbox">
							   		<input type="checkbox" id="category-3">
									<label for="category-3">
										<span></span>
										Clothing
										<small>('.$no_count[$a[$i]].')</small>
									</label>
								</div>';
									
							}
							else if($a[$i]=='bags'){
								//echo $a[$i];
							   $bag ='<div class="input-checkbox">
							   		<input type="checkbox" id="category-4">
									<label for="category-4">
										<span></span>
										Bags
										<small>('.$no_count[$a[$i]].')</small>
									</label>
								</div>';
									
							}
							else if($a[$i]=='handbags'){
								//echo $a[$i];
							   $handbag ='<div class="input-checkbox">
							   		<input type="checkbox" id="category-5">
									<label for="category-5">
										<span></span>
										Handbags
										<small>('.$no_count[$a[$i]].')</small>
									</label>
								</div>';
									
							}
							else{
								$error= 'failed';
							}
				
				}
			}
			//mysqli_free_result($result);
			
		}
		
		else{
        $error= 'failed';
		}
		
	
	
}
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
						<li><a href="#" id="account"><i class="fa fa-user-o"></i> My Account</a></li>
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
                                            <h5>SHIPPING:Rs.<span id="shipping">40.00</span></h5>
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
							<li class="active">Headphones (227,490 Results)</li>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">
							    <?php echo $laptop; ?>
                                <?php echo $mobile; ?>
                                <?php echo $clothing; ?>
                                <?php echo $bag; ?>
                                <?php echo $handbag; ?>
                                <?php /*echo $error;*/ ?>
								<!--<div class="input-checkbox">
									<input type="checkbox" id="category-1">
									<label for="category-1">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-2">
									<label for="category-2">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-3">
									<label for="category-3">
										<span></span>
										Cameras
										<small>(1450)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-4">
									<label for="category-4">
										<span></span>
										Accessories
										<small>(578)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-5">
									<label for="category-5">
										<span></span>
										Laptops
										<small>(120)</small>
									</label>
								</div>

								<div class="input-checkbox">
									<input type="checkbox" id="category-6">
									<label for="category-6">
										<span></span>
										Smartphones
										<small>(740)</small>
									</label>
								</div>-->
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number" value="<?php echo $price_min;?>.00">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number" value="<?php echo $price_max;?>.00">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Brand</h3>
                            <form id="brandform" method="post">
							<div class="checkbox-filter">
								<div class="input-checkbox">
									<input type="checkbox" name="brand[]" value="samsung" id="brand-1">
									<label for="brand-1">
										<span></span>
										SAMSUNG
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" name="brand[]" value="lg" id="brand-2">
									<label for="brand-2">
										<span></span>
										LG
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" name="brand[]" value="sony" id="brand-3">
									<label for="brand-3">
										<span></span>
										SONY
										<small>(755)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" name="brand[]" value="redmi" id="brand-4">
									<label for="brand-4">
										<span></span>
										REDMI
										<small>(578)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" name="brand[]" value="dell" id="brand-5">
									<label for="brand-5">
										<span></span>
										DELL
										<small>(125)</small>
									</label>
								</div>
								<div class="input-checkbox">
									<input type="checkbox" name="brand[]" value="hp" id="brand-6">
									<label for="brand-6">
										<span></span>
										HP
										<small>(755)</small>
									</label>
								</div>
							</div>
                            </form>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="product-widget">
								<div class="product-img">
									<img src="../img/product01.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
							

							<div class="product-widget">
								<div class="product-img">
									<img src="../img/product02.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="../img/product03.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
								<form name="order">
									Sort By:
									<select  id="sorting" class="input-select" onchange="this.form.submit()">
										<option value="">Select</option>
										<option value="featured">Featured</option>
										<option value="price_asc">Low to high</option>
										<option value="price_desc">High to low</option>
										<option value="popularity">Popularity</option>
										<option value="newest">Newest</option>
									</select>
									</form>
								</label>

								<label>
                                <form id="showpagination" method="post">
									Show:
									<select id="showingpage" name="showingpage" class="input-select" onchange="this.form.submit()">
                                    	<option value="">Select</option>
										<option value="5">5</option>
										<option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
									</select>
                                    </form>
								</label>
							</div>
							<!--<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul> grid-list view-->
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row list-group">
                        
                        <?php print($output); ?>
						
							<!-- product --
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product01.png" alt="">
										<div class="product-label">
											<span class="sale">-30%</span>
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
							<!-- /product -->

							<!-- product --
							<div class="col-md-4 col-xs-6">
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
							<!-- /product --

							<div class="clearfix visible-sm visible-xs"></div>

							<!-- product --
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product03.png" alt="">
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
							<!-- /product --

							<div class="clearfix visible-lg visible-md"></div>

							<!-- product --
							<div class="col-md-4 col-xs-6">
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
							<!-- /product --

							<div class="clearfix visible-sm visible-xs"></div>

							<!-- product --
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product05.png" alt="">
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
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product06.png" alt="">
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
							<!-- /product --

							<div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>

							<!-- product --
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product07.png" alt="">
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
							<!-- /product -->

							<!-- product --
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product08.png" alt="">
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
							<!-- /product --

							<div class="clearfix visible-sm visible-xs"></div>

							<!-- product --
							<div class="col-md-4 col-xs-6">
								<div class="product">
									<div class="product-img">
										<img src="../img/product09.png" alt="">
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
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
                            <?php echo $pagination; ?>
							<!--<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>-->
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

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
        <div id="newq" style="display:none"></div>
        <div id="sortu" style="display:none"></div>
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
		$(document).ready(function(){
			
		var newq1="<?php echo $_SESSION['searchq']; ?>";
		var sortu="<?php echo $_SESSION['sort']; ?>";
        $("#newq").html(newq1);
		$("#sortu").html(sortu);
	 
        $("#brandform").on("change", "input:checkbox", function(){
        	$("#brandform").submit();
    	});
          //formsubmit();
		
  
$('#sorting').change(function() {
  $(this).closest('form').submit();
  var sel = document.getElementById('sorting');
  var opt = sel.options[sel.selectedIndex];
  //console.log(opt.value);
  var newq="<?php echo $_SESSION['searchq']; ?>";
  var price_min="<?php echo $_SESSION['price-min'] ?>";  
  var price_max="<?php echo $_SESSION['price-max']?>";
   
  if(price_min !=0 || price_max !=55000)
   window.location.href='../Store/Store?q='+newq+'&&sorting='+opt.value+'&&price_min='+price_min+'&&price_max='+price_max;
  //console.log(newq);
  //history.pushState({}, '', '/Store/Store?q='+newq+'&&sorting='+opt.value);
  else
  window.location.href='../Store/Store?q='+newq+'&&sorting='+opt.value;
  
});

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
	

});
</script>

	</body>
</html>
