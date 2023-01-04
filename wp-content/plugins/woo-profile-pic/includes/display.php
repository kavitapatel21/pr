<?php

class fepp_display{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		global $___fepp;
		$this->init = $___fepp;
			
		$this->css  = new fepp_css;
		$this->func = new fepp_functions;
		
	}
	
	/* 
	Full widget display: photo and the upload controls altogether
	It is used for views such as on side bar, dashboard and and my account edit page
	*/
	function widget_full(){
	
		$display = '
			'.$this->css->get().'
			<div class="pp-wrapper">
				'.$this->avatar().'
				'.$this->controls().'
			</div>
		';
		
		echo $display;
	   
	}
	
	/* 
	Displays the avatar only on the left hand side column. 
	Used for the left hand side column avatar and right column controls views.
	*/
	function widget_avatar(){
	
		$display = '
			'.$this->css->get().'
			<div class="pp-wrapper">		
				'.$this->avatar().'			
			</div>
		';
		
		echo $display;
	   
	}
	
	/*
	Displays the photo controls only on the right hand side column. 
	Used for the left hand side column avatar and right column controls views.
	*/
	function widget_controls(){
	
		$display = '
			'.( ( $this->init->widget_location == 5 ) ? $this->css->get() : '' ).'
			<div class="pp-wrapper">
				<p class="pp-title">Profile Photo</p>			
				'.$this->controls().'			
			</div>
		';
		
		echo $display;
	   
	}
	
	
	
	
	
	
	
	
	
	
	
	/*
	Display widget avatar part
	*/
	function avatar(){
		
		$avatar_url = $this->avatar_url();
	
		$display = '
			<div class="pp-avatar-wrapper">
				<a href="'.$avatar_url.'" target="_blank">
					<img src="'.$avatar_url.'" id="wc-profile-photo" />  
				</a>
			</div>    
		';
		
		return $display;
	}
	/*
	This is used by the shortcode, we can merge both functions eventually
	*/
	function avatar_image_tag( $atts = array() ){

		extract( $atts );
		
		$avatar_url = $this->avatar_url( $atts );
		
		$style = array();
		( isset( $width ) )  ? $style[] = 'width: '.$width.'px'   : '' ;
		( isset( $height ) ) ? $style[] = ' height: '.$height.'px' : '' ;
		$style = ( $style )  ? $style = ' style="'.implode( '; ', $style ).'" ' : '';
		
		$display = '
			<img src="'.$avatar_url.'" '.$style.' class="pp-user-avatar" />   
		';
		
		return $display;
	}
	
	/*
	Display widget controls part
	*/
	function controls(){
	
		$location = $this->init->widget_location;
	
		// 1=sidebar, 2=account, 3=avatar on left column, upload on settings page, 4=dashboard, 5=no avatar display, just controls on settings page
		$_action = '';
		if( $location == 2 or $location == 3 or $location == 5 ): 
			$_action = get_permalink( get_option('woocommerce_myaccount_page_id') ).'edit-account/';
		elseif( $location == 4 ): // 4=dashboard
			$_action = get_permalink( get_option('woocommerce_myaccount_page_id') );
		endif;
		
		if( isset( $_SESSION['upload_msg'] ) ):
			$upload_msg = $_SESSION['upload_msg'];
		else:
			$upload_msg = '';
		endif;
	
		if( 
			( $this->init->allow_media_manager_option and $this->init->photo_selector_type == 2 ) or 
			( $this->init->allow_media_admin_preset   and $this->init->photo_selector_type == 3 ) 
		): 
			$selector_display = '
				<input type="hidden" id="wc-profile-photo-input" value="" name="profile_pic" />
				<input type="button" id="media-selector-button" value="Select Photo" />
			';
		else:
			$selector_display = '
				<input type="file" id="wc-profile-photo-input" name="profile_pic" size="25" />
				<label for="wc-profile-photo-input">Select Photo</label>
			';
		endif;
	
		$display = '
			<div class="pp-actions-wrapper">
				<div class="pp-submission-result">
					'.$upload_msg.'
				</div>
				<div class="pp-controls">
					<form enctype="multipart/form-data" action="'.$_action.'" method="POST">
						'.$selector_display.'
						<input type="submit" value="Save it" />
					</form>
				</div>
				<div class="pp-remove-link">
					'.$this->delete_link().'
				</div>
			</div>   
		';
		
		return $display;
	}
	
	
	
	
	
	
	
	
	


	
	

	
	/* this function returns the avatar url. It will resize the image only with get_avatar_url (when user has no profile pic). */
	function avatar_url( $atts = array() ) {
	
		extract( $atts );
		
		$avatar_url = '';

		if( !isset( $user_id ) or empty( $user_id ) or $user_id === 0 ) :
			$user_id = get_current_user_id();
		endif;
		
		$picture_id = get_user_meta( $user_id, 'profile_pic', true );   
		
		if( trim( $picture_id ) == '' ) :
		
			if( isset( $width ) ) : 
				$size = array( 'size' => $width );
			else:
				$size = array();
			endif;
			
			$avatar_url = get_avatar_url( $user_id, $size );
			
		else:
		
			if( isset( $width ) and isset( $height )  ) :
				$size = array( $width, $height );
			else:
				$size = ''; // array() throws a warning
			endif;
			
			$avatar = wp_get_attachment_image_src( $picture_id, $size ); // size does work on live domain, not on local
			if( $avatar ):
				$avatar_url = $avatar[0];
			endif;
		endif;
		
		return $avatar_url;
		
	}
	
	
	
	
	
	
	
	function delete_link(){
		
		$user_id = get_current_user_id();
		
		$slug = $this->func->current_wc_tab();
		
		$picture_id = get_user_meta( $user_id, 'profile_pic', true );    
		if( trim( $picture_id ) == '' ) :
			$delete_link = '';
		else:
			$delete_link = '<a href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'/'.$slug.'?action=remove">Remove Photo</a>';
		endif;
		
		return $delete_link;
		
	}


}





