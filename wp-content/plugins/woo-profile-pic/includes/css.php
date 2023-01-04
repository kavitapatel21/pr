<?php

class fepp_css{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		global $___fepp;
		$this->init = $___fepp;
		
		$this->func = new fepp_functions;
		
		$this->widget_width          = $this->func->sanitize_pixel_value( $this->init->widget_width );
		$this->avatar_height         = $this->func->sanitize_pixel_value( $this->init->avatar_height );
		$this->avatar_width          = $this->func->sanitize_pixel_value( $this->init->avatar_width );
		$this->sidebar_top_margin    = $this->func->sanitize_pixel_value( $this->init->sidebar_top_margin );
		$this->mobile_breaking_point = $this->func->sanitize_pixel_value( $this->init->mobile_breaking_point );

	}
	
	function get(){
		
		$location = $this->init->widget_location;

		// display options. 1=sidebar, 2=account, 3=avatar on left column, upload on settings page, 4=dashboard
		$navigation = '';
		if( $location == 1 or $location == 3 ): 
			// marging between the widget and the navigation bar when widget is on the side bar
			$navigation = '
					margin-top: '.$this->sidebar_top_margin.'px !important;
			';
		endif;
		
		$crop_avatar = '';
		if( filter_var( $this->init->avatar_crop, FILTER_VALIDATE_BOOLEAN ) ):
			$crop_avatar = '
				.pp-avatar-wrapper{
					height: '.$this->avatar_height.'px;
				}
				.pp-avatar-wrapper img{
					width:100%;
					height:100%;
					object-fit: cover;
				}
			';
		endif;
		
		$display = '
			<style>
				.pp-wrapper{
				}
				
				/* if widget is in the side bar */
				.entry-content .woocommerce .pp-wrapper{
					width: '.$this->widget_width.'px;
					position: absolute;
				}
				/* if widget is in the main column */
				.woocommerce-MyAccount-content > .pp-wrapper{
					width: 100% !important;
					margin-bottom:30px;
					position: relative !important;
					display: block;
					overflow: hidden;
				}
				
				.pp-wrapper > div:not(:last-child){
					margin-bottom: 5px !important;
				}
				
				.pp-title{
					margin-bottom: 5px
				}
				
				.pp-avatar-wrapper{
					float: left;
					width: '.$this->avatar_width.'px;
					overflow: hidden;
				}
				'.$crop_avatar.'

				.pp-actions-wrapper{
					float: left;
					width: 100%;
				}
				
				.pp-submission-result{
					float: left;
					font-size:14px;
					color:#ff0000;
				}	
							
				.pp-controls{
					float: left;
					width: 100%;
				}
				.pp-controls form input,
				.pp-controls form label[for="wc-profile-photo-input"]{
					float:left;
					background:#ffffff;
					padding: 5px 10px;
					font-size:14px;
					font-weight: normal;
					text-transform: capitalize;
					line-height: 1;
					color: #121212;
					border: 1px solid #8e8e8e;
				}
				.pp-controls form input:hover,
				.pp-controls form label[for="wc-profile-photo-input"]:hover{
					background: #efefef;
					color: #121212;
					border: 1px solid #8e8e8e;
				}
				/* hide de default input=file to use a nicely label instead */
				.pp-controls form input[type="file"]{
					width: 0.1px;
					height: 0.1px;
					opacity: 0;
					overflow: hidden;
					position: absolute;
					z-index: -1;
				}				
				.pp-controls form > *:not(:last-child){
					margin-right: 5px;
				}
				
				.pp-remove-link a{
					float: left;
					font-size:14px;
					color: red;
				}
				
				.woocommerce-MyAccount-navigation{
					'.$navigation.'
				}
				@media( max-width: '.$this->mobile_breaking_point.'px ){
					.woocommerce-MyAccount-navigation{
						float:left;
						width: 100%;
					}
				}
				.woocommerce-MyAccount-content{
					float: right;
				}
			</style>';
		
		return $display;
		
	}
	
}








