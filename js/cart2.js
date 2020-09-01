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

function remove(productidval){
	var filename=location.pathname.match(/[^\/]+$/)[0];
	var USERID=$("#userid").text();
	var productval=productidval;
	if(filename=='Store'||filename=='Product')
		var URL="../Cart/remove.php";
	else
		var URL="Cart/remove.php";
		
		$.ajax({
			url:URL,
			method:"POST",
			data:{
				userid:USERID,
				productid:productval
			},
			success:function(data)
			{
			   	
			}
		})
}

function load_cart()
	{
		var filename=location.pathname.match(/[^\/]+$/)[0];
		
		var USERID=$("#userid").text();
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
load_cart();
$(document).on("click",".delete",function(e){
	  e.preventDefault();
	$(this).parent().fadeOut(500);
	var el=$(this);
	var productid=el.parent().children(".productabc").attr('id');
	 var productval=$('#'+productid).html();
	var payableid=$(this).parent().children(".product-body").children("h4").children(".payable").attr('id');
	var payableval=parseFloat($("#"+payableid).text());
	var subtotal=parseFloat($("#subtotal").text());
	
	 window.setTimeout(function(){
		
		
		
		el.parent().slideUp('slow', function() { 
	
          el.parent().remove();
		  
		  
		});
		
		subtotal=subtotal-payableval;
	changeTotal(subtotal);
	remove(productval);
	load_cart();
	 },200);
	 
});

});