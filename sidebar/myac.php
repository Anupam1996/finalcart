<?php
@ob_start();
session_start();
require 'connect/connect.php'
?>
<?php
$name='';
$email='';
$phone='';
$fname='';

if(isset($_SESSION["ID"])){
	$id=$_SESSION["ID"];
$q=mysqli_query($db,"select * from user where id='$id'");
if(mysqli_num_rows($q)==1){
	$row=mysqli_fetch_array($q);
	$fname=$row['fname'];
	$name=$row['fname'].' '.$row['lname'];
	$email=$row['email'];
	$phone=$row['phonenumber'];
}
else{
    echo "failed";
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Ecart</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style1.css">
	
	 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>

 
        
		
	              	

						
			 	 
	 
		
		
	<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
			
            <div class="sidebar-header">
				<div id="dismiss">
					<i class="fas fa-arrow-left"></i>
				</div>
			   <h3 class="boxed_item">e<span class="logo_bold">Cart</span></h3>
                <h4 class="logo_title">The Shopping Shop</h4>
				
            </div>
			
			
			 
			
            <ul class="list-unstyled components">
               
				
                <li class="navigation_item">
                    <a href="../showorder/showorder" >My Order</a>
                    
                </li>
                <li class="navigation_item">
                    <a href="#">My Cart</a>
                </li>
                <li class="navigation_item">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">My Wishlist</a>
                    
                </li>
                <li class="navigation_item">
                    <a href="myac">My Account</a>
					
                </li>
                <li class="navigation_item">
                    <a href="#">Help Center</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                
                <li>
                    <a href="../index" class="article">Back to Home</a>
                </li>
            </ul>
        </nav>
		
		

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                   
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
					<i class="fas fa-align-justify"></i>
                        
                       
                    </button>
					
				
                    
                 <div>
				 <ul class="ul">
					<li class="li"><a id="account" href="#home"><span><?php echo 'Hello, '.$fname;?></span></a></li>
					<li class="li"><a href="#news"><i class="fa fa-bell"></i>&nbsp&nbsp <span>Notification</span></a></li>
					<li class="li"><a href="settings"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>&nbsp
     <span>Account Settings</span></a></li>
				</ul>
				 
				 </div>
                   
                </div>
            </nav>
			
			
			<div id="box" class="box-content">
     <div class="container">
  <div class="card" style="width:400px;">
    <img class="img-thumbnail img-fluid m-x-auto d-block" src="a.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">&nbsp&nbsp <?php echo $name; ?></h4>
	  <ul class="list-group list-group-flush">
      <li class="list-group-item"><p class="card-text">&nbsp&nbsp <?php echo $email; ?></p></li>
	   <li class="list-group-item"><p class="card-text">&nbsp&nbsp <?php echo $phone; ?></p></li>
     </ul>
    </div>
  </div>
</div>
           
			
			</div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
<div class="abc">
<br><br>
<button type="button" class="logout" data-toggle="modal" data-target="#myModal">Logout</button>

<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Log Out</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
          
            
		  
        <!-- Modal body -->
        <div class="modal-body">
          <p>Are you sure you want to close all programs and log out of the device?</p>
        
		</div>
        
		
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Cancel</button>
		  <button id="logout" type="button" class="btn btn-danger" data-dismiss="modal">Log Out</button>
        </div>
        
      </div>
	  
  
    </div>
	
  </div>
  
   
  
</div>

</div>			

			

			
    </div>
	
 




    
	 
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').click(function(){
                $('#sidebar').toggle(500);
            });
			 $("#dismiss").click(function(){
                $('#sidebar').hide(500);
            });
			
			$("#logout").click(function(){
				window.location.href="logout.php";
				
			});
		
        });
    </script>
</body>

</html>