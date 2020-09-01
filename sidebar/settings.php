<?php
@ob_start();
session_start();
require 'connect/connect.php';
?>
<?php
if(isset($_SESSION["ID"])){
	$id=$_SESSION["ID"];
$q=mysqli_query($db,"select * from  user where id='$id'");
$row=mysqli_fetch_array($q);
$fname=$row['fname'];
$lname=$row['lname'];
$email=$row['email'];
$phone=$row['phonenumber'];
$dob=$row['dob'];
}
else{
	echo "<script>$(document).ready(function(){
	    alert('please login');	
	});
	</script>";	
}
?>

<html>
<head>
   
        <!-- CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 
<!--JS -->
<script  src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
<script src="bootstable.min.js"></script>

   <link rel="stylesheet" type="text/css" href="style2.css?v=1">
</head>
<body>
       
<div id="alert" style="display:none" class="alert alert-success alert-dismissible"></div>
<div id="alert1" style="display:none" class="alert alert-danger alert-dismissible"></div>

<form  method="post">
    <div class="box">
	  <h2>Update Info</h2>
  <input  type="text" id="fname" name="fname" placeholder="Firstname" value="<?php echo $fname;?>"><br>
  <input  type="text" id="lname" name="lname" placeholder="Lastname" value="<?php echo $lname;?>"><br>
  <input  type="text" id="email" name="email" placeholder="Email" value="<?php echo $email;?>"><br>
  <input  type="text" id="phone" name="phone" placeholder="Phone Number" value="<?php echo $phone;?>"><br>
  <input  type="text" id="dob" name="dob" placeholder="DOB" value="<?php echo $dob;?>"><br>
  <input type="button" id="update" name="Update" value="Update">
  </div>
</form>
<div>
<ul>
	
	<a href="javascript:history.go(-1)"><li class="prev"><span></span></li></a>
	
	</ul>
	</div>
<script>
$(document).ready(function(){


$("#update").click(function(){
var fname=$("#fname").val();
var lname=$("#lname").val();
var email=$("#email").val();
var phone=$("#phone").val();
var dob=$("#dob").val();
var id="<?php echo $id;?>";
$.ajax({  
                url:"updateac/updateac.php",  
                method:"POST",  
                data:{
			    ID:id,
				FNAME:fname,
				LNAME:lname,
				EMAIL:email,
				PHONE:phone,
				DOB:dob,
				UPDATE:1
				},  
                success:function(data){ 
                   if(data=='success'){				
				   $("#alert").css("display","block");
				   $("#alert").html("<p>successfully updated</p>");
				   window.location.href='settings';
				   }
				   else{
					   $("#alert1").css("display","block");
				   $("#alert1").html("<p>failed</p>");
				   }
					
				}
	});

});

});
</script>
</body>
</html>