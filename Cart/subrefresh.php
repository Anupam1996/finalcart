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
				$price=$row['payable'];
				$productid=$row['productid'];
				$quantity=$row['quantity'];
				
				$output .='   <div id="prowi'.$i.'" class="product-widget">
												<div class="product-img">
													<img src="../img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">'.$name.'</a></h3>
													<h4 class="product-price"><span class="qty">'.$quantity.'x</span>Rs.<span id="payable'.$i.'" class="payable">'.$price.'.00</span></h4>
												</div>
												<div style="display:none" class="productabc" id="productid'.$i.'">'.$productid.'</div>
												
											</div>
';
			$i++;
		  }
	  }
	  print($output);
}
?>