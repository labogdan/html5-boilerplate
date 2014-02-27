
function BeersApp() {
	this.container = $('.beers-container');
	this.ul = $('ul');
	this.a = $('.add');
}

BeersApp.prototype.init = function() {
	this.retrieveBeers();
};

BeersApp.prototype.retrieveBeers = function() {
	var self = this;
	
	$.get("jsonBeer.php", function(data){
		if(!data){
			return false;
		}
		var str = "";
		var obj = $.parseJSON(data);
		for (var i = 0, len = obj.length; i < len; i++) {
			str += "<li data-id='" + obj[i].id + "'><a href=''>" + obj[i].name 
				+ "</a><a href='#' class='close'>x</a></li>"; 
		};
		self.ul.append(str);
		self.handleRemoveBeers();
	});
};

BeersApp.prototype.handleRemoveBeers = function() {
	$('.close').click(function(e){
		var liItem = $(e.currentTarget).parent(),
			id = liItem.attr("data-id");
			
		$.ajax({
			type : "DELETE",
			url : "jsonSuccess.php?id=" + id,
			dataType : "json",
			success : function(data){
				liItem.remove();
			}
		});
	});
};

BeersApp.prototype.handleAddBeers = function() {
	
};

$(document).ready(function(){

	b = new BeersApp();
	b.init();
	
});
