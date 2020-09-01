$(document).ready(function(){
var filename=location.pathname.match(/[^\/]+$/)[0];
   $("#regdef").submit(function(e) {
    e.preventDefault();
	});

$("#confirmclose").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$('#condef').trigger("reset");
	$("#myconfirm").fadeOut(500);
	$("body").removeClass("modal-open"); 
});

 $("#regsubmit").click(function(e){
	 	e.preventDefault();
		if(filename=='Store'||filename=='Product'||filename=='checkout')
		var URL="../Signin/signin.php";
		else
		var URL="Signin/signin.php";
		
		var Fname=$("#fname").val();
		var Lname=$("#lname").val();
		var Email=$("#email").val();
		var Pass=$("#pass").val();
		var Confirmpass=$("#confirmpass").val();
		 $.ajax({
			 url:URL,
			 method:"POST",
			 data:{
			 email:Email,
			 pass:Pass, 
			 fname:Fname,
			 lname:Lname,
			 confirmpass:Confirmpass,
			 Register:1	
			},
			 dataType:"JSON",
			 success: function(data) {
				
				   //$('#comment_form')[0].reset();
				   if(data.success !=''){
				   $('#success').html(data.success);
				   $('#regdef').trigger("reset");
				   $('span').hide(1500);
	               $("#myregister").fadeOut(1000);
                   $("#myconfirm").fadeIn(1000); 
				   }
				   else{
				   $('#emailexist').html(data.emailexist);
				   $('#error').html(data.error);
				   $('#errorn').html(data.errorn);
				   $('span').show(1000);
				   }
				
			 }
		 })
});
    




});