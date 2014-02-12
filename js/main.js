  $(document).ready(function(){
  
  var MyNamespace = MyNamespace || {};

  MyNamespace.WUnderground = function()  {

	//	Constant Declarations 
	
    var WEATHERURL = "http://api.wunderground.com/api/c7843c7302d3a7db/geolookup/conditions/q/";
    var URLRESPONSE = ".json";

	//	Private Vars

	//	Public Vars

    var myPublicProperty = 1;

	// Public Methods

    var init = function()   {
     	// Do some setup stuff
    	console.log("init()");
    };

    var myPrivateFunction = function()  {
    	console.log("myPrivateFunction()");
    };

	// Private Methods

	var updateWidget = function(city, state, temp) {
		console.log("Current temperature in " + city + " is: " + temp);
		
		$('#weatherTitle').html(city + ', ' + state);
		
	};

    var myPublicFunction = function()   {
    	console.log("myPublicFunction()");
	    myPrivateFunction();
    };

	var queryLocation = function(city, state) {
		console.log('finding weather for '+city+state);

		$.ajax({
			url : WEATHERURL + state + "/" + city + URLRESPONSE,
			dataType : "jsonp",
			success : function(parsed_json) {
				console.log(parsed_json);
				var locationCity = parsed_json['location']['city'];
				var locationState = parsed_json['location']['state'];
				var temp_f = parsed_json['current_observation']['temp_f'];
				updateWidget(locationCity, locationState, temp_f);
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

	MyNamespace.WUnderground.init();

	console.log("Calling myPublicFunction()...");
	MyNamespace.WUnderground.myPublicFunction();

	MyNamespace.WUnderground.queryLocation('blacksburg','va');

});

  


