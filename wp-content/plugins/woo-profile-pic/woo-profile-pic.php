<?php
/*
Plugin Name: WooCommerce Profile Photo
Plugin URI: https://webfor99.com
Description: Allows any user to upload their own profile photo to the WooCommerce account
Version: 1.1
Author: Web For 99
Author URI: https://webfor99.com
License: GPL2
*/	

class _wf99_fepp{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
				
		$this->plugin_dir = untrailingslashit( dirname( __FILE__ ) );
		$this->plugin_url = plugin_dir_url( __FILE__ );
		
		// constants
		$this->plugin_vars_prefix = 'fepp-';
		$this->cpt                = '';
		$this->settings_page_id   = 'woo-profile-photo';
		$this->settings_page_name = 'Woo Profile Photo';
		
		// Display location options
		// 1=sidebar, 2=account, 3=avatar on left column, upload on settings page, 4=dashboard, 5=no avatar display, just controls on settings page
		// options used at functions-display.php - cust_get_avatar_widget_actions_html(), settings-submenu-page.php, core.php - set_avatar_hooks()
		$opt_vals = array();
		$opt_vals[1] = 'On The Left Side Bar';
		$opt_vals[4] = 'On The Dashboard';
		$opt_vals[2] = 'On The Account Details Section';
		$opt_vals[3] = 'Profile Photo on Side Bar & Upload Button on The Account Details Section';
		$opt_vals[5] = 'No Profile Photo Display, Only Upload Button on The Account Details Section';
		$this->location_options = $opt_vals;
		
		// used: here, functions-display, settings-submenu
		$this->allow_media_manager_option = true;		
		// used: here, functions-display, settings-submenu
		$this->allow_media_admin_preset   = false;
		// Selector options
		// 1=html selctor, 2=WP Media Manager
		$opt_vals = array();
		$opt_vals[1] = 'HTML Selector';
		if( $this->allow_media_manager_option ):
			$opt_vals[2] = 'WP Media Manager';
		endif;
		if( $this->allow_media_admin_preset ):
			$opt_vals[3] = 'Preset Admin Photos';
		endif;
		$this->media_selector_options = $opt_vals;
		

		
		
		// variable defaults
		$variables = array();
		$variables['widget-location']       = 1; // display options. 1=sidebar, 2=account, 3=avatar on left column, upload on settings page, 4=dashboard 
		$variables['widget-width']          = 270;
		$variables['avatar-width']          = 150;
		$variables['avatar-height']         = 150; 
		$variables['avatar-crop']           = 1; 
		$variables['sidebar-top-margin']    = 240; // if the profile photo is overlapping the sidebar, try increasing this setting
		$variables['mobile-breaking-point'] = 786;
		$variables['max-upload-size']       = 400000; 
		$variables['allowed-mime-types']    = 'jpeg,jpg,gif,png';  
		$variables['photo-selector-type']   = 1; // selector display option. 1=Deafult HTML Uploader, 2=WP Media Manager, 3=Admin Preset Photos
		

		
		
		// variable values	
		foreach( $variables as $key => $default ):
		
			$key_prop = str_replace( '-', '_', $key );
			$key_meta = $this->plugin_vars_prefix.$key;
			
			$this->{$key_prop} = get_option( $key_meta, $default );
			$this->{$key_prop} = ( empty( $this->{$key_prop} ) ) ? $default : $this->{$key_prop} ;

		endforeach;
		

		
		
		// shortcode defaults
		$variables = array();
		$variables['thumb-height']  = 100;
		$variables['thumb-gap']     = 10;
		$variables['items-per-row'] = 3;
		$variables['display-title'] = 1;
		$variables['enable-css']    = 1;
		foreach( $variables as $key => $default ):		
			$key_prop = str_replace( '-', '_', $key );			
			$this->{$key_prop} = $default;		
		endforeach;
			
	}
	
}
$___fepp = new _wf99_fepp;


/* 
TODO: this has to be placed here, not firing when in the media uploader class
*/
// include this file otherwise it throws error
// https://wpbuffs.com/how-to-allow-contributors-to-upload-images-in-wordpress/
if ( !function_exists( 'wp_get_current_user' ) ) :
	include( ABSPATH . 'wp-includes/pluggable.php' ); 
endif;
//Now Allow Contributors to Add Media
if( current_user_can( 'customer' ) && !current_user_can( 'upload_files' ) ):
	add_action( 'admin_init', 'allow_customer_uploads' );
endif;
function allow_customer_uploads() {
	
	$contributor = get_role( 'customer' );
	$contributor->add_cap( 'upload_files' );
	
}
/* 
END TODO
*/

add_action( 'plugins_loaded', 'fepp_woo_check_function', 10 );
function fepp_woo_check_function() {
	
	global $___fepp;

	/* check if woocommerce is install and activated */
	if( class_exists( 'woocommerce' ) ) : // if woocommerce is installed
	
		require_once $___fepp->plugin_dir .'/includes/admin-scripts.php';
		require_once $___fepp->plugin_dir .'/includes/functions.php';
		require_once $___fepp->plugin_dir .'/includes/css.php';
		require_once $___fepp->plugin_dir .'/includes/display.php';
		require_once $___fepp->plugin_dir .'/includes/core.php';
		
		if( $___fepp->allow_media_manager_option and $___fepp->photo_selector_type == 2 ) :
			require_once $___fepp->plugin_dir .'/includes/media-uploader.php';
		elseif( $___fepp->allow_media_admin_preset and $___fepp->photo_selector_type == 3 ) :
			require_once $___fepp->plugin_dir .'/includes/admin-preset.php';
			require_once $___fepp->plugin_dir .'/includes/footer.php';
			require_once $___fepp->plugin_dir .'/includes/image-metabox.php';
		else:
			require_once $___fepp->plugin_dir .'/includes/enqueue.php';
		endif;
		
		require_once $___fepp->plugin_dir .'/includes/settings-link.php';
		
		require_once $___fepp->plugin_dir .'/includes/class.settingsPage.php';
		require_once $___fepp->plugin_dir .'/includes/settings-page.php';
		
		
		require_once $___fepp->plugin_dir .'/shortcodes/profile-photo.php';
	
	endif;

}







