<?php
@ob_start();
session_start();
require'../connect/connect.php';?>
<?php
$ID='';
$autoid='';
$PRODUCTID='';
$QUANTITY='';
$PAYABLE='';
if(isset($_POST['productid']) && isset($_POST['quantity'])&& isset($_POST['userid'])&&isset($_POST['payable'])){
	
	$ID=$_POST["userid"];
	$PRODUCTID=$_POST["productid"];
	$QUANTITY=$_POST["quantity"];
	$PAYABLE=$_POST["payable"];
$sql="SELECT * FROM cart WHERE userid='$ID' AND productid='$PRODUCTID'";
$result=mysqli_query($db,$sql);
$c=mysqli_num_rows($result);
	
	if($c == 0){
		$output='<div class="product-card"><h1>No product found!</h1></div>';  
	  }
	  else{
		 $row=mysqli_fetch_array($result);
		 
		 $sql2="UPDATE cart SET payable = '{$PAYABLE}', quantity = '{$QUANTITY}' where userid = '$ID' AND productid = '$PRODUCTID'";
		 $result2=mysqli_query($db,$sql2);
		 
		 if($result2)
		 echo 'Quantity has been changed';
		 else
		 echo 'failed';
		  
	  }
	
	
}

?>