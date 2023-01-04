<?php
/*
Link a Theme Script Which Depends on jQuery
*/
class fepp_admin_preset{
	
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
		
		/* scripts for jqeury modal */
		wp_enqueue_style(
			'jquery-dialog',
			'//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'
		);
		wp_enqueue_script(
			'jquery-dialog',
			'https://code.jquery.com/ui/1.13.0/jquery-ui.js',
			array( 'jquery' )
		);
		
		// Register the JS file with a unique handle, file location, and an array of dependencies
		$ajax_handler = 'admin-preset-handler';
		// handle, source, dependencies, version, in footer
		$_SCRIPT_URL = $this->init->plugin_url.'assets/admin-preset.js';
		//$_SCRIPT_URL = get_stylesheet_directory_uri().'/js.js';
		//$_SCRIPT_URL = 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js'; /* script jquery cookie, used for user to choose no to show the modal anymore */
		wp_enqueue_script(
			$ajax_handler,
			$_SCRIPT_URL, 
			array( 'jquery' )
		);

	}
	
}
new fepp_admin_preset;



