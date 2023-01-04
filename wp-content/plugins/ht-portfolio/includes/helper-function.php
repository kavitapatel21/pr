<?php

namespace Elementor;

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit();

/**
 * Elementor category
 */
function htportfolio_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'htportfolio',
        [
            'title'  => 'HT Portfolio',
            'icon' => 'font'
        ],
        1
    );
}
add_action('elementor/init','Elementor\htportfolio_elementor_init');

// Gallery Category
function htportfolio_gallery_categories(){
    $terms = get_terms( array(
        'taxonomy' => 'htportfolio_gallery_cat',
        'hide_empty' => true,
    ));
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->slug ] = $term->name;
        }
        return $options;
    }
}

// Portfolio Category
function ht_portfolios_categories(){
    $terms = get_terms( array(
        'taxonomy' => 'ht_portfolios_cat',
        'hide_empty' => true,
    ));
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->slug ] = $term->name;
        }
        return $options;
    }
}

/*Post Veiw count*/
if(!function_exists('htportfolio_getPostViews')){
    function htportfolio_getPostViews($post_ID) {
        $count_key = 'post_views_count'; 
        $count = get_post_meta($post_ID, $count_key, true); 
        if($count == ''){
            $count = 0; 
            delete_post_meta($post_ID, $count_key);        
            add_post_meta($post_ID, $count_key, '0');
            return $count;   
        }

        else{
            $count++; 
            update_post_meta($post_ID, $count_key, $count);
           if($count == '1'){
            return $count ;
            }
            else {
            return $count;
            }
        }
    }
}

// Blog Category
function htportfolio_blog_categories(){
    $terms = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => true,
    ));
    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $options[ $term->slug ] = $term->name;
        }
        return $options;
    }
}