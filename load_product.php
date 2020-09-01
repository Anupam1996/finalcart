<?php   
@ob_start();
session_start();
require'Connect/Connect.php';?>


<?php
		   if(isset($_POST["price"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM `test` WHERE price <= ".$_POST['price']." ORDER BY price desc";  
      $result = mysqli_query($db, $query);  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <div class="col-md-4">  
                           <div style="border:1px solid #ccc; padding:12px; margin-bottom:16px; height:375px;" align="center">
                                 
                               <h4>Price - '.$row["brand"].'</h4>  
                          </div>
                     </div>  
                ';  
           }  
      }  
      else  
      {  
           $output = "No Product Found";  
      }  
      echo $output;


	  
 } 
 ?>