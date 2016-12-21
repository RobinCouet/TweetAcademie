(function($) {
	$.fn.reload_auto = function() {
		
		setInterval(function(){

			var dest = $("li.tchatli.color").attr("id");
			var data = 'user=' + dest;

			$.ajax({
				url: "https://twitter.robincouet.fr/messages/tchat",
				method: "GET",
				data : data,
				success: function(result) {
					$("#recu").html(result);
				}});
		}, 3000);
	};

	$.fn.reload_timeline = function() {
		
		setInterval(function(){

			$.ajax({
				url: "https://twitter.robincouet.fr/home/ajax_timeline",
				method: "GET",
				success: function(result) {
					$("#timeline").html(result);
				}});
		}, 3000);
	};
}) (jQuery);