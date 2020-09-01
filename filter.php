<?php
@ob_start();
session_start();
require'Connect/Connect.php';
?>
<?php
if(isset($_POST["submit"]))
{
	if(!empty($_POST["brand"]))
	{
		
		
		foreach ($_POST["brand"] as $brand)
		{
			$q=mysqli_query($db,"select * from `test` where brand = '$brand' ");
		}
			if(mysqli_num_rows($q) > 0)
			{
			
				while($row = mysqli_fetch_array($q))
				{
					//if($row['brand']==$brand)
					//{
						echo $row['product-name'];
					//}
				}
			
			}
		
		
	}
	
	else if(!empty($_POST["product"]))
	{
		
		
		foreach ($_POST["product"] as $product)
		{
			$q=mysqli_query($db,"select * from `test` where subcategory = '$product' ");
			if(mysqli_num_rows($q) > 0){
			
			while($row = mysqli_fetch_array($q))
			{
				if($row['subcategory']==$product)
				{
					echo $row['product-name'];
				}
			}
			
			}
		
		}
	}
	
	
	
}


?>

<html>
<head>
<link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>
<body></body>
<form method="post">
	<p><input type="checkbox" name="product[]" value="Laptops">Laptops</p>
	<p><input type="checkbox" name="product[]" value="Mobiles">Mobiles</p>
	<p><input type="checkbox" name="brand[]" value="Redmi">Brand</p>
	
	
	
	
	<p><input type="submit" name ="submit" value="submit"/></p>
	
	
</form>
</html>