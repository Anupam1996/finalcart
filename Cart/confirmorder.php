<?php
@ob_start();
/*session_start();*/
require '../connect/connect.php'
?>
<?php
$orderid='';
$trackingid='';
$output='';

if(isset($_POST['ORDER'])){
		$USERID=$_POST['USERID'];
		$FNAME=$_POST['FNAME'];
		$LNAME=$_POST['LNAME'];
		$EMAIL=$_POST['EMAIL'];
		$ADDRESS=$_POST['ADDRESS'];
		$CITY=$_POST['CITY'];
		$COUNTRY=$_POST['COUNTRY'];
		$PINCODE=$_POST['PIN'];
		$PHONE=$_POST['PHONE'];
		$PRICE=$_POST['PRICE'];
		$ORDERNOTES=$_POST['ORDERNOTES'];
		
	function uniquerandom($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
	}	
	
	$autoordervar=uniquerandom(0,100,5);
            $clength = count(uniquerandom(0,100,5));
            for($x = 0; $x < $clength; $x++) {
              $orderid=$orderid.$autoordervar[$x];
            }
			
			
			
			
			
			
		$sql=mysqli_query($db,"INSERT INTO confirmordering (orderno, fname, lname, email, userid, address, phonenumber, city, country, pincode, price,ordernotes)
VALUES ('$orderid','$FNAME','$LNAME','$EMAIL', '$USERID','$ADDRESS','$PHONE','$CITY','$COUNTRY','$PINCODE','$PRICE','$ORDERNOTES')");

		if($sql){
			$sql2=mysqli_query($db,"SELECT * FROM cart WHERE userid='$USERID'");
			$count=mysqli_num_rows($sql2);
			if($count==0)
			$output='failed';
			else{
				while($row=mysqli_fetch_array($sql2)){
					$trackingid='';
					$autotrackingvar=uniquerandom(0,100,5);
            $clength1 = count($autotrackingvar);
            for($x = 0; $x < $clength1; $x++) {
              $trackingid=$trackingid.$autotrackingvar[$x];
            }
					$productid=$row['productid'];
					$sql3=mysqli_query($db,"SELECT * FROM cart WHERE productid='$productid'");
					$row1=mysqli_fetch_array($sql3);
					$quantity=$row1['quantity'];
					$sql3=mysqli_query($db,"INSERT INTO confirmproduct (orderno, trackingid, userid, productid,quantity)
VALUES ('$orderid','$trackingid','$USERID','$productid','$quantity')");
					if($sql3)
					$output='success';
				}
			}
			
		}
		echo $output;
}
?>