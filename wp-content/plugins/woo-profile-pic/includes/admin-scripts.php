<?php

class fess_admin_header_scripts{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct() {
		
		global $___fepp;
		$this->init = $___fepp;
		
		$this->slug = $this->init->settings_page_id;
		
		add_action( 'admin_head', array( $this, 'init' ) ); 
		
	}
	
	/**
	 * just some comments
	 */
	function init() {
		
		// I recommend to add additional conditions just to not to load the scipts on each page
		//$cur_screen = get_current_screen();
		/*
		print_r($cur_screen);
		WP_Screen Object( 
			[id] => settings_page_woo-profile-photo
			[base] => settings_page_woo-profile-photo
			...
		)
		*/
		
		if( isset( $_GET['page'] ) and $_GET['page'] == $this->slug ):		
		//if( $cur_screen->id == 'my_screen_id' ):
			$this->styles();
			//$this->scripts();
		endif;	
			
	}
	
	/**
	 * output css styles. it can be echoed also.
	 */
	function styles(){
		
	?>
		<style>
			body{
				background:white;
			}
			#wpbody-content table:not(:last-child){
				margin-bottom: 60px
			}
			#wpbody-content table th{
				text-align: left;
				font-weight:normal;
			}
			#wpbody-content table th p.submit{
				margin: 0;
				padding: 0;
			}
			#wpbody-content table th label{
			}
			#wpbody-content table td input[type="text"]{
				width:300px !important;
			}
		</style>
	<?php
		
	}
	
	/**
	 * output css styles. it can be echoed also.
	 */
	function scripts() {
			
	?>
		<script>
			jQuery(document).ready(function() {
				
				alert(1)
				
			});
		</script>
	<?php
		
	}
	
}
new fess_admin_header_scripts;