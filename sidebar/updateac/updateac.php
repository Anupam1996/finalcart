<?php
require '../connect/connect.php';
?>
<?php
$error='';
$success='';
if(isset($_POST["UPDATE"])){
	$id=$_POST["ID"];
	$fname=$_POST["FNAME"];
	$lname=$_POST["LNAME"];
	$email=$_POST["EMAIL"];
	$phone=$_POST["PHONE"];
	$dob=$_POST["DOB"];
	
	$q=mysqli_query($db,"SELECT * FROM user WHERE id='$id' ");
	$count=mysqli_num_rows($q);
	
	if($count==1){
		$p=mysqli_query($db,"UPDATE user
	SET fname = '{$fname}', lname= '{$lname}',email= '{$email}', phonenumber= '{$phone}', dob= '{$dob}'
WHERE id='$id' ");
        if($p){
			$success="success";
		}
		else{
			$error='error';
		}
	}
	else{
		$error='error';
	}
	
	echo $success;
	
	echo $error;
	
	
}
?>