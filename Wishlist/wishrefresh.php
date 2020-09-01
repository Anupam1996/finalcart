<?php
@ob_start();
session_start();
require'../connect/connect.php';?>
<?php
if(isset($_POST["userid"])){
	$ID=$_POST["userid"];
$sql="SELECT * FROM wishlist WHERE userid='$ID'";
$result=mysqli_query($db,$sql);
$c=mysqli_num_rows($result);
echo $c;
}
?>