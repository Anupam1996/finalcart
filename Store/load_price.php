<?php
if(isset($_POST["searched"])){
	$search=$_POST["searched"];
	if($search != '')
	   echo 'success';
	else
	   echo 'fail';
	
}

?>