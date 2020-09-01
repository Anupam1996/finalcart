
$(document).ready(function(){
	var filename=location.pathname.match(/[^\/]+$/)[0];
$("#condef").submit(function(e) {
    e.preventDefault();
});

 $('#confirmsubmit').click(function(e){
	 	e.preventDefault();
		if(filename=='Store'||filename=='Product'||filename=='checkout')
		var URL="../Signin/confirm.php";
		else
		var URL="Signin/confirm.php";
		
		var Otp=$("#otp").val();
		 $.ajax({
			 url:URL,
			 method:"POST",
			 data:{
			 passkey:Otp	
			},
			 dataType:"JSON",
			 success: function(data) {
				
				   //$('#comment_form')[0].reset();
				   if(data.confirmed !=''){
				   alert(data.confirmed);
				   $('#condef').trigger("reset");
				   $('span').hide(1500);
	               $("#myconfirm").fadeOut(1000);
                   $("#mylogin").fadeIn(1000); 
				   }
				   else
				   alert(data.notconfirmed);
				   	
				
			 }
		 })
});	  


      
  
  });