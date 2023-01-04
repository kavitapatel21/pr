<?php
/**
* Start Meta fields
*/
add_filter( 'cmb2_init', 'htportfolio_metaboxes' );
function htportfolio_metaboxes() {
	$prefix = '_htportfolio_';

	/**
	* Start Page options [tab]
	*/
	$page_metabox_options = array(
		'id'           		 => $prefix . '_page_optons',
		'title'        		 => esc_html__( 'Page Options', 'htportfolio' ),
		'object_types' 		 => array('post', 'page'),
		'context'      		 => 'normal',
		'priority'     		 => 'high',
		'show_names'         => true,
	);
	// Setup meta box
	$page_options = new_cmb2_box( $page_metabox_options );

	// Setting tabs
	$tabs_setting      = array(
		'config' 	=> $page_metabox_options,
		'layout' 	=> 'vertical', // Default : horizontal
		'tabs'  	=> array()
	);


//===================================
//Portfolio Metaboxes
//===================================
		$ht_portfolios = new_cmb2_box( array(
			'id'            => $prefix . 'htportfolio',
			'title'         => __( 'Portfolio Metaboxes', 'htportfolio' ),
			'object_types'  => array( 'ht_portfolios', ), // Post type
			'priority'   => 'high',
		) );
		   $ht_portfolios->add_field( array(
			'name'       => esc_html__( 'Popup Video', 'htportfolio' ),
			'desc'       => esc_html__( 'insert video link. ex-www.youtube.com/watch?v=TLnmb07WQ-s', 'htportfolio' ),
			'id'         => $prefix . 'por_video',
			'type'       => 'text_url',
		   ) );
				$group_field_id = $ht_portfolios->add_field( array(
					'id'          => $prefix . 'name_id',
					'type'        => 'group',
					'description' => esc_html__( 'Add First Entry', 'htportfolio' ),
					'options'     => array(
						'group_title'   => esc_html__( 'Left Item {#}', 'htportfolio' ), 
						'add_button'    => esc_html__( 'Add Another Entry', 'htportfolio' ),
						'remove_button' => esc_html__( 'Remove Entry', 'htportfolio' ),
						'sortable'      => true, // beta
					),
				) );

				$ht_portfolios->add_group_field( $group_field_id, array(
					'name'       => esc_html__( 'Enter Name', 'htportfolio' ),
					'id'         => 'start_name',
					'desc'       => esc_html__( 'insert title here', 'htportfolio' ),
					'type'       => 'text',
				) );				
				$ht_portfolios->add_group_field( $group_field_id, array(
					'name'       => esc_html__( 'Enter Address', 'htportfolio' ),
					'id'         => 'start_add',
					'desc'       => esc_html__( 'insert Info here', 'htportfolio' ),
					'type'       => 'text',
				) );
				
				$group_field_id = $ht_portfolios->add_field( array(
					'id'          => $prefix . 'company_id',
					'type'        => 'group',
					'description' => esc_html__( 'Add First Entry', 'htportfolio' ),
					'options'     => array(
						'group_title'   => esc_html__( 'Right Item {#}', 'htportfolio' ), 
						'add_button'    => esc_html__( 'Add Another Entry', 'htportfolio' ),
						'remove_button' => esc_html__( 'Remove Entry', 'htportfolio' ),
						'sortable'      => true, // beta
					),
				) );

				$ht_portfolios->add_group_field( $group_field_id, array(
					'name'       => esc_html__( 'Enter Name', 'htportfolio' ),
					'id'         => 'start_com',
					'desc'       => esc_html__( 'insert Second here', 'htportfolio' ),
					'type'       => 'text',
				) );				
				$ht_portfolios->add_group_field( $group_field_id, array(
					'name'       => esc_html__( 'Enter Address', 'htportfolio' ),
					'id'         => 'start_com_ad',
					'desc'       => esc_html__( 'insert info here', 'htportfolio' ),
					'type'       => 'text',
				) );
				

				$group_field_id = $ht_portfolios->add_field( array(
					'id'          => $prefix . 'single_team',
					'type'        => 'group',
					'description' => esc_html__( 'Add First Entry', 'htportfolio' ),
					'options'     => array(
						'group_title'   => esc_html__( 'Right Item {#}', 'htportfolio' ), 
						'add_button'    => esc_html__( 'Add Another Entry', 'htportfolio' ),
						'remove_button' => esc_html__( 'Remove Entry', 'htportfolio' ),
						'sortable'      => true, // beta
					),
				) );
}