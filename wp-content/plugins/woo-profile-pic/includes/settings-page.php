<?php
class fepp_settings_page extends feep_settings_page_main{
	
	/**
	 * A simple call to main actions when constructed
	 */
	public function __construct(){
		
		// If needed to Call the Parent Constructor
		parent::__construct();
		
		global $___fepp;
		$this->init = $___fepp;
		
		$this->slug = $this->init->settings_page_id;
		$this->name = $this->init->settings_page_name.' ';
		
		// this are for the parent class
		$this->plugin_url = $this->init->plugin_url;
		$this->prefix     = $this->init->plugin_vars_prefix;
		
	}
	
	/**
	 * just some comments
	 */
	function groups(){
	
		$groups = array();
		
		
		$group_id = 'general_group';
		$groups[$group_id]['name'] = 'General Options';
		$groups[$group_id]['desc'] = '';
		$groups[$group_id]['butt'] = 'Save Changes';
		
		$options = array();
		
		$options['widget-location']           = array( 'type' => 'select', 'label' => 'Profile Photo Location', 'options' => $this->init->location_options, 'default' => $this->init->widget_location );	
		
		if( $this->init->allow_media_manager_option or $this->init->allow_media_admin_preset ):
			$options['photo-selector-type']   = array( 'type' => 'select', 'label' => 'Photo Selector Type', 'options' => $this->init->media_selector_options, 'default' => $this->init->photo_selector_type );
		endif;		

		$options['max-upload-size']           = array( 'type' => 'text', 'label' => 'Max Upload Size', 'default' => $this->init->max_upload_size  );	
		$options['max-upload-size']['comment'] = 'In Bytes, ie: 400000';	
		$options['max-upload-size']['placeholder'] = $this->init->max_upload_size;	
			
		$options['allowed-mime-types']        = array( 'type' => 'text', 'label' => 'Allowed MIME Types', 'default' => $this->init->allowed_mime_types );
		$options['allowed-mime-types']['comment'] = 'Allowed mime types, separated by comma, ie: jpg,jpeg,gif,png';
		$options['allowed-mime-types']['placeholder'] = $this->init->allowed_mime_types;	
		
		$groups[$group_id]['options'] = $options;
		
		
		
		
		$group_id = 'styling_options';
		$groups[$group_id]['name'] = 'Styling Options';
		$groups[$group_id]['desc'] = '';
		$groups[$group_id]['butt'] = 'Save Changes';
		
		$options = array();
		
		$options['avatar-width'] = array( 'type' => 'text', 'label' => 'Avatar Width', 'default' => $this->init->avatar_width  );	
		$options['avatar-width']['comment'] = 'Only a number, no letters.';	
		$options['avatar-width']['placeholder'] = $this->init->avatar_width;		
				
		$options['avatar-height'] = array( 'type' => 'text', 'label' => 'Avatar Height', 'default' => $this->init->avatar_height  );	
		$options['avatar-height']['comment'] = 'Only a number, no letters.';	
		$options['avatar-height']['placeholder'] = $this->init->avatar_height;
		
		$options['avatar-crop'] = array( 'type' => 'select', 'label' => 'Crop Avatar?', 'options' => array( 1 => 'Crop', 2 => 'No Cropping' ), 'default' => $this->init->avatar_crop );
		$options['avatar-crop']['comment'] = 'The "Avatar Width" will only be considered in the display.';
		
		$options['sidebar-top-margin']        = array( 'type' => 'text', 'label' => 'Side Bar Top margin', 'default' => $this->init->sidebar_top_margin );
		$options['sidebar-top-margin']['comment'] = 'If the profile photo is overlapping or too far from the sidebar, try adjusting this setting.<br />Try increments and decrements of 10, 20, 50..';	
		$options['sidebar-top-margin']['placeholder'] = $this->init->sidebar_top_margin;	
		
		$options['mobile-breaking-point']     = array( 'type' => 'text', 'label' => 'Mobile Breaking Point', 'default' => $this->init->mobile_breaking_point );
		$options['mobile-breaking-point']['comment'] = 'Your specific theme mobile breaking point.<br />If the profile photo is overlapping or too far from the sidebar when in mobile, try adjusting this setting.<br />Try increments and decrements of 10, 20, 50, 100..';
		$options['mobile-breaking-point']['placeholder'] = $this->init->mobile_breaking_point;	
		
		$groups[$group_id]['options'] = $options;
				

		
		return $groups;
		
	}
	
	function init_submenu_page() {
		
		// page title, menu title, capability, menu slug, function	
		add_options_page(
			$this->name.' Settings Page', // page title
			'Woo Profile Photo',      // menu title
			'manage_options',       // capability
			$this->slug,      // menu slug
			array( $this, 'display' ) // callback function,
		);
		
	}	
	
	function init_option_filters() {
		
		$options = array();
		//$options[] = array( 'option_key_1', 'method_key_1' ); // option key, function / method key
		
		foreach( $options as $option ):
			add_filter( 'pre_update_option_'.$option[0], array( $this, 'filter_option_'.$option[1] ), 10, 3 );
		endforeach;
		
	}
		
	function filter_option_method_key_1( $new_value, $old_value, $option_name ) {
		
		// do something
		
		return $value;
		
	}

}

new fepp_settings_page;




