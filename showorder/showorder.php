<?php
@ob_start();
session_start();
require'../Connect/Connect.php';?>
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
<?php
$output='';
	$sql=mysqli_query($db,"SELECT * FROM product WHERE userid='$id'");
	$count=mysqli_num_rows($sql);
	if($count==0)
	$output='No orders to show';
	else{
		while($row=mysqli_fetch_array($sql)){
			$productid=$row['productid'];
			$sql2=mysqli_query($db,"SELECT * FROM test WHERE id='$productid'");
			$row1=mysqli_fetch_array($sql2);
			$price=$row1['price'];
			$productname=$row1['product-name'];
			$trackingid=$row['trackingid'];
			$quantity=$row['quantity'];
			$orderno=$row['orderno'];
			
			$output .='<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="../img/product01.png" class="img-thumbnail img-sm"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">'.$productname.' </h6>
		<dl class="param param-inline small">
		  <dt>Size: </dt>
		  <dd>XXL</dd>
		</dl>
		<dl class="param param-inline small">
		  <dt>Color: </dt>
		  <dd>Orange color</dd>
		</dl>
	</figcaption>
</figure> 
	</td>
	<td> 
		
			<p>'.$quantity.'</p>	
		 
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price">Rs. '.$price*$quantity.'</var> 
			
		</div> <!-- price-wrap .// -->
	</td>
	<td class="text-right"> 
	<a title="" href="" class="btn btn-outline-success" data-toggle="tooltip" data-original-title="Track"> <i class="fa fa-map-marker" aria-hidden="true"></i></a> 
	<a href="" id="cancel" class="btn btn-outline-danger"> × Cancel</a>
	</td>
</tr>
<tr>';
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
    <link rel="stylesheet" href="../css/showorder.css">
	
	 
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
                    <a href="showorder" data-toggle="collapse" aria-expanded="false">My Order</a>
                    
                </li>
                <li class="navigation_item">
                    <a href="#">My Cart</a>
                </li>
                <li class="navigation_item">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">My Wishlist</a>
                    
                </li>
                <li class="navigation_item">
                    <a href="../sidebar/myac">My Account</a>
					
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
					<li class="li"><a href="../sidebar/settings"><i class="fa fa-cog fa-spin fa-1x fa-fw"></i>&nbsp
     <span>Account Settings</span></a></li>
				</ul>
				 
				 </div>
                   
                </div>
            </nav>
			
			
			
			
			
					<div class="container"> 

			<div class="card">
<table class="table table-hover shopping-cart-wrap">
<thead class="text-muted">
<tr>
  <th scope="col">Product</th>
  <th scope="col" width="120">Quantity</th>
  <th scope="col" width="120">Price</th>
  <th scope="col" width="200" class="text-right">Action</th>
</tr>
</thead>
<tbody>
 <?php print($output); ?>
 <!--product-->
 
<!--<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="b.jpg" class="img-thumbnail img-sm"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">Product name goes here </h6>
		<dl class="param param-inline small">
		  <dt>Size: </dt>
		  <dd>XXL</dd>
		</dl>
		<dl class="param param-inline small">
		  <dt>Color: </dt>
		  <dd>Orange color</dd>
		</dl>
	</figcaption>
</figure> 
	</td>
	<td> 
		
			<p>1</p>	
		 
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price">Rs. 145</var> 
			<small class="text-muted">(Rupees each)</small> 
		</div> <!-- price-wrap .// -->
	<!--</td>
	<td class="text-right"> 
	<a title="" href="" class="btn btn-outline-success" data-toggle="tooltip" data-original-title="Track"> <i class="fa fa-map-marker" aria-hidden="true"></i></a> 
	<a href="" id="cancel" class="btn btn-outline-danger"> × Cancel</a>
	</td>
</tr>
<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="p.jpg" class="img-thumbnail img-sm"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">Product name goes here </h6>
		<dl class="param param-inline small">
		  <dt>Size: </dt>
		  <dd>XXL</dd>
		</dl>
		<dl class="param param-inline small">
		  <dt>Color: </dt>
		  <dd>Orange color</dd>
		</dl>
	</figcaption>
</figure> 
	</td>
	<td> 
		<p>2</p>  
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price">Rs. 35</var> 
			<small class="text-muted">(Rupees each)</small> 
		</div> <!-- price-wrap .// -->
	<!--</td>
	<td class="text-right"> 
	<a title="" href="" class="btn btn-outline-success" data-toggle="tooltip" data-original-title="Track"> <i class="fa fa-map-marker" aria-hidden="true"></i></a> 
	<a href="" class="btn btn-outline-danger btn-round"> × Cancel</a>
	
	</td>
</tr>
<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="a.png" class="img-thumbnail img-sm"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">Product name goes here </h6>
		<dl class="param param-inline small">
		  <dt>Size: </dt>
		  <dd>XXL</dd>
		</dl>
		<dl class="param param-inline small">
		  <dt>Color: </dt>
		  <dd>Orange color</dd>
		</dl>
	</figcaption>
</figure> 
	</td>
	<td> 
		<p>3</p> 
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price">Rs. 45</var> 
			<small class="text-muted">(Rupees each)</small> 
		</div> <!-- price-wrap .// -->
	<!--</td>
	<td class="text-right"> 
		<a title="" href="" class="btn btn-outline-success" data-toggle="tooltip" data-original-title="Track"> <i class="fa fa-map-marker" aria-hidden="true"></i></a> 
		<a href="" class="btn btn-outline-danger btn-round"> × Cancel</a>
		
	</td>
</tr>-->
</tbody>
</table>
</div> <!-- card.// -->

</div> 
			
					
			
</div>
             
                              
















			    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').click(function(){
                $('#sidebar').toggle(500);
            });
			 $("#dismiss").click(function(){
                $('#sidebar').hide(500);
            });
			
			 $('[data-toggle="tooltip"]').tooltip();
			 
			
		
        });
    </script>
			
			
			</body>
			</html>