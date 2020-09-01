<?php require '../Connect/Connect.php';?>

<?php 
$emailexist='';
$emailnotfound='';
$error='';
$success='';
$errorn='';
$name='';
$Email='';
$Password='';
$CW='';
$query='';




if(isset($_POST["Register"]))
{
	
if(empty($_POST["fname"])){
	$errorn .='<div class="alert alert-danger">First Name is required.</div>';
}
else
{
	$fname= $_POST["fname"];
}

if(empty($_POST["lname"])){
	$errorn .='<div class="alert alert-danger">Last Name is required.</div>';
}
else
{
	$lname= $_POST["lname"];
}


//$Lname = $_POST["Lname"];
//$Username = $_POST["Username"];
//$Gender = $_POST["Gender"];
if(empty($_POST["pass"])){
	$errorn .='<div class="alert alert-danger">Password is required.</div>';
}
else
{
	$Password= $_POST["pass"];
}

if(empty($_POST["confirmpass"])){
	$errorn.='<div class="alert alert-danger">Confirm password is required.</div>';
}
else
{
	$CW= $_POST["confirmpass"];
}
//$defaultpic="default.png";


$fname = mysqli_real_escape_string($db, $fname);
$lname = mysqli_real_escape_string($db, $lname);
//$Lname = mysqli_real_escape_string($db, $Lname);
//$Username = mysqli_real_escape_string($db, $Username);

//$Gender = mysqli_real_escape_string($db, $Gender);
$Password = mysqli_real_escape_string($db, $Password);
$CW = mysqli_real_escape_string($db,  $CW);
//$defaultpic=mysqli_real_escape_string($db,  $defaultpic);
$Password = md5($Password);
$CW = md5($CW);

function UniqueRN($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
$Confirm_Codear= UniqueRN(0,9,5);
$Confirm_Code1=$Confirm_Codear[0].$Confirm_Codear[1].$Confirm_Codear[2].$Confirm_Codear[3].$Confirm_Codear[4];
$Confirm_Code= md5($Confirm_Code1);


if(empty($_POST["email"])){
	$errorn.='<div class="alert alert-danger">Email is required.</div>';
}
else
{
	$Email= $_POST["email"];

$Email = mysqli_real_escape_string($db, $Email);

$sql = "SELECT email FROM user WHERE email='$Email'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);



if(mysqli_num_rows($result) == 1)
{
	$emailexist= '<div class="alert alert-danger alert-dismissible">Sorry...this email already exist..</div>';
}


else
{
	if($errorn == '')
    {
	$query = mysqli_query($db, "INSERT INTO confirmuser (fname, lname, email, pass, confirmpass, confirm_code)VALUES ('$fname', '$lname', '$Email', '$Password', '$CW', '$Confirm_Code')");
	}
if($query)
{
	$to      = $Email;
$subject = 'Activate your account on test';
$message = 'Hi, '.$name.'

Please activate your account by entering the otp: '.$Confirm_Code1.'';
$headers = 'From: test' . "\r\n" .
    'Reply-To: test' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$send =mail($to, $subject, $message, $headers);
if($send) {
 $success = '<div class="alert alert-success alert-dismissible"><span style="color:#093;">Otp send successfully please enter the otp</span></div>';
}

else {
	$error .= '<div class="alert alert-danger alert-dismissible"><span style="color:#C00;">Otp not send!Please try again</span></div>';
}

}



	
}

}




$data=array(
   'error' => $error,
   'errorn' => $errorn,
   'success' =>$success,
   'emailexist' => $emailexist
);

echo json_encode($data);



}

?>
