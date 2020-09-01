<?php
@ob_start();
session_start();
require'../connect/connect.php';?>

<?php
if(isset($_POST['productid']) && $_POST['userid']){
	$proid=$_POST['productid'];
	$uid=$_POST['userid'];
	
	$sql=mysqli_query($db,"SELECT * FROM test WHERE id='$proid'");
	$count=mysqli_num_rows($sql);
	if($count==1){
		$row=mysqli_fetch_array($sql);
		$productname=$row['product-name'];
		$price=$row['price'];
		$sql3=mysqli_query($db,"SELECT * FROM wishlist WHERE productid='$proid'");
		if(mysqli_num_rows($sql3)==0)
		{
			$sql2=mysqli_query($db,"INSERT INTO wishlist (productid, userid, productname, price)
VALUES ('$proid','$uid','$productname','$price')");
			if($sql2)
			echo 'Product added to wishlist';
			else
			echo 'Failed to add';
		}
		else
		echo 'Already added to wishlist';
	}

}

?>