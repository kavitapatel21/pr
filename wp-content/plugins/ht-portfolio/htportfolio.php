<?php
/**
 * Plugin Name: HT Portfolio
 * Description: The Portfolio For WP Widget Elementor is a elementor addons for WordPress. This plugin extend Elementor by adding the Post Grid, Portfolio & Menu Filterable Image Gallery widgets for free!
 * Plugin URI: https://htplugins.com/
 * Version: 1.1.5
 * Author: HT Plugins
 * Author URI: https://profiles.wordpress.org/htplugins/
 * License:  GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: htportfolio
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'HTPORTFOLIO_VERSION', '1.1.5' );
define( 'HTPORTFOLIO_ADDONS_PL_URL', plugins_url( '/', __FILE__ ) );
define( 'HTPORTFOLIO_ADDONS_PL_PATH', plugin_dir_path( __FILE__ ) );
define( 'HTPORTFOLIO_ADDONS_PL_ROOT', __FILE__ );

// Required File
require_once HTPORTFOLIO_ADDONS_PL_PATH.'includes/helper-function.php';
require_once HTPORTFOLIO_ADDONS_PL_PATH.'init.php';
require_once HTPORTFOLIO_ADDONS_PL_PATH.'admin/init.php';


// Portfolio Single page
add_filter('single_template', 'htportfolio_single_portfolio_template_modify');

function htportfolio_single_portfolio_template_modify($single) {

    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'ht_portfolios' ) {
        if ( file_exists( HTPORTFOLIO_ADDONS_PL_PATH . '/includes/single-ht_portfolios.php' ) ) {
            return HTPORTFOLIO_ADDONS_PL_PATH . '/includes/single-ht_portfolios.php';
        }
    }
    return $single;
}

/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 *
 * @return mixed
 */
function htportfolio_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}

// Check Plugins is Installed or not
function htportfolio_is_plugins_active( $pl_file_path = NULL ){
    $installed_plugins_list = get_plugins();
    return isset( $installed_plugins_list[$pl_file_path] );
}
// This notice for Elementor is not installed or activated or both.
function htportfolio_check_elementor_status(){
    $elementor = 'elementor/elementor.php';
    if( htportfolio_is_plugins_active($elementor) ) {
        if( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }
        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );
        $message = __( '<strong>HT Portfolio Addons for Elementor</strong> Requires Elementor plugin to be active. Please activate Elementor to continue.', 'htportfolio' );
        $button_text = __( 'Activate Elementor', 'htportfolio' );
    } else {
        if( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }
        $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
        $message = sprintf( __( '<strong>htportfolio Addons for Elementor</strong> requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', 'htportfolio' ), '<strong>', '</strong>' );
        $button_text = __( 'Install Elementor', 'htportfolio' );
    }
    $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';
    printf( '<div class="error"><p>%1$s</p>%2$s</div>', __( $message ), $button );
}

if( ! did_action( 'elementor/loaded' ) ) {
    add_action( 'admin_init', 'htportfolio_check_elementor_status' );
}


// include cmb2 lib
if(  ! class_exists( 'CMB2_Bootstrap_270_Develop' ) ) {
    require_once( HTPORTFOLIO_ADDONS_PL_PATH. '/admin/cmb2/init.php');
}

/*
 * Display tabs related to gallery in admin when user
 * viewing/editing gallery/category.
 */
