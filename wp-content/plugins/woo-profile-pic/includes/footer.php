<?php
/*
add modal content to the footer. button can be added anywhere
*/
class fepp_footer{
	
	/**
	 * A simple call to main actions when constructed
	 */
	function __construct(){
		
		add_action( 'wp_footer', array( $this, 'init' ) ); 
		
	}
	
	/**
	 * just some comments
	 */
	function init(){
		
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'attachment',
			'post_status'      => array( 'inherit' ), // publish, draft, pending, trash, future, private, etc
			'fields'           => 'ids', // if only ids wanted // Array ( [0] => 6339 [1] => 6336 ... )
			'meta_query'        => array(  // single relation
				array(
					'key'       => 'profile-photo-item',
					'value'     => 1,
				)
			),
		);
		$my_posts = get_posts( $args );
	
		$display = array();
		if( $my_posts ) :
			foreach( $my_posts as $thumb_id ):
			
				$thumb_url = wp_get_attachment_url( $thumb_id );
				$display[] = '<img src="'.$thumb_url.'" data-id="'.$thumb_id.'" class="admin-preset-image" height="200" style="height:100px; float: left; padding: 5px;" />';
			
			endforeach;
		endif;
		$display = implode( '', $display );
	
		?>
		
			<style>
				.ui-dialog.ui-widget{
					z-index:10000;
					width:800px !important;
					max-width:96%;
				}
			</style>
			<div id="dialog-canvas" title="Select You Profile Photo"> 
				<div id="pp-wrapper">   
					<?php echo $display; ?> 
				</div>
			</div>
	
		<?php	


	}
	
}
new fepp_footer;
