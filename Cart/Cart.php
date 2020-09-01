<?php
@ob_start();
session_start();
require'../connect/connect.php';?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cart</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="../css/cart.css" rel="stylesheet" type="text/css"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="../js/cart.js"></script>
</head>

<body>

<header id="site-header">
        <div class="container">
            <h1>Shopping cart  <i class="fas fa-shopping-cart icon"></i> </h1>
        </div>
    </header>

    <div class="container">

        <section id="cart">
        	
            <!--<article class="product">
                <header>
                    <a class="remove">
                        <img src="http://www.astudio.si/preview/blockedwp/wp-content/uploads/2012/08/1.jpg" alt="">

                        <h3>Remove product</h3>
                    </a>
                </header>

                <div class="content">

                    <h1>Lorem ipsum</h1>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, numquam quis perspiciatis ea ad omnis provident laborum dolore in atque.

                    
                </div>

                <footer class="content">
                    <span class="qt-minus">-</span>
                    <span id="qt0" class="qt">2</span>
                    <span class="qt-plus">+</span>

                    <h2 class="full-price">
                        Rs.<span id="fullprice0">29.98</span>
                    </h2>

                    <h2 class="price">
                       Rs.<span id="price0">20.00</span>
                    </h2>
                </footer>
            </article>

            <article class="product">
                <header>
                    <a class="remove">
                        <img src="http://www.astudio.si/preview/blockedwp/wp-content/uploads/2012/08/3.jpg" alt="">

                        <h3>Remove product</h3>
                    </a>
                </header>

                <div class="content">

                    <h1>Lorem ipsum dolor</h1>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, numquam quis perspiciatis ea ad omnis provident laborum dolore in atque.

                    
                </div>

                <footer class="content">
                    
                    <span class="qt-minus">-</span>
                    <span id="qt1" class="qt">1</span>
                    <span class="qt-plus">+</span>

                    <h2 class="full-price">
                        Rs.<span id="fullprice1">79.99</span>
                    </h2>

                    <h2 class="price">
                        Rs.<span id="price1">10</span>
                    </h2>
                </footer>
            </article>

            <article class="product">
                <header>
                    <a class="remove">
                        <img src="http://www.astudio.si/preview/blockedwp/wp-content/uploads/2012/08/5.jpg" alt="">

                        <h3>Remove product</h3>
                    </a>
                </header>

                <div class="content">

                    <h1>Lorem ipsum dolor ipsdu</h1>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, numquam quis perspiciatis ea ad omnis provident laborum dolore in atque.

                    
                </div>

                <footer class="content">
                    
                    <span class="qt-minus">-</span>
                    <span id="qt2" class="qt">3</span>
                    <span class="qt-plus">+</span>

                    <h2 class="full-price">
                        Rs.<span id="fullprice2">53.99</span>
                    </h2>

                    <h2 class="price">
                        Rs.<span id="price2">17.99</span>
                    </h2>
                </footer>
            </article>-->

        </section>

    </div>
	<div id="userid" style="display:none"><?php echo $_SESSION["ID"]; ?></div>
    <footer id="site-footer">
        <div class="container clearfix">

            <div class="left">
                <h2 class="subtotal">Subtotal: Rs.<span>163.96</span></h2>
                <h3 class="tax">Taxes (5%): Rs.<span>8.2</span></h3>
                <h3 class="shipping">Shipping: Rs.<span>5.00</span></h3>
            </div>

            <div class="right">
                <h1 class="total">Total: Rs.<span>177.16</span></h1>
                <a id="checkoutbtn" style="color:white;"class="btn">Checkout</a>
            </div>

        </div>
    </footer>
    
 
</body>
</html>