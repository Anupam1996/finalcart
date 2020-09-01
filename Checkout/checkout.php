<?php
@ob_start();
session_start();
require'../connect/connect.php';?>


<?php
$output='';
if(isset($_SESSION["ID"])){
	$ID=$_SESSION["ID"];
$sql="SELECT * FROM cart WHERE userid='$ID'";
$result=mysqli_query($db,$sql);
$c=mysqli_num_rows($result);
	
	if($c == 0){
		$output='<div class="product-card"><h1>Cart is empty!</h1></div>';  
	  }
	  else{
		  $i=0;
		  while($row=mysqli_fetch_array($result)){ 
		  		$name=$row['productname'];
				$price=$row['price'];
				$productid=$row['productid'];
				$quantity=$row['quantity'];
				$payable=$row['payable'];
			$output .='<div id="order-col" class="order-col">
									<div>'.$quantity.'x '.$name.'</div>
									<div style="display:none" id="orderproductid">'.$productid.'</div>
									<div id="totalprice'.$i.'">Rs.<span>'.$payable.'</span></div>
								</div>';
							
				$i++;
		  }
	  }
	  
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
$fname='';
$lname='';
$email='';
$address='';
$city='';
$country='';
$pincode='';
$phonenumber='';

if(isset($_SESSION["ID"])){
	$sql2=mysqli_query($db,"SELECT * FROM user WHERE id='$ID'");
	
	if(mysqli_num_rows($sql2)==1){
	 $row=mysqli_fetch_array($sql2);
	$fname=$row["fname"];
	$lname=$row["lname"];
	$email=$row["email"];
	$address=$row["address"];
	$city=$row["city"];
	$country=$row["country"];
	$pincode=$row["pincode"];
	$phonenumber=$row["phonenumber"];
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

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

						

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
							

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
                <form style="display:none" id="afterbtnclick" action="../Cart/pay" method="post">
    			<input type="text" name="buyername" id="buyername" value="<?php echo $fname.' '.$lname; ?>" readonly>
    			<input type="text" name="email" id="email" value="<?php echo $email;?>" readonly>
    			<input type="tel" name="phone" id="phone" value="<?php echo $phonenumber; ?>" readonly>
    			<input id="totalpricecheck" type="text" name="totalprice" readonly>
    			</form>
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Shipping address</h3>
							</div>
                            <form id="updateaddress" method="post">
							<div class="form-group">
								<input id="updatefname" class="input" type="text" name="first-name" placeholder="First Name" value="<?php echo $fname;?>" required>
							</div>
							<div class="form-group">
								<input id="updatelname" class="input" type="text" name="last-name" placeholder="Last Name" value="<?php echo $lname;?>" required>
							</div>
							<div class="form-group">
								<input id="updateemail" class="input" type="email" name="email" placeholder="Email" value="<?php echo $email;?>" required>
							</div>
							<div class="form-group">
								<input id="updateadd" class="input" type="text" name="address" placeholder="Address" value="<?php echo $address;?>" required>
							</div>
							<div class="form-group">
								<input id="updatecity" class="input" type="text" name="city" placeholder="City" value="<?php echo $city;?>" required>
							</div>
							<div class="form-group">
								<input id="updatecountry" class="input" type="text" name="country" placeholder="Country" value="<?php echo $country;?>" required>
							</div>
							<div class="form-group">
								<input id="updatepin"  class="input" type="text" name="zip-code" placeholder="ZIP Code" value="<?php echo $pincode;?>" required>
							</div>
							<div class="form-group">
								<input id="updatephone" class="input" type="tel" name="tel" placeholder="Telephone" value="<?php echo $phonenumber;?>" required>
							</div>
                            
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" name="chk[]" id="create-account">
									<label for="create-account">
										<span></span>
										Update address?
									</label>
									<!--<div class="caption">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>-->
								</div>
							</div>
                            </form>
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details --
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Shiping address</h3>
							</div>
							<div class="input-checkbox">
								<input name="shpadr[]" type="checkbox" id="shiping-address">
								<label for="shiping-address">
									<span></span>
									Ship to a different address?
								</label>
								<div class="caption">
                                <form id="shippingaddress" method="post">
									<div class="form-group">
										<input class="input" type="text" name="first-name" placeholder="First Name">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="last-name" placeholder="Last Name">
									</div>
									<div class="form-group">
										<input class="input" type="email" name="email" placeholder="Email">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="address" placeholder="Address">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="city" placeholder="City">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="country" placeholder="Country">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="zip-code" placeholder="ZIP Code">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="tel" placeholder="Telephone">
									</div>
                                    </form>
								</div>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
                        <form  method="post">
						<div class="order-notes">
							<textarea id="ordernotes" class="input" placeholder="Order Notes"></textarea>
						</div>
                        </form>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
                            <?php print($output);?>
								<!--<div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>-->
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div id="shipping">Rs. <span></span></div>
							</div>
                            <div class="order-col">
								<div>Tax(5%)</div>
								<div id="tax">Rs. <span></span></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong id="total" class="order-total">Rs. <span>2940.00</span></strong></div>
							</div>
						</div>
						<!--<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>-->
						<div class="input-checkbox">
							<input name="terms[]" type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="#" id="placeorder" class="primary-btn order-submit">Proceed to payment</a>
					</div>
					<!-- /Order Details -->
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
            <div id="userid" style="display:none"><?php echo $_SESSION["ID"]; ?></div>
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
        <script src="../js/checkout.js"></script>
        
        <script>
		$(document).ready(function(){
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
