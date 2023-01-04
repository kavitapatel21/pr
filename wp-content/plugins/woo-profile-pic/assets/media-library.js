jQuery(document).ready(function() {
	
	var file_frame; // variable for the wp.media file_frame	
	// attach a click event (or whatever you want) to some element on your page
	jQuery( '#media-selector-button' ).on( 'click', function( event ) {
	
		event.preventDefault();

        // if the file_frame has already been created, just reuse it
		if ( file_frame ) {
			file_frame.open();
			return;
		} 

		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // set this to true for multiple file selection
		});

		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			// id, title, filename, url, link, alt, author, description, caption, name, status, uploaded, date... more
			//alert(attachment)
			//alert(attachment.url)

			//jQuery.each(attachment, function(index, value) { 
				//alert(index + ': ' + value); 
			//});

			// attachment.url is a url, as the name suggests

			// do something with the file here
			//jQuery( '#media-selector-button' ).hide();
			//jQuery( '#frontend-image' ).attr( 'src', attachment.url ); // 
			jQuery( '#wc-profile-photo' ).attr( 'src', attachment.url ); // display image in image placeholder
			jQuery( '#wc-profile-photo-input' ).attr( 'value', attachment.id ); // assign image id value to hidden input
		});

		file_frame.open();
	});
	
	
});



