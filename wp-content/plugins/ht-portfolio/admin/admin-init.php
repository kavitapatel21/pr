<?php
    // HTPortfolio options menu
    if ( ! function_exists( 'htportfolio_add_adminbar_menu' ) ) {
        function htportfolio_add_adminbar_menu() {
            $menu = 'add_menu_' . 'page';
            $menu( 
                'htportfolio_panel', 
                esc_html__( 'HT Portfolio', 'htportfolio' ), 
                'read', 
                'htportfolio_menu', 
                NULL, 
                'dashicons-images-alt2', 
                40 
            );
        }
    }
    add_action( 'admin_menu', 'htportfolio_add_adminbar_menu' );

if(!function_exists('htportfolio_pagination')){
    function htportfolio_pagination(){
        ?>
        <div class="htportfolio-pagination"> <?php
            the_posts_pagination(array(
                'prev_text'          => '<i class="fa fa-angle-left"></i>',
                'next_text'          => '<i class="fa fa-angle-right"></i>',
                'type'               => 'list'
            )); ?>
        </div>
        <?php
    }
}