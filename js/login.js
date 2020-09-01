$(document).ready(function(){
var filename=location.pathname.match(/[^\/]+$/)[0];
 $("#logdef").submit(function(e) {
    e.preventDefault();
});

 $('#logsubmit').click(function(e){
	 	e.preventDefault();
	 	if(filename=='Store'||filename=='Product'||filename=='checkout')
		var URL="../Signin/login.php";
		else
		var URL="Signin/login.php";
		
		var Email=$("#logemail").val();
		var Pass=$("#logpass").val();
		 $.ajax({
			 url:URL,
			 method:"POST",
			 data:{
			 email:Email,
			 pass:Pass, 
			 Login:1	
			},
			 dataType:"JSON",
			 success: function(data) {
				
				   //$('#comment_form')[0].reset();
				   if(data.success !=''){
				   alert(data.success);
				   var email = data.email;
				   var session = data.session;
				   var pass = data.pass;
				   //window.history.replaceState(null, null, "?a="+id);
				   if(filename=='Store'||filename=='Product'||filename=='checkout')
						var newurl="../Signin/session?pass="+pass+"&&email="+email;
					else
						var newurl="Signin/session?pass="+pass+"&&email="+email;
				   window.location.href=newurl;
				   $('#logdef').trigger("reset");
				   $('span').hide(1500);
	               $("#mylogin").fadeOut(1000);
				   $("body").removeClass("modal-open"); 
				   }
				   else{
				   alert(data.error);
				   $('span').show(1000);
				   }
				
			 }
		 })
});
    
});
