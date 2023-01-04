<?php

class fepp_profile_photo{
	
    public function __construct(){
		
		$this->init    = new _wf99_fepp;
		$this->display = new fepp_display;
		
        add_shortcode( 'fepp_photo', array( $this, 'shortcode' ) );
		
    }

	public function shortcode( $atts, $content ) {
		
		$image_atts = array();
		
		if( isset( $atts['user_id'] ) ):
			$image_atts['user_id'] = $atts['user_id'];
		endif;
		
		if( isset( $atts['width'] ) ):
			$image_atts['width'] = $atts['width'];
		endif;
		
		if( isset( $atts['height'] ) ):
			$image_atts['height'] = $atts['height'];
		endif;
		
		$display = $this->display->avatar_image_tag( $image_atts );
	
		return $display;
		
	}
	
}
new fepp_profile_photo;