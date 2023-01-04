<?php

class feep_settings_page_main{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct() {
		 
		add_action( 'admin_menu', array( $this, 'init_submenu_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		
		// perform custom actions upon submission
		add_action( 'init', array( $this, 'init_option_filters' ) );
		add_action( 'init', array( $this, 'init_options_images' ) );
		
		// add media library JS
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		
	}

	function display() {
		
		$groups = $this->groups();

		?>
			<div>
				<?php //screen_icon(); ?>
				<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				
				<?php foreach( $groups as $group_id => $group ) : ?>
                    
                    <h3><?php echo $group['name']; ?></h3>
                    <p><?php echo $group['desc']; ?></p>
                    
                    <table>
                
                	<?php if( isset( $group['type'] ) and $group['type'] == 'custom' ): ?>
                                
                    	<?php echo $this->{$group['func']}(); // custom output (calback function) ?>
                                   
               		<?php else: ?>
                
						<?php $multipart = ( isset( $group['file'] ) and $group['file'] ) ? ' enctype="multipart/form-data" ' : ''; ?>
                        
                        <form method="post" action="options.php" <?php echo $multipart; ?>> 
                        <?php settings_fields( $group_id ); ?>
                        
                            <?php foreach( $group['options'] as $key => $data ) : ?>
                            
                                <?php 
                                    $comment = ( isset( $data['comment'] ) and !empty( $data['comment'] ) ) ? '<br />'.$data['comment'] : '' ;
                                ?>

                                <tr valign="top">
                                    <th scope="row">
                                        <label for="<?php echo $key; ?>">
                                            <?php echo $data['label']; ?>
                                        </label>
                                    </th>
                                    <td>
                                        <?php echo $this->field_input( $key, $data ); ?>
                                        <?php echo $comment; ?>
                                    </td>
                                </tr>
                                    
                            <?php endforeach; ?>

                            <tr valign="top">
                                <th scope="row">
                                    <?php  submit_button( $group['butt'] ); ?>
                                </td>
                            </tr>
                            
                        </form>
                    
                    <?php endif; ?>
                
                	</table>
                
				<?php endforeach; ?>
				
			</div>
		<?php
	
	
	}
	
	function field_input( $key, $data ){
		
			extract( $data );
		
			// update key with prefix 
			$key_prop = str_replace( '-', '_', $key );
			$key      = $this->prefix.$key;
			
			$value = get_option( $key, $this->init->{$key_prop} );			
			
			if( $type == 'text' ) :
			
				$field = '<input type="'.$type.'" name="'.$key.'" id="'.$key.'" size="25" style="width:60%;" value="'.$value.'" />';
				
			elseif( $type == 'textarea' ) :
			
				$field = '<textarea name="'.$key.'" style="width:100%" >'.$value.'</textarea>';
			
			elseif( $type == 'select' ):
				
				$field = '<select name="'.$key.'">';
				
				if( isset( $prep_sel ) and $prep_sel ) : // prepend select?
					$field .= '<option>Select</option>';
				endif;
			
				foreach ( $options as $option_id => $option_val ) :
					
					if( $option_id == $value ) :
						$selected = ' selected="selected" ';
					else:
						$selected = ' ';
					endif;
				
					$field .= '<option value="'.$option_id.'" '.$selected.'>'.$option_val.'</option>';
					
				endforeach;
				
				$field .= '</select>';
			
			elseif( $type == 'checkbox' ):
			
				$field = '<input type="'.$type.'" name="'.$key.'" value="'.$options['checked'].'" '.checked( $value, $options['checked'], false ).' />';
			
			elseif( $type == 'library' ):
			
				$_rem_display = '';
				$_upload_cont = 'Upload image';
				
				if( $value ):
					$_upload_cont = '<img src="'.wp_get_attachment_url( $value ).'" height="150" />';
				else:					
					$_rem_display = ' style="display:none" ';
				endif;
				
				//opt-key, input id, and input name, all have to be the same, otherwise it won't save the value			
				$field = '
					<a href="#" class="misha-upl" opt-key="'.$key.'">'.$_upload_cont.'</a><br />
					<a href="#" class="misha-rmv" opt-key="'.$key.'" '.$_rem_display.'>Remove image</a>
					<input type="hidden" id="'.$key.'" name="'.$key.'" value="'.$value.'" />
				';
			
			elseif( $type == 'custom' ):
			
			
				$field = '
				';
			
			else:
	
			
			endif;	
			
			return $field;
		
	}

	/* 
	settings page submenu of main wp default settings tab
	*/
	function register_settings() {
		
		$groups = $this->groups();
		
		foreach( $groups as $group_id => $group ) :
		
			if( isset( $group['options'] ) ):
		
				foreach( $group['options'] as $option_id => $option ) :
			
					if( isset( $option['default'] ) ):
						$_default = $option['default'];
					else:
						$_default = '';
					endif;
					
					register_setting( 
						$group_id, 
						$this->prefix.$option_id,
						array( 'default' => $_default )
					);
				
				endforeach;
			
			endif;
			
		endforeach; 
	   
	}
	
	function init_options_images() {
		
		// handle file uploads
		$groups = $this->groups();
		foreach( $groups as $group_id => $group ) :
			if( isset( $group['options'] ) ):
				foreach( $group['options'] as $option_id => $option ) :
					if( $option['type'] == 'file' ):
						add_filter( 'pre_update_option_'.$option_id, array( $this, 'handle_upload' ), 10, 3 );
					endif;
				endforeach;
			endif;
		endforeach; 
		
	}
		
	function handle_upload( $new_value, $old_value, $option_name ) {
		
		if( $_FILES[$option_name]['error'] == 0 and !empty( $_FILES[$option_name]['tmp_name'] ) ):
		
			$result = wp_handle_upload( $_FILES[$option_name], array( 'test_form' => FALSE ) );
			$image_url = $result['url'];
			$this->upload_image_to_media_library_from_url( $image_url );

		else:
			$image_url = get_option( $option_name, '' );
		endif;
		
		return $image_url;
		
	}
	
	// this function retruns the post attachment id
	function upload_image_to_media_library_from_url( $image_url ){
		
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents($image_url);
		$filename = basename($image_url);
		
		if(wp_mkdir_p($upload_dir['path']))
		  $file = $upload_dir['path'] . '/' . $filename;
		else
		  $file = $upload_dir['basedir'] . '/' . $filename;
		  
		file_put_contents($file, $image_data);
	
		$wp_filetype = wp_check_filetype($filename, null );
		
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => sanitize_file_name($filename),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment( $attachment, $file );
		
		require_once ABSPATH.'wp-admin/includes/image.php';
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		$res1 = wp_update_attachment_metadata( $attach_id, $attach_data );
		
		return $attach_id;
	
	}
	
	function enqueue_admin_scripts() {
		
		// check if media library is needed 
		$groups = $this->groups();		
		$enable_media_library = false;		
		foreach( $groups as $data ):		
			foreach( $data['options'] as $field ):			
				if( $field['type'] == 'library' ):
					$enable_media_library = true;
					break;
				endif;			
			endforeach;		
		endforeach;
		
		if( $enable_media_library ):
	
			// I recommend to add additional conditions just to not to load the scipts on each page
			if( isset( $_GET['page'] ) and $_GET['page'] == $this->slug ):
				
				if( !did_action( 'wp_enqueue_media' ) ):
					wp_enqueue_media();
				endif;
		
				wp_enqueue_script(
					'media-uploader', // it already appends -js
					$this->init->plugin_url . 'assets/admin/media-library.js',
					array( 'jquery' ), 
					1, 
					false 
				);
			
			endif;
		
		endif;
	}
	
}

