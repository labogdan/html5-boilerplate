var ManyAPIs = ManyAPIs || {};

// remember that html5 workspace needs to be moved to C:\xampp\htdocs\html5

$(document).ready(function(){

	ManyAPIs.WeatherWidget.init();

	$.ajax ({
		url : 'http://localhost/html5/logResponse.php',
		type: 'POST',
		data : {name:'asdf'},
		success : function(retval) {
			console.log(retval);
		}
	});
});
