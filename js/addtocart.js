function changeVal() {
	var subtotal=0;
	var i=0;
$(".payable").each(function(index){
  var payable = parseFloat($("#payable"+index).text());
  subtotal +=payable;
  i +=1; 
	});
	$(".cartcount").text(i);
changeTotal(subtotal);
}

function changeTotal(total) {
  if(total==0){
	 $("#shipping").html(0);
	 $(".cart-list").html('<h6>cart is empty!</h6>');
  }
  else if(total>400){
	 $("#shipping").html(0); 
  }
  else
  $("#shipping").html(40); 
  var price = total;
  /*$("#fullprice").each(function(index){
    price += parseFloat($("#fullprice"+index).html());
  
  });*/
  
  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($("#shipping").html());
  var fullPrice = Math.round((price + tax + shipping) *100) / 100;
  
  if(price == 0) {
    fullPrice = 0;
  }
  
  $("#subtotal").html(price);
  $("#total").html(fullPrice);
}

function load_cart()
	{
		var filename=location.pathname.match(/[^\/]+$/)[0];
		var USERID=$(".add-to-cart").attr('id');
		if(filename=='Store'||filename=='Product')
			var URL="../Cart/subrefresh.php";
		else
			var URL="Cart/subrefresh.php";
			
		$.ajax({
			url:URL,
			method:"POST",
			data:{
				userid:USERID
			},
			success:function(data)
			{
			   $('.cart-list').html(data);
			   changeVal();	
			}
		})
	}
	
$(document).ready(function(){
	var USERID=0;
	$('.add-to-cart-btn').click(function(){
		var PRODUCTID=$(this).attr('id');
		USERID=$(this).parent().attr('id');
		$.ajax({
			url:"../Cart/addtocart.php",
			method:"POST",
			data:{
				productid:PRODUCTID,
				userid:USERID
			},
			success:function(data)
			{
				if(USERID=='')
				alert('Please login in your account!');
			   else
			   alert(data);
			     
			}
			
		})
		
		load_cart();

	});
});