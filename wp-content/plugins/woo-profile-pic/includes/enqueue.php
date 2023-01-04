<?php
/*
Link a Theme Script Which Depends on jQuery
*/
class fepp_enqueue{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		global $___fepp;
		$this->init = $___fepp;
		
		add_action( 'wp_enqueue_scripts', array( $this, 'init' ) ); 
		
	}
	
	/**
	 * just some comments
	 */
	function init(){
		
		// Register the JS file with a unique handle, file location, and an array of dependencies
		$ajax_handler = 'default';
		// handle, source, dependencies, version, in footer
		$_SCRIPT_URL = $this->init->plugin_url.'assets/js.js';
		//$_SCRIPT_URL = get_stylesheet_directory_uri().'/js.js';
		//$_SCRIPT_URL = 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js'; /* script jquery cookie, used for user to choose no to show the modal anymore */
		wp_enqueue_script(
			$ajax_handler,
			$_SCRIPT_URL, 
			array( 'jquery' )
		);

	}
	
}
new  fepp_enqueue;



