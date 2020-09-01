$(document).ready(function(){

  /*var Password = $("#pass")
  , Confirm_Password = $("#confirmpass");

function validatePassword(){
  if(Password.value != Confirm_Password.value) {
    Confirm_Password.setCustomValidity("Passwords Don't Match!");
  } else {
    Confirm_Password.setCustomValidity("");
  }
}

Password.onchange = validatePassword();
Confirm_Password.onkeyup = validatePassword();

*/

//before this//




$("#register").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$("#mylogin").fadeOut(500);
    $("#myregister").fadeIn(500);
});

$("#login").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$('#regdef').trigger("reset");
	$('.cr').hide(500);
	$("#myregister").fadeOut(500);
    $("#mylogin").fadeIn(500);
    
});

 $("#forgot").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$("#mylogin").fadeOut(500);
    $("#myforgot").fadeIn(500);
}); 

$("#loginnew").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$("#myforgot").fadeOut(500);
    $("#mylogin").fadeIn(500);
    
});

$("#loginclose").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$('#logdef').trigger("reset");
    $("#mylogin").fadeOut(500);
	$("body").removeClass("modal-open");  
});

$("#registerclose").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$('#regdef').trigger("reset");
	$(".cr").hide(500);
	$("#myregister").fadeOut(500);
	$("body").removeClass("modal-open");  
});


$("#forgotclose").click(function(e){
	$("body").append($(this).attr("href"));
	e.preventDefault();
	$('#fordef').trigger("reset");
	$("#myforgot").fadeOut(500);
	$("body").removeClass("modal-open"); 
});

});