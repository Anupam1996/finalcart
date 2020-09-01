<?php require '../Connect/Connect.php';?>
<?php

if(isset($_GET['pass']) && $_GET['pass'] !== " " && $_GET['pass'] !== "" && isset($_GET['email']) && $_GET['email'] !== " " && $_GET['email'] !== "")
{
	$email = $_GET["email"];
	$pass = $_GET["pass"];
	$email = mysqli_real_escape_string($db, $email);
	$CW = mysqli_real_escape_string($db,  $pass);
	
	$sql = "select * from user where email='$email' AND pass='$CW' ";
	$result= mysqli_query($db, $sql);
	
	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	
	session_start();
	
	$_SESSION["ID"] = mysqli_real_escape_string($db, $row['id']);
	$_SESSION["FNAME"] = mysqli_real_escape_string($db, $row['fname']);
	$_SESSION["LNAME"] = mysqli_real_escape_string($db, $row['lname']);
	$_SESSION["GENDER"] = mysqli_real_escape_string($db, $row['gender']);
	$_SESSION["PHONE"] = mysqli_real_escape_string($db, $row['phonenumber']);
	
	
	if($row)
	{
		    //session_unset();
            //session_destroy();
			header('Location: ../index');
		
	}
	
	
	
	else
	{		
	    
		//session_unset();
        //session_destroy();
		header('Location: ../index');
			
	}
	
	
	
	
	
	
}

?>