<?php

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit();

if ( !class_exists( 'HTPortfolio_Addons_Init' ) ) {
    class HTPortfolio_Addons_Init{
        
        public function __construct(){
            

            // Init Widgets
            if ( htportfolio_is_elementor_version( '>=', '3.5.0' ) ) {
                add_action( 'elementor/widgets/register', array( $this, 'htportfolio_includes_widgets' ) );
            }else{
                add_action( 'elementor/widgets/widgets_registered', array( $this, 'htportfolio_includes_widgets' ) );
            }            
        }
            // Include Widgets File
            public function htportfolio_includes_widgets(){
                
            if ( file_exists( HTPORTFOLIO_ADDONS_PL_PATH.'includes/widgets/htportfolio_gallery_addons.php' ) ) {
                require_once HTPORTFOLIO_ADDONS_PL_PATH.'includes/widgets/htportfolio_gallery_addons.php';
            }
            if ( file_exists( HTPORTFOLIO_ADDONS_PL_PATH.'includes/widgets/htportfolio_portfolio_addons.php' ) ) {
                require_once HTPORTFOLIO_ADDONS_PL_PATH.'includes/widgets/htportfolio_portfolio_addons.php';
            }

        }
}
    new HTPortfolio_Addons_Init();
}

// enqueue scripts
add_action( 'wp_enqueue_scripts','htportfolio_enqueue_scripts');
function  htportfolio_enqueue_scripts(){
    // enqueue styles
    wp_enqueue_style( 'bootstrap', HTPORTFOLIO_ADDONS_PL_URL . 'assets/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', HTPORTFOLIO_ADDONS_PL_URL . 'assets/css/font-awesome.min.css');
    wp_enqueue_style( 'fancybox', HTPORTFOLIO_ADDONS_PL_URL . 'assets/css/jquery.fancybox.css');
    wp_enqueue_style( 'magnific-popup', HTPORTFOLIO_ADDONS_PL_URL . 'assets/css/magnific-popup.css');
    wp_enqueue_style( 'htportfolio-vendors', HTPORTFOLIO_ADDONS_PL_URL.'assets/css/htportfolio-vendors.css');
    wp_enqueue_style( 'htportfolio-widgets', HTPORTFOLIO_ADDONS_PL_URL.'assets/css/htportfolio-widgets.css');
   
    // enqueue js
     wp_enqueue_script( 'fancybox', HTPORTFOLIO_ADDONS_PL_URL . 'assets/js/jquery.fancybox.min.js', array('jquery'), '3.1.20', true);
     wp_enqueue_script( 'waypoints', HTPORTFOLIO_ADDONS_PL_URL . 'assets/js/waypoints.js', array('jquery'), '4.0.1', true);
     wp_enqueue_script( 'counterup', HTPORTFOLIO_ADDONS_PL_URL . 'assets/js/jquery.counterup.js', array('jquery'), '3.1.20', true);
     wp_enqueue_script( 'magnific-popup', HTPORTFOLIO_ADDONS_PL_URL . 'assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', false);
     wp_enqueue_script( 'isotope', HTPORTFOLIO_ADDONS_PL_URL.'assets/js/isotope.pkgd.min.js', array('jquery'), '3.0.3',false );
     wp_enqueue_script( 'imagesloaded' );    
     wp_enqueue_script( 'popper', HTPORTFOLIO_ADDONS_PL_URL . 'assets/js/popper.min.js', array('jquery'), '1.0.0', true);    
     wp_enqueue_script( 'bootstrap', HTPORTFOLIO_ADDONS_PL_URL . 'assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);    
     wp_enqueue_script( 'htportfolio-active', HTPORTFOLIO_ADDONS_PL_URL.'assets/js/htportfolio-jquery-widgets-active.js', array('jquery'), '', true);
}
add_action('init','htportfolio_size');
function htportfolio_size(){
    add_image_size('htportfolio_img1170x600',1170,600,true);
    add_image_size('htportfolio_img580x436',580,436,true);
    add_image_size('htportfolio_img370x410',370,410,true);
    add_image_size('htportfolio_img162x100',162,100,true);
}