function htportfolio_gallery_tabs($view) {
    if ( ! is_admin() ) {
        return;
    }
    $admin_tabs = apply_filters(
        'htportfolio_gallery_tabs_info',
        array(

            10 => array(
                "link" => "edit.php?post_type=htportfolio_gallery",
                "name" => __( "Gallery", "htportfolio" ),
                "id"   => "edit-htportfolio_gallery",
            ),

            20 => array(
                "link" => "edit-tags.php?taxonomy=htportfolio_gallery_cat&post_type=htportfolio_gallery",
                "name" => __( "Categories", "htportfolio" ),
                "id"   => "edit-htportfolio_gallery_cat",
            ),

        )
    );
    ksort( $admin_tabs );
    $tabs = array();
    foreach ( $admin_tabs as $key => $value ) {
        array_push( $tabs, $key );
    }
    $pages = apply_filters(
        'htportfolio_gallery_admin_tabs_on_pages',
        array( 'edit-htportfolio_gallery', 'edit-htportfolio_gallery_cat', 'edit-gallery_tag', 'htportfolio_gallery' )
    );
    $admin_tabs_on_page = array();
    foreach ( $pages as $page ) {
        $admin_tabs_on_page[ $page ] = $tabs;
    }
    $current_page_id = get_current_screen()->id;
    $current_user    = wp_get_current_user();
    if ( ! in_array( 'administrator', $current_user->roles ) ) {
        return;
    }
    if ( ! empty( $admin_tabs_on_page[ $current_page_id ] ) && count( $admin_tabs_on_page[ $current_page_id ] ) ) {
        echo '<h2 class="nav-tab-wrapper lp-nav-tab-wrapper">';
        foreach ( $admin_tabs_on_page[ $current_page_id ] as $admin_tab_id ) {

            $class = ( $admin_tabs[ $admin_tab_id ]["id"] == $current_page_id ) ? "nav-tab nav-tab-active" : "nav-tab";
            echo '<a href="' . admin_url( $admin_tabs[ $admin_tab_id ]["link"] ) . '" class="' . $class . ' nav-tab-' . $admin_tabs[ $admin_tab_id ]["id"] . '">' . $admin_tabs[ $admin_tab_id ]["name"] . '</a>';
        }
        echo '</h2>';
    }
    return $view;
}

add_filter( 'views_edit-htportfolio_gallery', 'htportfolio_gallery_tabs' );
add_action('htportfolio_gallery_cat_pre_add_form','htportfolio_gallery_tabs');



/*
 * Display tabs related to Portfolio in admin when user
 * viewing/editing Portfolio/category.
 */
function ht_portfolios_tabs($view) {
    if ( ! is_admin() ) {
        return;
    }
    $admin_tabs = apply_filters(
        'ht_portfolios_tabs_info',
        array(

            10 => array(
                "link" => "edit.php?post_type=ht_portfolios",
                "name" => __( "Portfolio", "htportfolio" ),
                "id"   => "edit-ht_portfolios",
            ),

            20 => array(
                "link" => "edit-tags.php?taxonomy=ht_portfolios_cat&post_type=ht_portfolios",
                "name" => __( "Categories", "htportfolio" ),
                "id"   => "edit-ht_portfolios_cat",
            ),

        )
    );
    ksort( $admin_tabs );
    $tabs = array();
    foreach ( $admin_tabs as $key => $value ) {
        array_push( $tabs, $key );
    }
    $pages = apply_filters(
        'ht_portfolios_admin_tabs_on_pages',
        array( 'edit-ht_portfolios', 'edit-ht_portfolios_cat', 'edit-portfolio_tag', 'ht_portfolios' )
    );
    $admin_tabs_on_page = array();
    foreach ( $pages as $page ) {
        $admin_tabs_on_page[ $page ] = $tabs;
    }

    $current_page_id = get_current_screen()->id;
    $current_user    = wp_get_current_user();
    if ( ! in_array( 'administrator', $current_user->roles ) ) {
        return;
    }
    if ( ! empty( $admin_tabs_on_page[ $current_page_id ] ) && count( $admin_tabs_on_page[ $current_page_id ] ) ) {
        echo '<h2 class="nav-tab-wrapper lp-nav-tab-wrapper">';
        foreach ( $admin_tabs_on_page[ $current_page_id ] as $admin_tab_id ) {

            $class = ( $admin_tabs[ $admin_tab_id ]["id"] == $current_page_id ) ? "nav-tab nav-tab-active" : "nav-tab";
            echo '<a href="' . admin_url( $admin_tabs[ $admin_tab_id ]["link"] ) . '" class="' . $class . ' nav-tab-' . $admin_tabs[ $admin_tab_id ]["id"] . '">' . $admin_tabs[ $admin_tab_id ]["name"] . '</a>';
        }
        echo '</h2>';
    }
    return $view;
}

