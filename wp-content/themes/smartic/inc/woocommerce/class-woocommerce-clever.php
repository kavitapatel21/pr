<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Smartic_WooCommerce_Clever')) :


    class Smartic_WooCommerce_Clever {
        public function __construct() {
            $this->add_hook();


        }

        public function add_hook() {
            if (function_exists('woosq_init')) {
                add_filter('woosq_button_position', '__return_false');
                add_action('smartic_woocommerce_product_loop_action', 'quickview_button', 20);
                add_action('smartic_woocommerce_after_shop_loop_item_title', 'quickview_button', 40);
            }
            if (function_exists('woosc_init')) {
                add_filter('woosc_button_position_archive', '__return_false');
                add_action('smartic_woocommerce_product_loop_action', 'compare_button', 15);

                add_filter('woosc_button_position_single', '__return_false');
                add_action('woocommerce_after_add_to_cart_button', 'compare_button', 20);
                add_action('smartic_woocommerce_after_shop_loop_item_title', 'compare_button', 35);

            }
            if (function_exists('woosw_init')) {
                add_filter('woosw_button_position_archive', '__return_false');
                add_action('smartic_woocommerce_product_loop_action', 'wishlist_button', 10);

                add_filter('woosw_button_position_single', '__return_false');
                add_action('woocommerce_after_add_to_cart_button', 'wishlist_button', 10);
                add_action('smartic_woocommerce_after_shop_loop_item_title', 'wishlist_button', 30);

            }
        }

        public function register_required_plugins() {
            /**
             * Array of plugin arrays. Required keys are name and slug.
             * If the source is NOT from the .org repo, then source is also required.
             */
            $plugins = array(
                array(
                    'name'     => 'WPC Smart Compare for WooCommerce',
                    'slug'     => 'woo-smart-compare',
                    'required' => false,
                ),
                array(
                    'name'     => 'WPC Smart Wishlist for WooCommerce',
                    'slug'     => 'woo-smart-wishlist',
                    'required' => false,
                ),
                array(
                    'name'     => 'WPC Smart Quick View for WooCommerce',
                    'slug'     => 'woo-smart-quick-view',
                    'required' => false,
                ),
            );

            /*
             * Array of configuration settings. Amend each line as needed.
             *
             * TGMPA will start providing localized text strings soon. If you already have translations of our standard
             * strings available, please help us make TGMPA even better by giving us access to these translations or by
             * sending in a pull-request with .po file(s) with the translations.
             *
             * Only uncomment the strings in the config array if you want to customize the strings.
             */
            $config = array(
                'id'           => 'smartic',
                // Unique ID for hashing notices for multiple instances of TGMPA.
                'default_path' => '',
                // Default absolute path to bundled plugins.
                'menu'         => 'tgmpa-install-plugins',
                // Menu slug.
                'has_notices'  => true,
                // Show admin notices or not.
                'dismissable'  => true,
                // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',
                // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,
                // Automatically activate plugins after installation or not.
                'message'      => '',
            );
            tgmpa($plugins, $config);
        }

    }

    return new Smartic_WooCommerce_Clever();
endif;
