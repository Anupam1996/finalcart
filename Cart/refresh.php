<?php
@ob_start();
session_start();
require'../connect/connect.php';?>
<?php
$output='';
if(isset($_POST["userid"])){
	$ID=$_POST["userid"];
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
				
				$output .='   <article class="product">
                <header>
                    <a class="remove">
                        <img src="../img/product08.png" alt="">
						<div style="display:none" id="productid'.$i.'">'.$productid.'</div>
						<p style="display:none" id="userid'.$i.'">'.$ID.'</p>
                        <h3>Remove product</h3>
                    </a>
                </header>

                <div class="content">

                    <h1>'.$name.'</h1>

                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, numquam quis perspiciatis ea ad omnis provident laborum dolore in atque.

                    
                </div>
				
                <footer class="content">
                    
                    <span class="qt-minus">-</span>
                    <span id="qt'.$i.'" class="qt">'.$quantity.'</span>
                    <span class="qt-plus">+</span>

                    <h2 class="full-price">
                        Rs.<span id="fullprice'.$i.'">'.$payable.'</span>
                    </h2>

                    <h2 class="price">
                        Rs.<span id="price'.$i.'">'.$price.'</span>
                    </h2>
                </footer>
            </article>';
			$i++;
		  }
	  }
	  print($output);
}
?>