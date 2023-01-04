<?php

	if( !function_exists('htportfolio_custom_post_register') ){

		function htportfolio_custom_post_register() {

			$labels = array(
                'name'                  => _x( 'Gallery', 'Post Type General Name', 'htportfolio' ),
                'singular_name'         => _x( 'Gallery', 'Post Type Singular Name', 'htportfolio' ),
                'menu_name'             => __( 'Gallery', 'htportfolio' ),
                'name_admin_bar'        => __( 'Gallery', 'htportfolio' ),
                'archives'              => __( 'Gallery Archives', 'htportfolio' ),
                'parent_item_colon'     => __( 'Parent Gallery:', 'htportfolio' ),
                'add_new_item'          => __( 'Add New Gallery', 'htportfolio' ),
                'add_new'               => __( 'Add New', 'htportfolio' ),
                'new_item'              => __( 'New Gallery', 'htportfolio' ),
                'edit_item'             => __( 'Edit Gallery', 'htportfolio' ),
                'update_item'           => __( 'Update Gallery', 'htportfolio' ),
                'view_item'             => __( 'View Gallery', 'htportfolio' ),
                'search_items'          => __( 'Search Gallery', 'htportfolio' ),
                'not_found'             => __( 'Not found', 'htportfolio' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'htportfolio' ),
                'featured_image'        => __( 'Featured Image', 'htportfolio' ),
                'set_featured_image'    => __( 'Set featured image', 'htportfolio' ),
                'remove_featured_image' => __( 'Remove featured image', 'htportfolio' ),
                'use_featured_image'    => __( 'Use as featured image', 'htportfolio' ),
                'insert_into_item'      => __( 'Insert into item', 'htportfolio' ),
                'uploaded_to_this_item' => __( 'Uploaded to this item', 'htportfolio' ),
                'items_list'            => __( 'Gallery list', 'htportfolio' ),
                'items_list_navigation' => __( 'Gallery list navigation', 'htportfolio' ),
                'filter_items_list'     => __( 'Filter items list', 'htportfolio' ),
            );

			$args = array(
				'label'                 => __( 'Gallery', 'htportfolio' ),
				'labels'                => $labels,
				'supports'              => array('title','thumbnail', ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => 'htportfolio_menu',
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-format-gallery',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => false,       
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'post',
			);

			register_post_type( 'htportfolio_gallery', $args );

			// Portfolio
			$labels = array(
				'name'                  => _x( 'Portfolio', 'Post Type General Name', 'htportfolio' ),
				'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'htportfolio' ),
				'menu_name'             => __( 'Portfolio', 'htportfolio' ),
				'name_admin_bar'        => __( 'Portfolio', 'htportfolio' ),
				'archives'              => __( 'Item Archives', 'htportfolio' ),
				'parent_item_colon'     => __( 'Parent Item:', 'htportfolio' ),
				'all_items'             => __( 'Portfolio', 'htportfolio' ),
				'add_new_item'          => __( 'Add New Item', 'htportfolio' ),
				'add_new'               => __( 'Add New', 'htportfolio' ),
				'new_item'              => __( 'New Item', 'htportfolio' ),
				'edit_item'             => __( 'Edit Item', 'htportfolio' ),
				'update_item'           => __( 'Update Item', 'htportfolio' ),
				'view_item'             => __( 'View Item', 'htportfolio' ),
				'search_items'          => __( 'Search Item', 'htportfolio' ),
				'not_found'             => __( 'Not found', 'htportfolio' ),
				'not_found_in_trash'    => __( 'Not found in Trash', 'htportfolio' ),
				'featured_image'        => __( 'Portfolio Image', 'htportfolio' ),
				'set_featured_image'    => __( 'Set featured image', 'htportfolio' ),
				'remove_featured_image' => __( 'Remove featured image', 'htportfolio' ),
				'use_featured_image'    => __( 'Use as featured image', 'htportfolio' ),
				'insert_into_item'      => __( 'Insert into item', 'htportfolio' ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', 'htportfolio' ),
				'items_list'            => __( 'Items list', 'htportfolio' ),
				'items_list_navigation' => __( 'Items list navigation', 'htportfolio' ),
				'filter_items_list'     => __( 'Filter items list', 'htportfolio' ),
			);
			$args = array(
				'label'                 => __( 'Portfolio', 'htportfolio' ),
				'labels'                => $labels,
				'supports'              => array('title','editor','thumbnail', ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => 'htportfolio_menu',
				'menu_position'         => 5,
				'menu_icon'             => 'dashicons-format-gallery',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => false,       
				'exclude_from_search'   => false,
				'publicly_queryable'    => true,
				'capability_type'       => 'post',
			);

			register_post_type( 'ht_portfolios', $args );

		}
		add_action( 'init', 'htportfolio_custom_post_register', 0 );
	}

	// Register Custom Taxonomy
	if( !function_exists('htportfolio_custom_taxonomy') ){
		function htportfolio_custom_taxonomy() {

			// Gallery category Texonomy
			$labels = array(
	            'name'              => _x( 'Gallery Categories', 'htportfolio' ),
	            'singular_name'     => _x( 'Gallery Category', 'htportfolio' ),
	            'search_items'      => esc_html__( 'Search Category' ),
	            'all_items'         => esc_html__( 'All Category' ),
	            'parent_item'       => esc_html__( 'Parent Category' ),
	            'parent_item_colon' => esc_html__( 'Parent Category:' ),
	            'edit_item'         => esc_html__( 'Edit Category' ),
	            'update_item'       => esc_html__( 'Update Category' ),
	            'add_new_item'      => esc_html__( 'Add New Category' ),
	            'new_item_name'     => esc_html__( 'New Category Name' ),
	            'menu_name'         => esc_html__( 'Gallery Category' ),
	       );
			$args = array(
	            'hierarchical'      => true,
	            'labels'            => $labels,
	            'show_ui'           => true,
	            'show_admin_column' => true,
	            'query_var'         => true,
	            'rewrite'           => array( 'slug' => 'htportfolio_gallery_cat' ),
	        );
			register_taxonomy( 'htportfolio_gallery_cat', array( 'htportfolio_gallery' ), $args );

			// Portfolio category Texonomy
			$labels = array(
				'name'                       => _x( 'Categories', 'Taxonomy General Name', 'htportfolio' ),
				'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'htportfolio' ),
				'menu_name'                  => __( 'Categories', 'htportfolio' ),
				'all_items'                  => __( 'All Items', 'htportfolio' ),
				'parent_item'                => __( 'Parent Item', 'htportfolio' ),
				'parent_item_colon'          => __( 'Parent Item:', 'htportfolio' ),
				'new_item_name'              => __( 'New Item Name', 'htportfolio' ),
				'add_new_item'               => __( 'Add New Item', 'htportfolio' ),
				'edit_item'                  => __( 'Edit Item', 'htportfolio' ),
				'update_item'                => __( 'Update Item', 'htportfolio' ),
				'view_item'                  => __( 'View Item', 'htportfolio' ),
				'separate_items_with_commas' => __( 'Separate items with commas', 'htportfolio' ),
				'add_or_remove_items'        => __( 'Add or remove items', 'htportfolio' ),
				'choose_from_most_used'      => __( 'Choose from the most used', 'htportfolio' ),
				'popular_items'              => __( 'Popular Items', 'htportfolio' ),
				'search_items'               => __( 'Search Items', 'htportfolio' ),
				'not_found'                  => __( 'Not Found', 'htportfolio' ),
				'no_terms'                   => __( 'No items', 'htportfolio' ),
				'items_list'                 => __( 'Items list', 'htportfolio' ),
				'items_list_navigation'      => __( 'Items list navigation', 'htportfolio' ),
			);
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
			);
			register_taxonomy( 'ht_portfolios_cat', array( 'ht_portfolios' ), $args );

		}
		add_action( 'init', 'htportfolio_custom_taxonomy', 0 );

	}


?>