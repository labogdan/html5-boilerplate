ManyAPIs.WeatherWidget = function()  {

	/*
	 * Constants and Private Variables
	 */
	 
	var WEATHERURL = "http://api.wunderground.com/api/c7843c7302d3a7db/geolookup/conditions/q/",
		URLRESPONSE = ".json",

		queryMap = [],
		queryTimer = "10000";

	/*
	 * Public Variables
	 */

    var myPublicProperty = 1;

	/*
	 * Private Methods
	 */

	var updateWidget = function(options) {
		
		console.log("Current temperature in " + options.locationCity + " is: " + options.temp_f);
		
		hideDefaultText();
		
		$('#weatherTitleCS').html(options.locationCity + ', ' + options.locationState);
		$('#weatherTitleTemp').html(options.temp_f);
		$("#icoWeather").attr("src", options.icon);
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
		var city = $("#inpCity").val(),
			state = $("#inpState").val(),
			retVal = {};
		
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
					var params = {};
					params.locationCity = parsed_json['location']['city'];
					params.locationState = parsed_json['location']['state'];
					params.temp_f = parsed_json['current_observation']['temp_f'];
					params.icon = parsed_json['current_observation']['icon_url'];
					updateWidget(params);
				} else if (parsed_json['response']['results']) {
					console.log(parsed_json['response']['results']);
					alert('Sorry - too many results.  Check your spelling and try again.');
				}
			}
		});
	};
	
	var stopLookup = function() {
		var data = getDataFromForm();
		console.log(removeIntervalForCity(data.city, data.state));
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

	/*
	 * Public Methods
	 */

    var init = function()   {

    	console.log("init() " + head.browser.name + " " + head.browser.version);

    	$( ".draggable" ).draggable({ handle:"div:first-of-type"});
    	$("#inpLookupOnce").click(function() {
    		lookupOnce();	
    	});
       	$("#inpLookupCont").click(function() {
    		lookupRepeat(queryTimer);	
    	});
       	$("#inpLookupStop").click(function() {
    		stopLookup();	
    	});
	};

	var oPublic = {
		init: init,
		myPublicProperty: myPublicProperty
    };

    return oPublic;
}();
