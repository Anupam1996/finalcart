<?php
@ob_start();
session_start();
require'../Connect/Connect.php';?>
<?php

$searchText='';
if(isset($_POST['speechText'])){
    $searchText = $_POST['speechText'];

/*if(isset($searchText)){ 
    echo $searchText;
}

searchText = $_POST['speechText'];*/

// search query
$query = "SELECT * FROM `test` WHERE `product-name` LIKE '%".$searchText."%' OR category LIKE '%".$searchText."%' OR subcategory LIKE '%".$searchText."%' OR price LIKE '%".$searchText."%' OR brand LIKE '%".$searchText."%'";


$result = mysqli_query($db,$query);

$html = '';

$count=mysqli_num_rows($result);
if($count > 0){
  while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $product = $row['product-name'];
    $category = $row['category'];
    
    $brand = $row['brand'];

    // Creating HTML structure
    $html .=
	'<div id="post_'.$id.'" class="post">
		<h1>'.$product.'</h1>
    
		<a href="'.$brand.'" class="more" target="_blank">More</a>
    </div>';

  }
}else{
  $html = 
  '<div >;
	<p>No Record Found.</p>
  </div>';
}

echo $html;
}

?>