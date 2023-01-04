<?php

class fepp_core{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		global $___fepp;
		$this->init = $___fepp;
				
		$this->display = new fepp_display;	
		$this->func    = new fepp_functions;
		
		// this displays the uploaded photo in the wp profile page and in comments
		add_filter( 'get_avatar', array( $this, 'get_avatar' ), 1 , 5 ); 
		
		add_action( 'init', array( $this, 'init' ) );
		
	}
	
	/**
	 * Avatar in WP profile page
	 */
	function get_avatar( $avatar, $id_or_email, $size, $default, $alt ){
		
		$user = false;
		
		if ( is_numeric( $id_or_email ) ) :
			$id = (int) $id_or_email;
			$user = get_user_by( 'id' , $id );
		elseif ( is_object( $id_or_email ) ) :
			if ( ! empty( $id_or_email->user_id ) ) :
				$id = (int) $id_or_email->user_id;
				$user = get_user_by( 'id' , $id );
			endif;
		else :
			$user = get_user_by( 'email', $id_or_email );    
		endif;
		
		if ( $user && is_object( $user ) ) :
			$picture_id = get_user_meta( $user->data->ID, 'profile_pic' );
			if( !empty( $picture_id ) ):
			  	$avatar = wp_get_attachment_image_src( $picture_id[0] ); // size does work on live domain, not on local
				if( $avatar ):
			  		$avatar = $avatar[0];
					$avatar = '<img loading="lazy" alt="'.$alt.'" src="'.$avatar.'" class="avatar avatar-'.$size.' photo" height="'.$size.'" width="'.$size.'">';
				endif;
			endif;
		endif;
		
		return $avatar;
		
	}
	
	/**
	 * 
	 */
	function init(){
		
		/*
		Upload Woo avatar
		*/
		
		$user_id = get_current_user_id();
		
		// if the image is being deleted
		if( isset( $_GET['action'] ) and $_GET['action'] == 'remove' ):
		
			$media_id = get_user_meta( $user_id, 'profile_pic', true );
			delete_user_meta( $user_id, 'profile_pic' );
			//wp_delete_attachment( $picture_id, true ); // either one will work
			//wp_delete_post( $media_id, true );
			
		endif;
	
		// if the image is being uploaded with the html form selector
		if( isset( $_FILES['profile_pic'] ) and $_FILES['profile_pic'] and trim( $_FILES['profile_pic']['name'] ) != '' ):
		
			$media_id = $this->func->upload_picture( $_FILES['profile_pic'] ); // this returns the media uploader id (the id in the url)
			
			if( is_int( $media_id ) ) :
				$_SESSION['upload_mgs'] = '';
				update_user_meta( $user_id, 'profile_pic', $media_id );
			else:
				$_SESSION['upload_msg'] = $media_id;
			endif;
			
		endif;
	
		// if the image is being uploaded with the media manager option
		// this post brings the image if in the media library
		if( isset( $_POST['profile_pic'] ) and trim( $_POST['profile_pic'] ) != '' ):
	
			update_user_meta( $user_id, 'profile_pic', $_POST['profile_pic'] );
			
		endif;
		
		
		
		/*
		Set avatar hooks
		*/
		$location = $this->init->widget_location;
	
		// 1=sidebar, 2=account, 3=avatar on left column, upload on settings page, 4=dashboard, 5=no avatar display, just controls on settings page
		// options used at functions-display.php - cust_get_avatar_widget_actions_html(), settings-submenu-page.php, core.php - set_avatar_hooks()
		if( $location == 1 or $location == 2 or $location == 4 ): // 
			
			if( $location == 1 ): // sidebar
				$action = 'woocommerce_before_account_navigation'; // to display on top of left hand side menu
			elseif( $location == 2 ): // account page
				$action = 'woocommerce_before_edit_account_form'; // to show only on account settings section
			elseif( $location == 4 ): // dashboard page
				if( empty( $this->func->current_wc_tab() ) ): // if empty, it is because it is in the dashboard
					$action = 'woocommerce_account_content';  // to show only on dashboard section
				endif;
			endif;
		
			$function = 'widget_full'; // to display on top of left hand side menu
			
			if( !empty( $action ) ):
				add_action( $action, array( $this->display, $function ), 1 ); // to show only on account settings section
			endif;
		
		elseif( $location == 3 ): // avatar on left column, upload on settings page
		
			$action = 'woocommerce_before_account_navigation'; // to display on top of left hand side menu
			$function = 'widget_avatar'; // to display on top of left hand side menu
			
			add_action( $action, array( $this->display, $function ) ); // to show only on account settings section
		
			$action = 'woocommerce_before_edit_account_form'; // to show only on account settings section
			$function = 'widget_controls'; // to display on top of left hand side menu
			
			add_action( $action, array( $this->display, $function ), 1 ); // to show only on account settings section
		
		elseif( $location == 5 ): // no avatar display, just controls on settings page
		
			$action = 'woocommerce_before_edit_account_form'; // to show only on account settings section
			$function = 'widget_controls'; // to display on top of left hand side menu
			
			add_action( $action, array( $this->display, $function ), 1 ); // to show only on account settings section
			
		endif;

	}
	
}
new fepp_core;
