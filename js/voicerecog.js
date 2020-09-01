
$(document).ready(function(){
var recognition = new webkitSpeechRecognition();

recognition.onresult = function(event) { 
  var saidText = "";
  for (var i = event.resultIndex; i < event.results.length; i++) {
    if (event.results[i].isFinal) {
      saidText = event.results[i][0].transcript;
    } else {
      saidText += event.results[i][0].transcript;
    }
  }
  
  // Update Textbox value
  document.getElementById('searchform').value = saidText;
 
  // Search Posts
  searchPosts(saidText);
}

$("#searchimg").click(function(){
  recognition.start();
})

// Search Posts
function searchPosts(saidText){

    jQuery(function(){
   jQuery('#searchclk').click();
});
	
  /*$.ajax({
    url: 'getdata.php',
    type: 'post',
    data: {speechText: saidText},
	
	
    success: function(response){
		
       //$('.container').empty();
       $('.container').html(response);
    },
	
	
  });*/
}
});