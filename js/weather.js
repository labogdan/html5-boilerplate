ManyAPIs.WUnderground = function()  {

	//	Constant Declarations 
	var WEATHERURL = "http://api.wunderground.com/api/c7843c7302d3a7db/geolookup/conditions/q/";
	var URLRESPONSE = ".json";

	//	Private Vars
	var queryMap = [];
	var queryTimer = "10000";

	//	Public Vars
    var myPublicProperty = 1;

	// Private Methods
	var updateWidget = function(city, state, temp) {
		console.log("Current temperature in " + city + " is: " + temp);
		
		hideDefaultText();
		
		$('#weatherTitleCS').html(city + ', ' + state);
		$('#weatherTitleTemp').html(temp);
	};

	var hideDefaultText = function() {
		$('#spDefault').hide();
		$('#spWeather').show();
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

	var getDataFromForm = function() {
		var city = $("#inpCity").val();
		var state = $("#inpState").val();
		var retVal = {};
		
		retVal.city = city;
		retVal.state = state;
		return retVal;
	};

	var queryLocation = function(city, state) {
		console.log('finding weather for '+city+state);

		$.ajax({
			url : WEATHERURL + state + "/" + city + URLRESPONSE,
			dataType : "jsonp",
			success : function(parsed_json) {
				console.log(parsed_json);
				
				if (parsed_json['response']['error']) {
					alert(parsed_json['response']['error'].description);
					return;
				} else if (parsed_json['location']){
					var locationCity = parsed_json['location']['city'];
					var locationState = parsed_json['location']['state'];
					var temp_f = parsed_json['current_observation']['temp_f'];
					updateWidget(locationCity, locationState, temp_f);
				} else if (parsed_json['response']['results']) {
					console.log(parsed_json['response']['results']);
					alert('Sorry - too many results.  Check your spelling and try again.')
				}
			}
		});
	};
	
	// Public Methods

    var init = function()   {

    	console.log("init() " + head.browser.name + " " + head.browser.version);
    	$( ".draggable" ).draggable({ handle:"div:first-of-type"});
    	
    	$("#inpLookupOnce").click(function() {
    		lookupOnce();	
    	});
       	$("#inpLookupCont").click(function() {
    		lookupRepeat(queryTimer);	
    	});
	};

	var stopLookup = function(city, state) {
		console.log(removeIntervalForCity(city, state));
	};

	var lookupOnce = function() {
		var data = getDataFromForm();
		queryLocation(data.city, data.state);
	};
	
	var lookupRepeat = function(timer) {
		var data = getDataFromForm();
		queryLocation(data.city, data.state);
		queryMap[data.city+data.state] =  setInterval(function(){queryLocation(data.city, data.state);}, timer);
	};

	var oPublic = {
		init: init,
		myPublicProperty: myPublicProperty
    };

    return oPublic;
}();
