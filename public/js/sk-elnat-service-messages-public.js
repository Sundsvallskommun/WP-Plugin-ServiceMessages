(function( $ ) {
	'use strict';

	//When window is loaded
	$( window ).load(function() {
		//Init important variables
		$('.sk-elnat-service-messages').show();

		//Set on click listener for expanding and contracting service messages
		$('.sk-elnat-toggle').click(function() {
			let arrow = $(this).children('div').children('i');
			console.log(arrow);
			if (arrow.text() == 'keyboard_arrow_down') {
				arrow.text('keyboard_arrow_up')
			} else {
				arrow.text('keyboard_arrow_down')
			}
		});
	});

})( jQuery );