add_filter( 'views_edit-ht_portfolios', 'ht_portfolios_tabs' );
add_action('ht_portfolios_cat_pre_add_form','ht_portfolios_tabs');


add_action( 'wsa_form_bottom_htportfolio_pro_themes', 'htportfolio_pro_tab_advertise' );

function htportfolio_pro_tab_advertise(){

    echo "<ul class='htportfolio_pro_tab'>";

       echo '<li> <a target="_blank" href="https://themeforest.net/item/minimax-minimal-portfolio-wordpress-theme/19501562"><img alt="Minimax  Minimal portfolio" src="https://themeforest.img.customer.envatousercontent.com/files/264903959/01_preview_minimax-preview.__large_preview.png?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=b23c4bd8f756280fc31261e47236dde5"></a>
       <h3> <a target="_blank" href="https://themeforest.net/item/minimax-minimal-portfolio-wordpress-theme/19501562">'.
        __( "Minimax - Minimal portfolio WordPress Theme","htportfolio").'</a></h3>
       </li>';

       echo '<li> <a target="_blank" href="https://themeforest.net/item/minikini-minimal-portfolio-wordpress-theme/20316110?s_rank=21"><img alt="Minikini  Minimal portfolio" src="https://themeforest.img.customer.envatousercontent.com/files/266371255/minikiniem-wp-preview.__large_preview.jpg?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=eb23e0ac6ba75eda664869fc6898432c"></a>
       <h3> <a target="_blank" href="https://themeforest.net/item/minikini-minimal-portfolio-wordpress-theme/20316110?s_rank=21">'.
        __( "Minikini - Minimal Portfolio WordPress Theme","htportfolio").'</a></h3>
       </li>';

       echo '<li> <a target="_blank" href="https://themeforest.net/item/minifo-minimal-portfolio-wordpress-theme/20097135?s_rank=23"><img alt="Minifo  Minimal portfolio" src="https://themeforest.img.customer.envatousercontent.com/files/264951006/minifo-preciew-8.__large_preview.jpg?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=da1123f6c052214a5cb41b45b1ba1527"></a>
       <h3> <a target="_blank" href="https://themeforest.net/item/minifo-minimal-portfolio-wordpress-theme/20097135?s_rank=23">'.
        __( "Minifo - Minimal Portfolio WordPress Theme","htportfolio").'</a></h3> </li>';
        
       echo '<li> <a target="_blank" href="https://themeforest.net/item/redleaf-minimal-portfolio-wordpress-theme/19413347?s_rank=25"><img alt="Redleaf  Minimal portfolio" src="https://themeforest.img.customer.envatousercontent.com/files/270567356/01_redleaf-preview.__large_preview.jpg?auto=compress%2Cformat&q=80&fit=crop&crop=top&max-h=8000&max-w=590&s=9afeb35c7170c5cf9b4610321c9c4c86"></a> 
       <h3> <a target="_blank" href="https://themeforest.net/item/redleaf-minimal-portfolio-wordpress-theme/19413347?s_rank=25">'.
        __( "Redleaf - Minimal portfolio WordPress Theme","htportfolio").'</a></h3></li>';

    echo "</ul>";
}


/**
* Elementor Version check
* Return boolean value
*/
function htportfolio_is_elementor_version( $operator = '<', $version = '2.6.0' ) {
    return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
}

// Compatibility with elementor version 3.6.1
function htportfolio_widget_register_manager($widget_class){
    $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
    
    if ( htportfolio_is_elementor_version( '>=', '3.5.0' ) ){
        $widgets_manager->register( $widget_class );
    }else{
        $widgets_manager->register_widget_type( $widget_class );
    }
}