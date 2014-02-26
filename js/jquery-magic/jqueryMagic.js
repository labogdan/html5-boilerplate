ManyAPIs.JQueryMagic = function()  {

	/*
	 * Constants and Private Variables
	 */
	 
	var WEATHERURL = "http://api.wunderground.com/api/c7843c7302d3a7db/geolookup/conditions/q/",
		URLRESPONSE = ".json",

		queryMap = [],
		queryTimer = "10000";

	/*
	 * Private Methods
	 */



	/*
	 * Public Methods
	 */

    var init = function()   {
    	console.log("init() ");
	};
	
	var doSomeRandomStuff = function() {
		$('#zebraTab tr:even').addClass('zebra'); // simple styling
		
		$('#zebraTab tr').mouseover(function(){
			$(this).addClass('zebraHover'); // simple mouse over/out
		});
		$('#zebraTab tr').mouseout(function(){
			$(this).removeClass('zebraHover');
		});
		
		$('#clickAction1').click(function(){ // simple show/hide on click event
			if ($('#target1').is(':visible')) {
				$('#target1').hide();
			} else {
				$('#target1').show();
			}
		});
		
		$('#clickAction2').click(function(){ // simple show/hide on click event with animation
			$('#target2').toggle('slow');
		});
	};
	
	var doSomeAnimation = function() {
		
		
	};

	var oPublic = {
		init: init,
		doSomeRandomStuff : doSomeRandomStuff,
		doSomeAnimation : doSomeAnimation
    };

    return oPublic;
}();
