<?php require '../Connect/Connect.php';?>
<?php
$registered = '';
$userexist = '';
$emailexist = '';
$msg = '';
$wrongconfirm = '';
$accountconfirm = '';
$errorinput = '';
$emailsend='';
$emailfailed='';
$result2='';

if(isset($_POST["passkey"]))
{

$passkey=mysqli_real_escape_string($db, $_POST['passkey']);
$passkey=md5($passkey);



$sql1="SELECT * FROM confirmuser WHERE confirm_code ='$passkey'";
$result1=mysqli_query($db, $sql1);
$count=mysqli_num_rows($result1);
	
if($count==1){

$rows=mysqli_fetch_array($result1, MYSQLI_ASSOC);
$fname =mysqli_real_escape_string($db, $rows["fname"]);
$lname =mysqli_real_escape_string($db, $rows["lname"]);
$Email = mysqli_real_escape_string($db, $rows["email"]);
$Gender = mysqli_real_escape_string($db, $rows["gender"]);
$CW = mysqli_real_escape_string($db, $rows["confirmpass"]);
$phonenumber=mysqli_real_escape_string($db, $rows["phonenumber"]);



$result2=mysqli_query($db, "INSERT INTO user (fname, lname,  email, pass, phonenumber, gender)VALUES ('$fname', '$lname', '$Email', '$CW', '$phonenumber', '$Gender')");
if($result2){

$accountconfirm = "Account activated successfully.";
$sql3="DELETE FROM confirmuser WHERE confirm_code = '$passkey'";
$result3=mysqli_query($db, $sql3);
 
	if($result3)
{
	$to      = $Email;
$subject = 'Thank you for activating your account on test';
$message = 'Thank you, '.$fname.' '.$lname.'

Your account is now active.

We are glad to have you on our site and if you have any problem with us please do not hesitate to contact with us.  ';
$headers = 'From: admin@megapiccell.in' . "\r\n" .
    'Reply-To: admin@megapiccell.in' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$send =mail($to, $subject, $message, $headers);
if($send) {
 $emailsend = ' ';
}

else {
	$emailfailed = '';
}

}

else {
	$errorinput = '';


}



}


}


else {
$wrongconfirm = "Confirmation link not matched or already been activated!";
}






	

  
	
	
$data=array(
   'notconfirmed' => $wrongconfirm,
   'confirmed' =>$accountconfirm
);

echo json_encode($data);	




}


?>

