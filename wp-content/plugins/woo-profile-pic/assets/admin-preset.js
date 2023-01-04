jQuery(document).ready(function() {
	
	jQuery( '#pp-wrapper img' ).on( 'click', function( event ) {
		
		// remove borders from all images
		jQuery( '#pp-wrapper img' ).css( 'border', 'none' );
		// assign border to selected image
		jQuery( this ).css( 'border', '3px solid red' );
		
		// remove class "selected" from all images
		jQuery( '#pp-wrapper img' ).removeClass( 'pp-selected' );
		// assign class selected to the selected image
		jQuery( this ).addClass( 'pp-selected' );
		
		// display image in image placeholder
		jQuery( '#wc-profile-photo' ).attr( 'src', jQuery( this ).attr( 'src' ) ); 
			
	});
	
	
	
	/* base script */
	jQuery( function() {
		jQuery( "#dialog-canvas" ).dialog({
		
			autoOpen: false,
			
			buttons: {
				"Select": function() {
					
					pp_image_url = jQuery( '#pp-wrapper img.pp-selected' ).attr( 'src' );
					pp_image_id  = jQuery( '#pp-wrapper img.pp-selected' ).attr( 'data-id' );
					
					jQuery( '#wc-profile-photo' ).attr( 'src', pp_image_url ); // display image in image placeholder
					jQuery( '#wc-profile-photo-input' ).attr( 'value', pp_image_id ); // assign image id value to hidden input
					
					jQuery( '#pp-wrapper img' ).css( 'border', 'none' );
					jQuery( '#pp-wrapper img' ).removeClass( "pp-selected" );
					
					
					jQuery( this ).dialog( "close" );
					
				},
				Cancel: function() {
					
					jQuery( '#pp-wrapper img' ).css( 'border', 'none' );
					jQuery( '#pp-wrapper img' ).removeClass( "pp-selected" );
					
					jQuery( this ).dialog( "close" );
					
				}
			},
					
		});
	});
 
 
    jQuery( "#media-selector-button" ).on( "click", function() {
		jQuery( "#dialog-canvas" ).dialog( "open" );
    });
  
});



















