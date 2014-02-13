ManyAPIs.WUnderground = function()  {

	//	Constant Declarations 
	var WEATHERURL = "http://api.wunderground.com/api/c7843c7302d3a7db/geolookup/conditions/q/";
	var URLRESPONSE = ".json";

	//	Private Vars
	var queryMap = [];

	//	Public Vars
    var myPublicProperty = 1;

	// Private Methods
	var updateWidget = function(city, state, temp) {
		console.log("Current temperature in " + city + " is: " + temp);
		
		$('#weatherTitleCS').html(city + ', ' + state);
		$('#weatherTitleTemp').html(temp);
	};

	var removeIntervalForCity = function(city,state) {
		
		var id = queryMap[city+state] || -1;
		console.log('id is ' + id + ' for ' + city+state);
		
		if (id != -1) { 
			console.log('clearing interval');
			clearInterval(id);
			return true;
		}
		return false;
	};

	// Public Methods
    var init = function()   {
     	// Do some setup stuff
    	console.log("init() " + head.browser.name + " " + head.browser.version);
    	$( ".draggable" ).draggable({ handle:"div:first-of-type"});
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

	var queryWithTimer = function(city, state, timer) {
		console.log('setting ' + city + state + ' for ' + timer);
		queryMap[city+state] =  setInterval(function(){queryLocation(city, state);}, timer);
	};
	
	var stopQuery = function(city, state) {
		console.log(removeIntervalForCity(city, state));
	};

	var oPublic = {
		init: init,
		myPublicProperty: myPublicProperty,
		queryLocation : queryLocation,
		queryWithTimer : queryWithTimer,
		stopQuery : stopQuery
    };

    return oPublic;
}();
