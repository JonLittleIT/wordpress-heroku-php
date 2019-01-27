/* Map admin scripts */
var sbvcgmap;
(function($) {
	
	sbvcgmap = {
		init: function() {
			
		},
		autocomplete: function(selector, target) {
			if($(selector).length) {
				$(selector).each(function() {
					var autocomplete_address = ($(this)[0]);
					var autocomplete = new google.maps.places.Autocomplete(autocomplete_address);
					if(target != '') {
						$(selector).change(function() {
							$(target).val('');
						});
						google.maps.event.addListener(autocomplete, 'place_changed', function () {
							var place = autocomplete.getPlace();
							$(target).val(place.geometry.location.lat()+','+place.geometry.location.lng());
						});
					}
				});
			}
		}
	}
	
	$(document).ready(function() {
		sbvcgmap.init();
	});
	
})(jQuery);