<?php
/*
https://www.puddinq.com/blog/wordpress/wordpress-add-links-to-plugin-description-in-plugin-list/
*/
class fepp_settings_link{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		global $___fepp;
		$this->init = $___fepp;
		
		$this->plugin_name = $this->plugin_name();
				
		// Under the plugin name
		add_filter( 'plugin_action_links_'.$this->plugin_name.'/'.$this->plugin_name.'.php', array( $this, 'links_under_plugin_name' ) );
		
		// Under the plugin description
		add_filter( 'plugin_row_meta', array( $this, 'links_under_plugin_description' ), 10, 2 );
		
	}
	
	function links_under_plugin_name( $links ){
		
		// Adds the link to the end of the array.
		$new_links = array();
		$new_links[] = $this->settings_link(); // The settings link
		
		$links = array_merge( $links, $new_links );
		
		return $links;
		
	}
	
	function links_under_plugin_description( $links, $file ) {
	
		if ( strpos( $file, $this->plugin_name.'.php' ) !== false ) :
			
			// Adds the link to the end of the array.
			$new_links = array();
			$new_links[] = '<a href="https://webfor99.com" target="_blank">webfor99.com</a>'; // The webfor99.com link
			
			$links = array_merge( $links, $new_links );
		
		endif;
		
		return $links;
		
	}
	
	function settings_link(){
		
		// Build and escape the URL.
		$url = esc_url( add_query_arg(
			'page',
			$this->init->settings_page_id,
			get_admin_url() . 'admin.php'
		) );
		
		return '<a href="'.$url.'">'.__( 'Settings' ).'</a>';
		
	}
	
	function plugin_name(){
		
		$plugin_name = explode( '/plugins/', $this->init->plugin_dir );
		if( count( $plugin_name ) > 1 ):
			$plugin_name = $plugin_name[1];
		else:
			$plugin_name = explode( '\plugins\\', $this->init->plugin_dir );
			$plugin_name = $plugin_name[1];
		endif;
		
		return $plugin_name;
		
	}
	
}
new fepp_settings_link;






