  $(document).ready(function(){
  
  var MyNamespace = MyNamespace || {};

  MyNamespace.MyModule = function()  {

    var myPublicProperty = 1;
    
    var WEATHERURL = "http://api.wunderground.com/api/c7843c7302d3a7db/geolookup/conditions/q/";
    var URLRESPONSE = ".json";

    var init = function()   {
      // Do some setup stuff
      console.log("init()");
    };

    var myPrivateFunction = function()  {
    	console.log("myPrivateFunction()");
    };

    var myPublicFunction = function()   {
    	console.log("myPublicFunction()");
	    myPrivateFunction();
    };

	var queryLocation = function(city, state) {
		console.log('finding weather for '+city+state);

		$.ajax({
			url : WEATHERURL + "VA/Blacksburg" + URLRESPONSE,
			dataType : "jsonp",
			success : function(parsed_json) {
				var location = parsed_json['location']['city'];
				var temp_f = parsed_json['current_observation']['temp_f'];
				alert("Current temperature in " + location + " is: " + temp_f);
			}
		});
	};

    var oPublic =
    {
      init: init,
      myPublicProperty: myPublicProperty,
      myPublicFunction: myPublicFunction,
      queryLocation : queryLocation
    };

    return oPublic;
  }();

	MyNamespace.MyModule.init();

	console.log("Calling myPublicFunction()...");
	MyNamespace.MyModule.myPublicFunction();

	MyNamespace.MyModule.queryLocation();

});

  


