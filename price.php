<?php   
@ob_start();
session_start();
require'Connect/Connect.php';?>
 
 <!DOCTYPE html>  
 <html>  
      <head>  
            
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:800px;">  
                
                <div align="center">  
                     <input type="range" min="100" max="55000" step="1000" value="10000" id="min_price" name="min_price" />  
                     <span id="price_range"></span>  
                </div>  
                <br /><br /><br />  
                <div id="product_loading">  
                <?php
						/*$result=mysqli_query($db,'select * from `test` order by price desc');
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                     <div style="border:1px solid #ccc; padding:12px; margin-bottom:16px; height:375px;" align="center">  
                          
                          <h4>Price - <?php echo $row["price"]; ?></h4>  
                     </div>  
                </div>  
                <?php  
                     }  
                }  
                */?>  
                </div>  
           </div>  
		   
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#min_price').change(function(){  
           var price = $(this).val();  
           $("#price_range").text("Product under Price Rs." + price);  
           $.ajax({  
                url:"load_product.php",  
                method:"POST",  
                data:{price:price},  
                success:function(data){  
                     $("#product_loading").fadeIn(500).html(data);  
                }  
           });  
      });  
 });  
 </script>  