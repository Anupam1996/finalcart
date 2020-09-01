<?php
@ob_start();
session_start();
require'../connect/connect.php';?>
<?php
$num='';
$autoid='';
$output='';
$payable='';
if(isset($_POST['productid']) && $_POST['userid']){
$proid=$_POST['productid'];
$uid=$_POST['userid'];
function uniquerandom($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
function cartinsert($conn,$autoid, $userid, $id, $proname, $price, $quantity){
$sql2="INSERT INTO `cart` (autoid, userid, productid, productname, price, payable, quantity)
VALUES ('$autoid','$userid','$id','$proname','$price', '$price','$quantity')";
$result2=mysqli_query($conn,$sql2);
if($result2)
return 'product added to cart';
else
return 'Failed';


}



$sql="SELECT * FROM `test` WHERE id='$proid'";
		   $result=mysqli_query($db,$sql);
		   
		   
		       $row = mysqli_fetch_array($result,  MYSQLI_BOTH);
			
			
			
			$proid = mysqli_real_escape_string($db, $row['id']);
	$proname = mysqli_real_escape_string($db, $row['product-name']);
	$price = mysqli_real_escape_string($db, $row['price']);
	#$description = mysqli_real_escape_string($db, $row['description']);
	
#checking duplicate autoid and items
$autoidvar=uniquerandom(0,100,5);
            $clength = count(uniquerandom(0,100,5));
            for($x = 0; $x < $clength; $x++) {
              $autoid=$autoid.$autoidvar[$x];
            }

$quan=1;
$sql3=mysqli_query($db,"SELECT * FROM cart WHERE productid='$proid'");
if(mysqli_num_rows($sql3)==0){
$status=cartinsert($db,$autoid,$uid,$proid,$proname,$price,$quan);
echo $status;
}
else{
  echo 'Already added to cart';		
}

}
?>