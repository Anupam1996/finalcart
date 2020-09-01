<?php
require '../connect/connect.php';

$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];

if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}

// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without the <>.
$mac_calculated = hash_hmac("sha1", implode("|", $data), "baf7dba3369e4bdfad1518359ef55e64");

if($mac_provided == $mac_calculated){
    echo "MAC is fine";
    // Do something here
    if($data['status'] == "Credit"){
       // Payment was successful, mark it as completed in your database  
                $sql=mysqli_query($db,"SELECT * FROM user WHERE email=".$data['buyer_email']."");
				if(mysqli_num_rows($sql)==1){
					$row=mysqli_fetch_array($sql);
					$buyer_id=$row['id'];
					if($row)
					$sql2=mysqli_query($db,"DELETE FROM cart WHERE userid='$buyer_id'");
					if($sql2){
						$sql3=mysqli_query($db,"INSERT INTO ordering (orderno,fname,lname,email,userid,address,phonenumber,city,country,pincode,price,ordernotes)
SELECT orderno,fname,lname,email,userid,address,phonenumber,city,country,pincode,price,ordernotes FROM confirmordering
WHERE userid='$buyer_id'");
						if($sql3){
							$sql4=mysqli_query($db,"DELETE FROM confirmordering WHERE userid='$buyer_id'");
							if($sql4){
							$sql5=mysqli_query($db,"INSERT INTO product (orderno,trackingid,userid,productid)
SELECT orderno,trackingid,userid,productid FROM confirmproduct
WHERE userid='$buyer_id'");
								if($sql5){
								$sql6=mysqli_query($db,"DELETE FROM confirmproduct WHERE userid='$buyer_id'");	
								}
							}
						}
							
					}
				}
				else{
				echo 'failed';
				}
                $to = 'seal.anupam20@gmail.com';
                $subject = 'Website Payment Request ' .$data['buyer_name'].'';
                $message = "<h1>Payment Details</h1>";
                $message .= "<hr>";
                $message .= '<p><b>ID:</b> '.$data['payment_id'].'</p>';
                $message .= '<p><b>Amount:</b> '.$data['amount'].'</p>';
                $message .= "<hr>";
                $message .= '<p><b>Name:</b> '.$data['buyer_name'].'</p>';
                $message .= '<p><b>Email:</b> '.$data['buyer_email'].'</p>';
                $message .= '<p><b>Phone:</b> '.$data['buyer_phone'].'</p>';
                
                
                $message .= "<hr>";

              
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                // send email
                mail($to, $subject, $message, $headers);




    }
    else{
       // Payment was unsuccessful, mark it as failed in your database
    }
}
else{
    echo "Invalid MAC passed";
}
?>
