<?php
@ob_start();
session_start();
require'../connect/connect.php';?>

<?php
if(isset($_POST["UPDATE"])){
	$userid=$_POST["USERID"];
	/*$fname=$_POST["FNAME"];
	$lname=$_POST["LNAME"];
	$email=$_POST["EMAIL"];*/
	$address=$_POST["ADDRESS"];
	$city=$_POST["CITY"];
	$country=$_POST["COUNTRY"];
	$pincode=$_POST["PIN"];
	$phonenumber=$_POST["PHONE"];
	
	$sql=mysqli_query($db,"SELECT * FROM user WHERE id='$userid'");
	
	if(mysqli_num_rows($sql)==1){
	 $row=mysqli_fetch_array($sql);
	 /*if($row['city']==''||$row['country']==''||$row['pincode']==''||$row['address']==''){
		 
	 }*/
		$sql2 = mysqli_query($db,"UPDATE user SET address = '{$address}', city = '{$city}', country = '{$country}',pincode = '{$pincode}',phonenumber = '{$phonenumber}' where id ='$userid'");
		
		if($sql2)
		echo 'updated address';
		else
		echo 'failed';
	}
	
}
?>