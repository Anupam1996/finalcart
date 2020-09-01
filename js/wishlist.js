function load_wishlist()
	{
		var filename=location.pathname.match(/[^\/]+$/)[0];
		
		if(filename=='Store'||filename=='Product'){
			var URL="../Wishlist/wishrefresh.php";
			var USERID=$(".add-to-cart").attr('id');
		}
		else{
			var URL="Wishlist/wishrefresh.php";
			var USERID=$("#userid").text();
		}
			
		$.ajax({
			url:URL,
			method:"POST",
			data:{
				userid:USERID
			},
			success:function(data)
			{
			   $("#countwishlist").text(data);	
			}
		})
	}

$(document).ready(function(){
load_wishlist();	
var USERID=0;
	$(".add-to-wishlist").click(function(){
		var PRODUCTID=$(this).attr('id');
		USERID=$(this).parent().attr('id');
		$.ajax({
			url:"../Wishlist/addtowishlist.php",
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
		
		load_wishlist();
	});
	
	$(".addtowishlist").click(function(){
		var PRODUCTID=$(this).attr('id');
		USERID=$(this).parent().attr('id');
		$.ajax({
			url:"../Wishlist/addtowishlist.php",
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
		
		load_wishlist();
	});
	
	
	
});
