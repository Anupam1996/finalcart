// JavaScript Document
var check = false;

function changeVal() {
	var total=0;
$(".product").each(function(index){
  var qt = parseFloat($("#qt"+index).html());
  var price = parseFloat($("#price"+index).html());
  var eq = Math.round(price * qt * 100) / 100;
 total +=eq;
  $("#fullprice"+index).html("<span>" +eq+ "</span>" ); 
	});  
     changeTotal(total);        
}

function remove(productidval){
	var USERID=$("#userid").text();
	var productval=productidval;
	
		$.ajax({
			url:"../Cart/remove.php",
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
		var USERID=$("#userid").text();
		$.ajax({
			url:"../Cart/refresh.php",
			method:"POST",
			data:{
				userid:USERID
			},
			success:function(data)
			{
			   $('#cart').html(data);
			   changeVal();	
			}
		})
	}

function changeTotal(total) {
   if(total>400){
	 $(".shipping span").html(0); 
  	}
	else if(total<400 && total>0){
  	$(".shipping span").html(40); 
  	}
  else if(total==0){
	 $(".shipping span").html(0);
	 $(".cart-list").html('<h6>cart is empty!</h6>');
  }
  
  if(total>0){
   check=true;
  }
  
  var price = total;
  /*$("#fullprice").each(function(index){
    price += parseFloat($("#fullprice"+index).html());
  
  });*/
  
  price = Math.round(price * 100) / 100;
  var tax = Math.round(price * 0.05 * 100) / 100
  var shipping = parseFloat($(".shipping span").html());
  var fullPrice = Math.round((price + tax + shipping) *100) / 100;
  
  if(price == 0) {
    fullPrice = 0;
  }
  
  $(".subtotal span").html(price);
  $(".tax span").html(tax);
  $(".total span").html(fullPrice);
}

$(document).ready(function(){
  load_cart(); 
	
  $(document).on("click",".remove",function(e){
	  e.preventDefault();
     var total=parseFloat($(".subtotal span").html());
	 
	    
	 var el = $(this);
	  var productid=el.children('div').attr('id');
	 var productval=$('#'+productid).html();
	var fullid=el.parent().parent().children("footer.content").children("h2.full-price").children("span").attr('id');
	var rowfull=parseFloat($('#'+fullid).text());
	 el.parent().parent().addClass("removed");
	 window.setTimeout(function(){
		
		
		el.parent().parent().slideUp('slow', function() { 
	
          el.parent().parent().remove();
		  
		 if($(".product").length == 0) {
            if(check) {
              //$("#cart").html("<h1>The shop does not function, yet!</h1><p>If you liked my shopping cart, please take a second and heart this Pen on <a 				               href='https://codepen.io/ziga-miklic/pen/xhpob'>CodePen</a>. Thank you!</p>");
			  check=false;
            } else {
              $("#cart").html("<h1>Cart is empty!</h1>");
            }
          }
		   
		});
		
		total=total-rowfull;
	changeTotal(total);
	remove(productval);
	load_cart();
	}, 200);
    
	
  });
  
  $(document).on("click",".qt-plus",function(e){
	  e.preventDefault();
    $(this).parent().children(".qt").html(parseInt($(this).parent().children(".qt").html()) + 1);
	
    var newqt=$(this).parent().children(".qt").text();
	var productid=$(this).parent().parent().children().children().children('div').attr('id');
	var productvar=$('#'+productid).html();
	var userid=$(this).parent().parent().children().children().children('p').attr('id');
	var uservar=$('#'+userid).html();
	changeVal();
	var fullpriceid=$(this).parent().children().children().attr('id');
	var fullpricevar=parseFloat($('#'+fullpriceid).text());
    $(this).parent().children(".full-price").addClass("added");
    
    var el = $(this);
    window.setTimeout(function(){
		el.parent().children(".full-price").removeClass("added");
		
	
		}, 150);
		
		
			$.ajax({
			url:"../Cart/priceupdate.php",
			method:"POST",
			data:{
				productid:productvar,
				userid:uservar,
				quantity:newqt,
				payable:fullpricevar
			},
			success:function(data)
			{
			   alert(data);
			}
		})
		load_cart();
  });
  
  $(document).on("click",".qt-minus",function(e){
    e.preventDefault();
    child = $(this).parent().children(".qt");
    
    if(parseInt(child.html()) > 1) {
      child.html(parseInt(child.html()) - 1);
    }
    
    $(this).parent().children(".full-price").addClass("minused");
	
	var newqt=$(this).parent().children(".qt").text();
	var productid=$(this).parent().parent().children().children().children('div').attr('id');
	var productvar=$('#'+productid).html();
	var userid=$(this).parent().parent().children().children().children('p').attr('id');
	var uservar=$('#'+userid).html();
	changeVal();
	var fullpriceid=$(this).parent().children().children().attr('id');
	var fullpricevar=parseFloat($('#'+fullpriceid).text());
    
    var el = $(this);
    window.setTimeout(function(){el.parent().children(".full-price").removeClass("minused"); }, 150);
	 $.ajax({
			url:"../Cart/priceupdate.php",
			method:"POST",
			data:{
				productid:productvar,
				userid:uservar,
				quantity:newqt,
				payable:fullpricevar
			},
			success:function(data)
			{
			   alert(data);
			}
		})
		load_cart();
  });
 
  
  window.setTimeout(function(){$(".is-open").removeClass("is-open")}, 1200);
  
  $(".btn").click(function(){
    if(check==true)
    //$(".remove").click();
	window.location.href="../Checkout/checkout";
	else
	alert("please add a product to cart before checkout");
  });
});