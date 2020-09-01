		var check=false;
function changeVal() {
	var subtotal=0;
$(".order-products").children().each(function(index){
  var price = parseFloat($("#totalprice"+index+" span").text());
 subtotal +=price;
	});  
     changeTotal(subtotal);        
}

function changeTotal(total) {

  if(total==0)
	 $("#shipping span").html(0);
	 //$(".order-products").html('<h6>cart is empty!</h6>');
  
  else if(total>400)
	 $("#shipping span").html(0); 
  
  else
  $("#shipping span").html(40); 
  
  var price = total;
  /*$("#fullprice").each(function(index){
    price += parseFloat($("#fullprice"+index).html());
  
  });*/
  
  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($("#shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) *100) / 100;
  
  if(price == 0) 
    fullPrice = 0;
  
  
  
  $("#tax span").html(tax);
  $(".order-total span").html(fullPrice);
  $("#totalpricecheck").val(fullPrice);
}


 


$(document).ready(function(){
	changeVal();
	
	$("#placeorder").click(function(e){
		$("body").append($(this).attr("href"));
		e.preventDefault();
		var chk = $('input[name="chk[]"]:checked').length > 0;
		var terms = $('input[name="terms[]"]:checked').length > 0;
		var fname=$("#updatefname").val();
		var lname=$("#updatelname").val();
		var email=$("#updateemail").val();
		var address=$("#updateadd").val();
		var city=$("#updatecity").val();
		var country=$("#updatecountry").val();
		var pin=$("#updatepin").val();
		var phone=$("#updatephone").val();
		var userid=$("#userid").text();
		var price=parseFloat($("#total span").html());
		var ordernotes=$("#ordernotes").val();
		

		if(chk==true&&terms==true){
			$.ajax({
			url:"../Cart/updateadr.php",
			method:"POST",
			data:{
				UPDATE:1,
				ADDRESS:address,
				CITY:city,
				COUNTRY:country,
				PIN:pin,
				PHONE:phone,
				USERID:userid
				
			},
			success:function(data)
			{
				
			   	alert(data);
				$("#updateaddress").trigger("reset");
			}
		})	
		}
		else if(terms==false)
		Swal.fire({
  			title: 'Please accept the terms to proceed',
  			animation: false,
  			customClass: {
    		popup: 'animated rubberBand'
  		}
		})
		
		 if(terms==true){
		$.ajax({
			url:"../Cart/confirmorder.php",
			method:"POST",
			data:{
				ORDER:1,
				FNAME:fname,
				LNAME:lname,
				EMAIL:email,
				ADDRESS:address,
				CITY:city,
				COUNTRY:country,
				PIN:pin,
				PHONE:phone,
				USERID:userid,
				PRICE:price,
				ORDERNOTES:ordernotes
				
			},
			success:function(data)
			{
			   	if(data=='success'){
			   	Swal.fire(
  					'Good job!',
  					'Now proceed to payment?',
  					'success'
				)
				$("#updateaddress").trigger("reset");
				$("#afterbtnclick").submit();
				}
				
			}
		})/*end of first ajax*/	
		}
		
		
		
		
	});
	
});