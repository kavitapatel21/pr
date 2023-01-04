<?php

// prepend_select: prepend select option?ion?
class fepp_image_metabox{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		add_action( 'init', array( $this, 'init' ), 10 ); 
		add_action( 'edit_attachment', array( $this, 'edit_attachment' ) ); 
		
	}
	
	/**
	 * just some comments
	 */
	function init(){
		
		$this->create_custom_metaboxes();
		
	}
	
	function get_custom_mb_attachment_data(){
		
		$metaboxes = array();		
			
		$mb_id = 'profile-photo-item';
		$title = 'Profile Photo?';
			
		$_meta_fields = array();
		$_meta_fields[] = array( 'label' => 'Include?', 'label_style' => 0, 'name' => 'profile-photo-item', 'type' => 'select', 'options' => array( 1 => 'Yes', 2 => 'No' ), 'prep_sel' => true ); 
		
		$mb_data = array();
		$mb_data['title']    = $title;
		$mb_data['level']    = 'side'; // 'normal', 'side', and 'advanced'
		$mb_data['position'] = 'default'; // high, low, default		
		$mb_data['meta_fields'] = $_meta_fields;
		$metaboxes[$mb_id] = $mb_data;	
		
		return $metaboxes;
		
	}
	
	// add custom metabox
	function create_custom_metaboxes(){
		
		$cpt     = 'attachment'; 
		//$cpt     = 'post'; 
		$cb_func = array( $this, 'render_my_meta_box' );
		
		$metaboxes = $this->get_custom_mb_attachment_data();
		
		add_action( 'add_meta_boxes_'.$cpt, function() use ( $metaboxes, $cpt, $cb_func ) {
			foreach( $metaboxes as $mb_id => $mb_data ) :
	
				add_meta_box( 
					$mb_id, // unique id
					$mb_data['title'], // title
					$cb_func, // callback function that displays the output of your meta box.
					$cpt, // cpt
					$mb_data['level'], // normal, advanced, and side
					$mb_data['position'], //default, core, high, and low
					$mb_data['meta_fields'] //An array of custom arguments you can pass to your $callback function as the second parameter.
				);
			
			endforeach;
		
		} );
		
	}
	
	function render_my_meta_box( $post, $meta_fields ) {
		
		$meta_fields = $meta_fields['args']; //  it is how it is, don't ask why
		
		include( ABSPATH . 'wp-includes/pluggable.php' );
		if( current_user_can( 'administrator' )  ) :
			$is_admin = true;
		else:
			$is_admin = false;
		endif;
		
		$display = array();
		
		foreach( $meta_fields as $meta_field ):
			$display[] = $this->render_my_meta_box_input( $post, $meta_field, $is_admin );
		endforeach;
		
		$display = implode( $display );
		
		$display = '
			<table style="width:100%">
				'.$display.'
			</table>
		';
		
		echo $display;
	
	}
	
	function render_my_meta_box_input( $post, $meta_field, $is_admin ){
		
		$form_input = '';
			
		extract( $meta_field );	
		
		$meta_value = get_post_meta( $post->ID, $name, true );
	
		if( $type == 'text' ) :
		
			$form_input .= '<input type="'.$type.'" name="'.$name.'" value="'.esc_attr( $meta_value ).'" />';
			
		elseif( $type == 'textarea' ) :
		
			$form_input .= '<textarea style="width:100%" name="'.$name.'">' . esc_attr( $meta_value ) . '</textarea>';
		
		elseif( $type == 'select' ):
			
			$form_input .= '<select name="'.$name.'">';
			
			if( $prep_sel ) : // prepend select?
				$form_input .= '<option>Select</option>';
			endif;
			
			foreach ( $options as $option_id => $option_val ) :
				
				if( (string)$option_id === $meta_value ) :
					$selected = ' selected="selected" ';
				else:
					$selected = ' ';
				endif;
			
				$form_input .= '<option value="'.$option_id.'" '.$selected.'>' . esc_html( $option_val ) . '</option>';
			endforeach;
			
			$form_input .= '</select>';
		
		else:
		
		endif;	
		
		
		// label_style: 0=no label, 1=above, 2 or no set=on the left
		if( $label_style == 0 ) :
			$display = '
				<tr colspan="2"><td>'.$form_input.'</td></tr>
			';
		elseif( $label_style == 1 ) :
			$display = '
				<tr>
					<td colspan="2"><strong>'.$label.':</strong></td>
				</tr>
				<tr>
					<td colspan="2">'.$form_input.'</td>
				</tr>
			';
		else:
			$display = '
				<tr>
					<td style="width:50%"><strong>'.$label.':</strong></td>
					<td>'.$form_input.'</td>
				</tr>
			';
		endif;
		
		
		return $display;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * When the post is saved, saves our custom data.
	 */
	function edit_attachment( $post_id ){

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
	
		// Check the user's permissions.
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	
		/* OK, it's safe for us to save the data now. */
		
		//$cpt = get_post_type();
		$metaboxes = $this->get_custom_mb_attachment_data();
		
		foreach( $metaboxes as $mb_data ) :
			
			foreach( $mb_data['meta_fields'] as $meta_field ):
			
				$name = $meta_field['name'];
				$type = $meta_field['type'];
				
				// Make sure that it is set.
				if ( !isset( $_POST[$name] ) ):
					break;
				endif;
		
				// Sanitize user input.
				if( $type == 'text' ) :
					$my_data = sanitize_text_field( $_POST[$name] );
				elseif( $type == 'textarea' ) :
					$my_data = sanitize_textarea_field( $_POST[$name] );
				else:
					$my_data = sanitize_text_field( $_POST[$name] );
				endif;
			
				// Update the meta field in the database.
				update_post_meta( $post_id, $name, $my_data );
			
			endforeach;
	
		endforeach;
	
	}
	
}
new fepp_image_metabox;

