<?php require '../Connect/Connect.php';?>
<?php
$registered = '';
$userexist = '';
$emailexist = '';
$msg = '';
$emailsend = '';
$emailfailed = '';
$errorinput = '';
$Emailnotmatched = '';
$Emailmatched = '';
$loginsc='';
$wronglogin='';

if(isset($_POST["Login"]))
{
	$Email = $_POST["email"];
	$CW = $_POST["pass"];
	
	$Email = mysqli_real_escape_string($db, $Email);
	$CW = mysqli_real_escape_string($db,  $CW);
	$CW = md5($CW);
	
	$sql = "select * from user where email ='$Email' AND pass ='$CW'";
	$result= mysqli_query($db, $sql);
	
	$row = mysqli_fetch_array($result, MYSQLI_BOTH);
	
	
	
	$ID = mysqli_real_escape_string($db, $row['id']);
	/*$_SESSION["Fname"] = mysqli_real_escape_string($db, $row['Fname']);
	$_SESSION["Lname"] = mysqli_real_escape_string($db, $row['Lname']);
	$_SESSION["Email"] = mysqli_real_escape_string($db, $row['Email']);
	$_SESSION["Username"] = mysqli_real_escape_string($db, $row['Username']);
	$_SESSION["ProfileImage"] = mysqli_real_escape_string($db, $row['ProfileImage']);
	$_SESSION["Phone_Number"] = mysqli_real_escape_string($db, $row['Phone_Number']);
	$_SESSION["Password"] = mysqli_real_escape_string($db, $row['Password']);
	$_SESSION["Confirm_Password"] = mysqli_real_escape_string($db, $row['Confirm_Password']);*/
	
	
    	
	if($row)
	{
		
	$session="session";	
		/*header('Refresh: 3;url=../Main/Main');*/
	$loginsc='<div class="alert alert-success alert-dismissible"><span style="color:#093;"><i class="fa fa-check" aria-hidden="true"></i> Login successful...</span></div>';
		
	}
	
	
	
	else
	{		
	 $session="";	
     $wronglogin='<div class="alert alert-danger alert-dismissible"><span style="color:#C00;"><i class="fa fa-times" aria-hidden="true"></i> Login unsuccessful! Check your email and password</span></div>';
			
	}
	
	
	

$data=array(
   'error' => $wronglogin,
   'email' => $Email,
   'success' =>$loginsc,
   'session' => $session,
   'pass' => $CW
);

echo json_encode($data);




}
?>