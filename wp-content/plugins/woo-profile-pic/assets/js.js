jQuery(document).ready(function() {
	
	// image upload preview
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function (e) {
				//load the new image url into an img placeholder
				jQuery('#wc-profile-photo').attr('src', e.target.result);
				
				//-OR-
				
				// create a placeholder on the go
				//_temp_image = "<img src="+e.target.result+" />";
				//jQuery( input ).parents( '.main-tab-type' ).find( ".main-canvas-inner" ).html( _temp_image )
			}
	
			reader.readAsDataURL(input.files[0]);
		}
	}
	// input[type="file"] id or class
	jQuery("#wc-profile-photo-input").change(function(){
		readURL(this);
	});

	
});