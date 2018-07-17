(function( $ ) {
	'use strict';

	//When window is loaded
	$( window ).load(function() {
		//Init important variables
		$('.sk-elnat-service-messages').show();
		var service_messages_original_height = $('.sk-elnat-expandeble').height();

		//Set on click listener for expanding and contracting service messages
		$('.sk-elnat-expand-button').click(function() {
			expand_service_messagess(100, service_messages_original_height);
		});
	});

	//Expand or contract the service messages <div>
	function expand_service_messagess(expand_time, original_height) {
		var expandeble_box = $('.sk-elnat-expandeble');

		//Expand
		if(expandeble_box.height() === original_height){
			var maxHeight = expandeble_box.css('height', 'auto').height() + 60;
			expandeble_box.height(original_height); //Dont understand why this is needed but it is, so dont remove
			expandeble_box.stop().animate({ height: maxHeight }, expand_time);
			change_icon();
		
		//Contract
		} else {
			expandeble_box.stop().animate({ height: original_height }, expand_time);
			change_icon()
		}
	}

	//Changes the icon of the Google Materiel Arrow
	function change_icon() {
		var button = $('.sk-elnat-expand-button');

		//expand_less and expand_more are Google Material icon names
		if (button.text() == 'expand_less') {
			button.text('expand_more');
		} else {
			button.text('expand_less');
		}
	}

})( jQuery );
