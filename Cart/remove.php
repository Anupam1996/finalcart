<?php
@ob_start();
session_start();
require'../connect/connect.php';?>

<?php
if(isset($_POST["productid"])&&isset($_POST["userid"])){
	$ID=$_POST["userid"];
	$PRODUCTID=$_POST["productid"];
$sql="DELETE  FROM cart WHERE userid='$ID' AND productid='$PRODUCTID'";
$result=mysqli_query($db,$sql);
}
?>