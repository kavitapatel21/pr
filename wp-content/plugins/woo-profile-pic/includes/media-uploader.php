<?php
/*
Google: wordpress open media manager from front end
https://derekspringer.wordpress.com/2015/05/07/using-the-wordpress-media-loader-in-the-front-end/
*/
class fepp_media_uploader{
	
	/**
	 * A simple call to main actions when constructed
	 */
	public function __construct(){
		
		global $___fepp;
		$this->init = $___fepp;
		
		// Call wp_enqueue_media() to load up all the scripts we need for media uploader
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) ); 
		
		// This filter insures users only see their own media
		// TODO: Seems to be working, but keep an eye
		add_filter( 'ajax_query_attachments_args', array( $this, 'ajax_query_attachments_args' ), 10, 1 ); 
		
		// allow woocommerce customer role to upload images
		// https://wpbuffs.com/how-to-allow-contributors-to-upload-images-in-wordpress/
		
		// include this file otherwise it throws error
		// https://wpbuffs.com/how-to-allow-contributors-to-upload-images-in-wordpress/
		if ( !function_exists( 'wp_get_current_user' ) ) :
			include( ABSPATH . 'wp-includes/pluggable.php' ); 
		endif;
		
		//Now Allow Contributors to Add Media
		// TODO: Not firing here, script was placed in the main plugin file
		if( current_user_can( 'customer' ) && !current_user_can( 'upload_files' ) ):
			add_action( 'admin_init', 'allow_customer_uploads', 100 );
		endif;
		
	}
	
	function enqueue_scripts(){
		
		if( !did_action( 'wp_enqueue_media' ) ):
			wp_enqueue_media();
		endif;
		
		wp_enqueue_script(
			'media-uploader', // it already appends -js
			$this->init->plugin_url . 'assets/media-library.js',
			array( 'jquery' ), 
			1, 
			false 
		);
		
	}
	
	function ajax_query_attachments_args( $query ){
	
		// admins get to see everything
		if ( !current_user_can( 'manage_options' ) ):
			$query['author'] = get_current_user_id();
		endif;
	
		return $query;

	}
	
	function allow_customer_uploads() {
		
		$contributor = get_role( 'customer' );
		$contributor->add_cap( 'upload_files' );
		
	}
	
}
new fepp_media_uploader;
















