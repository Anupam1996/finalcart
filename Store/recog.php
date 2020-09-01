<?php
@ob_start();
session_start();
require'../Connect/Connect.php';?>






<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
		<body>
			<div class='search_container'>
  <!-- Search box-->
  <input type='text' name='speechText' id='speechText' > &nbsp; 
  <input type='button' name='start' id='start' value='Start'>
</div>

<!-- Search Result -->
<div class="container"></div>
<script>
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
  console.log(saidText);
  // Update Textbox value
  document.getElementById('speechText').value = saidText;
 
  // Search Posts
  searchPosts(saidText);
}

$("#start").click(function(){
  recognition.start();
})

// Search Posts
function searchPosts(saidText){
console.log(saidText);
  $.ajax({
    url: 'getdata.php',
    type: 'post',
    data: {speechText: saidText},
	
	
    success: function(response){
		console.log(response);
       //$('.container').empty();
       $('.container').html(response);
    },
	
	
  });
}
});
</script>
		</body>
</html>