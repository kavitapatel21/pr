jQuery(document).ready(function() {
	
	// on upload button click
	jQuery('body').on( 'click', '.misha-upl', function(e){

		e.preventDefault();

		var button = jQuery(this),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			button.html('<img src="' + attachment.url + '" height="150">');
			jQuery( 'input[name="' + button.attr('opt-key') + '"]').val( attachment.id );
		}).open();
	
	});

	// on remove button click
	jQuery('body').on('click', '.misha-rmv', function(e){

		e.preventDefault();

		var button = jQuery(this);
		//button.next().val(''); // emptying the hidden field
		jQuery( 'input[name="' + button.attr('opt-key') + '"]').val( '' );
		button.hide();
		jQuery( 'a[class="misha-upl"][opt-key="' + button.attr('opt-key') + '"]' ).html( 'Upload image' );
	});	

	
});


