<?php
@ob_start();
session_start();
require'../Connect/Connect.php';?>

<?php
/*function sorting($result){
	$output='';
		if(mysqli_num_rows($result) > 0){
			
			while($row = mysqli_fetch_array($result)){
	$output .= 'Name-'.$row['product-name'].',Id-'.$row['id'].',Price-'.$row['price'].'<br>';
							
			}
        
        // Close result set
			mysqli_free_result($result);
			
		}
		 	else{
        $output= "No records matching your query were found.";
		}
		
							
							return $output;
}

/*if(isset($_GET['sorting'])!=='')
{
	$sort=isset($_GET['sorting']) ? $_GET['sorting'] : '';
	
	$sql = "SELECT * FROM test ORDER BY ".$sort."";
	
	if($sort== "`test`.`featured` DESC")
{	
				$output1 = sorting($db,$sql);
				
}
	 else if($sort== "`test`.`timestamp` DESC")
{
		$output1 = sorting($db,$sql);
}

	else if($sort == "`test`.`product-ratings` DESC")
	{
		$output1 = sorting($db,$sql);
	}
	else if($sort == "`test`.`price` ASC" || "`test`.`price` DESC" ){
		$output1 = sorting($db,$sql);
	}



}*/

?>
<?php
/*$output="";
$q="";
   
   if(isset($_GET['q']) && $_GET['q'] !== " " && $_GET['q'] !== "" && isset($_GET['sorting']) && $_GET['sorting'] !== ""){
	   
	$searchq=isset($_GET['q']) ? $_GET['q'] : '';
	$searchq=strtolower($searchq);
	$_SESSION['searchq']=$searchq;
	$searchq1=explode(" ",$searchq);
	$newcount=count($searchq1);
	for($i=0;$i<$newcount;$i++){
		
	
	$sort=isset($_GET['sorting']) ? $_GET['sorting'] : '';
	$_SESSION['sort']=$sort;
	
	if($sort=='none'){
	  $sort='';	
	}
	else if($sort=='featured'){
      $sort='ORDER BY `test`.`featured` DESC';
	}
	else if($sort=='popularity'){
      $sort='ORDER BY `test`.`product-ratings` DESC';
	}
	else if($sort=='price_asc'){
      $sort='ORDER BY `test`.`price` ASC';
	}
	else if($sort=='price_desc'){
      $sort='ORDER BY `test`.`price` DESC';
	}
	else if($sort=='newest'){
      $sort='ORDER BY `test`.`timestamp` DESC';
	}
	else{
	  $sort='';	
	}

    
	$price_min=isset($_GET['price_min']) ? $_GET['price_min'] : '0';
	$price_max=isset($_GET['price_max']) ? $_GET['price_max'] : '500';

   
	$q =mysqli_query($db,"SELECT * FROM `test` WHERE `price` BETWEEN ".$price_min." AND ".$price_max." OR `product-name` LIKE '%".$searchq1[$i]."%' OR category LIKE '%".$searchq1[$i]."%' OR subcategory LIKE '%".$searchq1[$i]."%' OR price LIKE '%".$searchq1[$i]."%' OR brand LIKE '%".$searchq1[$i]."%' ".$sort."");
	}
	$c=mysqli_num_rows($q);
	
	if($c == 0){
		$output='<div class="product-card"><h1>No result found</h1></div>';  
	  }
	  else
	  {
		    
		     if($sort== "ORDER BY `test`.`featured` DESC")
          	{	
				$output = sorting($q);
			}
	 		else if($sort== "`test`.`timestamp` DESC")
			{
				$output = sorting($q);
			}

			else if($sort == "`test`.`product-ratings` DESC")
			{
				$output = sorting($q);
			}
			else if($sort == "`test`.`price` ASC" || "`test`.`price` DESC" ){
				$output = sorting($q);
			}
			
	  }
	  
	  
   }
   else{
	$output= '<div class="product-card"><h1>Please enter something!</h1></div>';   
   }
   
   
   mysqli_close($db);
*/?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="test.js"></script>
</head>

<body>
<button id="test">test</button><br>
<?php /*print($output); */?>
<script>
$(document).ready(function(){
/*function showlogin(id){
	   if(id != ''){
		alert('no login');
	   }
	   else{
	     //$("body").addClass("modal-open");
         alert('login');
	   } 	
		
	}*/
	
      $("#test").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	//showlogin(id);
	var gh='fun';
	kn(5);
	
    });	
});
</script>
</body>
</html>