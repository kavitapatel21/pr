<?php

/* 
this functions handles the photo upload
this functions receives the raw $_FILE from form submission, uploads into the media manager,
and returns the post image id in the media manager (the id in the url)
*/

class fepp_functions{
	
	function upload_picture( $profilepicture ) {   
		
		global $___fepp;
		$init = $___fepp;
		
		$allowed_mime_types = explode( ',', $init->allowed_mime_types );

		$wordpress_upload_dir = wp_upload_dir();
		// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
		// $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
		$i = 1; // number of tries when the file with the same name is already exists
		$new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
		
		$image_raw_type = explode( '/', $profilepicture['type'] );
		$image_raw_type = $image_raw_type[1];
	
		if( !in_array( $image_raw_type, $allowed_mime_types ) ):
			$msg = 'This file type is not allowed.';
			return $msg;
		endif;  
		
		/* we fixed this, mime_content_type() was not working */
		//$file_mime = mime_content_type( $profilepicture['tmp_name'] );
		$check         = getimagesize( $profilepicture['tmp_name'] );
		$file_mime_raw = $check["mime"];
		
		$file_mime = explode( '/', $check["mime"] );
		$file_mime = $file_mime[1]; 
		
		$log = new WC_Logger();        
		
		if( empty( $profilepicture ) ):
			$msg = 'File is not selected.';
			return $msg;
		endif;    
			
		if( $profilepicture['error'] ):
			$msg = $profilepicture['error'];
			return $msg;
		endif;  
			
		//if( $profilepicture['size'] > wp_max_upload_size() )
		if( $profilepicture['size'] > $init->max_upload_size ): // wp_max_upload_size() or 50000 (ie)
			$msg = 'File is too large.';
			return $msg;
		endif;  
		
		if( !in_array( $file_mime, $allowed_mime_types )):
			$msg = 'This file type is not allowed.';
			return $msg;
		endif;  
				   
		while( file_exists( $new_file_path ) ) :
			$i++;
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
		endwhile;
		
		// looks like everything is OK
		if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) :
			
			$args = array(
				'guid'           => $new_file_path, 
				'post_mime_type' => $file_mime_raw,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);		
			$upload_id = wp_insert_attachment( $args, $new_file_path );
			/* we fixed this, get_admin_url() was not working by itself */
			// wp_generate_attachment_metadata() won't work if you do not include this file
			require_once( str_replace( get_bloginfo( 'url' ) . '/', ABSPATH, get_admin_url() ) . 'includes/image.php' );
			//require_once ABSPATH.'wp-admin/includes/image.php';
			// Generate and save the attachment metas into the database
			wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
			
			return $upload_id;
	
		endif;
		
	}
	
	
	// check if the user is in the dashboard section
	function is_user_in_dashboard(){
		
		// check if the user is in the dashboard section
		$current_url = ( isset($_SERVER['HTTPS'] ) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$dashboard_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
	
		if( $dashboard_url == $current_url ): // to show only on dashboard section
			//echo 'WC Dashboard';
			return true;
		else:
			//echo 'no WC Dashboard';
			return false;
		endif;
		
	}
	
	
	//dirty solution to know what woocommerce user tab the current user is at
	function current_wc_tab(){
		
		// check if the user is in the dashboard section
		$current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$current_url = explode( 'my-account', $current_url );
		//print_r($current_url);
		if( count( $current_url ) > 1 ):
			$current_url = explode( '?', $current_url[1] );
		
			$current_url = ltrim( $current_url[0], '/');
			$current_url = explode( '/', $current_url );
			$slug = $current_url[0];
			
			return $slug;
			
		else:
		
			return '';
		
		endif;
		
	}
	
    function sanitize_pixel_value( $string ){
		
		// extract only number
		$string = preg_replace( "/[^0-9]/", "", $string );

		return $string;
		
	}


}



















