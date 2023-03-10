<?php

if (!function_exists('smartic_before_content')) {
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     *
     * @return  void
     * @since   1.0.0
     */
    function smartic_before_content() {
        echo <<<HTML
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
HTML;

    }
}


if (!function_exists('smartic_after_content')) {
    /**
     * After Content
     * Closes the wrapping divs
     *
     * @return  void
     * @since   1.0.0
     */
    function smartic_after_content() {
        echo <<<HTML
	</main><!-- #main -->
</div><!-- #primary -->
HTML;

        do_action('smartic_sidebar');
    }
}

if (!function_exists('smartic_cart_link_fragment')) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param array $fragments Fragments to refresh via AJAX.
     *
     * @return array            Fragments to refresh via AJAX
     */
    function smartic_cart_link_fragment($fragments) {
        ob_start();
        smartic_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        ob_start();
        smartic_handheld_footer_bar_cart_link();
        $fragments['a.footer-cart-contents'] = ob_get_clean();

        return $fragments;
    }
}

if (!function_exists('smartic_cart_link')) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function smartic_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'smartic'); ?>">
            <?php /* translators: %d: number of items in cart */ ?>
            <span class="count"><?php echo wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'smartic'), WC()->cart->get_cart_contents_count())); ?></span>
            <?php echo WC()->cart->get_cart_subtotal(); ?>
        </a>
        <?php
    }
}

if (!function_exists('smartic_product_search')) {
    /**
     * Display Product Search
     *
     * @return void
     * @uses  smartic_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function smartic_product_search() {
        if (smartic_is_woocommerce_activated()) {
            ?>
            <div class="site-search">
                <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('smartic_header_cart')) {
    /**
     * Display Header Cart
     *
     * @return void
     * @uses  smartic_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function smartic_header_cart() {
        if (smartic_is_woocommerce_activated()) {
            ?>
            <div class="site-header-cart menu">
                <?php smartic_cart_link(); ?>
                <?php

                if (!apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) {
                    wp_enqueue_script('smartic-cart-canvas');
                    add_action('wp_footer', 'smartic_header_cart_side');
                }
                ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('smartic_header_cart_side')) {
    function smartic_header_cart_side() {
        if (smartic_is_woocommerce_activated()) {
            ?>
            <div class="site-header-cart-side">
                <div class="cart-side-heading">
                    <span class="cart-side-title"><?php echo esc_html__('Shopping cart', 'smartic'); ?></span>
                    <a href="#" class="close-cart-side"><?php echo esc_html__('close', 'smartic') ?></a></div>
                <?php the_widget('WC_Widget_Cart', 'title='); ?>
            </div>
            <div class="cart-side-overlay"></div>
            <?php
        }
    }
}

if (!function_exists('smartic_upsell_display')) {
    /**
     * Upsells
     * Replace the default upsell function with our own which displays the correct number product columns
     *
     * @return  void
     * @since   1.0.0
     * @uses    woocommerce_upsell_display()
     */
    function smartic_upsell_display() {
        $columns = apply_filters('smartic_upsells_columns', 4);
        if (is_active_sidebar('sidebar-woocommerce-detail')) {
            $columns = 3;
        }
        woocommerce_upsell_display(-1, $columns);
    }
}

if (!function_exists('smartic_sorting_wrapper')) {
    /**
     * Sorting wrapper
     *
     * @return  void
     * @since   1.4.3
     */
    function smartic_sorting_wrapper() {
        echo '<div class="smartic-sorting">';
    }
}

if (!function_exists('smartic_sorting_wrapper_close')) {
    /**
     * Sorting wrapper close
     *
     * @return  void
     * @since   1.4.3
     */
    function smartic_sorting_wrapper_close() {
        echo '</div>';
    }
}

if (!function_exists('smartic_product_columns_wrapper')) {
    /**
     * Product columns wrapper
     *
     * @return  void
     * @since   2.2.0
     */
    function smartic_product_columns_wrapper() {
        $columns = smartic_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}

if (!function_exists('smartic_loop_columns')) {
    /**
     * Default loop columns on product archives
     *
     * @return integer products per row
     * @since  1.0.0
     */
    function smartic_loop_columns() {
        $columns = 3; // 3 products per row

        if (function_exists('wc_get_default_products_per_row')) {
            $columns = wc_get_default_products_per_row();
        }

        return apply_filters('smartic_loop_columns', $columns);
    }
}

if (!function_exists('smartic_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close
     *
     * @return  void
     * @since   2.2.0
     */
    function smartic_product_columns_wrapper_close() {
        echo '</div>';
    }
}

if (!function_exists('smartic_shop_messages')) {
    /**
     * ThemeBase shop messages
     *
     * @since   1.4.4
     * @uses    smartic_do_shortcode
     */
    function smartic_shop_messages() {
        if (!is_checkout()) {
            echo smartic_do_shortcode('woocommerce_messages');
        }
    }
}

if (!function_exists('smartic_woocommerce_pagination')) {
    /**
     * ThemeBase WooCommerce Pagination
     * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
     * but since ThemeBase adds pagination before that function is excuted we need a separate function to
     * determine whether or not to display the pagination.
     *
     * @since 1.4.4
     */
    function smartic_woocommerce_pagination() {
        if (woocommerce_products_will_display()) {
            woocommerce_pagination();
        }
    }
}

if (!function_exists('smartic_handheld_footer_bar')) {
    /**
     * Display a menu intended for use on handheld devices
     *
     * @since 2.0.0
     */
    function smartic_handheld_footer_bar() {
        $links = array(
            'shop'       => array(
                'priority' => 5,
                'callback' => 'smartic_handheld_footer_bar_shop_link',
            ),
            'my-account' => array(
                'priority' => 10,
                'callback' => 'smartic_handheld_footer_bar_account_link',
            ),
            'search'     => array(
                'priority' => 20,
                'callback' => 'smartic_handheld_footer_bar_search',
            ),
            'wishlist'   => array(
                'priority' => 30,
                'callback' => 'smartic_handheld_footer_bar_wishlist',
            ),
        );

        if (wc_get_page_id('myaccount') === -1) {
            unset($links['my-account']);
        }

        if (!function_exists('yith_wcwl_count_all_products')) {
            unset($links['wishlist']);
        }

        $links = apply_filters('smartic_handheld_footer_bar_links', $links);
        ?>
        <div class="smartic-handheld-footer-bar">
            <ul class="columns-<?php echo count($links); ?>">
                <?php foreach ($links as $key => $link) : ?>
                    <li class="<?php echo esc_attr($key); ?>">
                        <?php
                        if ($link['callback']) {
                            call_user_func($link['callback'], $key, $link);
                        }
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}

if (!function_exists('smartic_handheld_footer_bar_search')) {
    /**
     * The search callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function smartic_handheld_footer_bar_search() {
        echo '<a href=""><span class="title">' . esc_attr__('Search', 'smartic') . '</span></a>';
        smartic_product_search();
    }
}

if (!function_exists('smartic_handheld_footer_bar_cart_link')) {
    /**
     * The cart callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function smartic_handheld_footer_bar_cart_link() {
        ?>
        <a class="footer-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'smartic'); ?>">
            <span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('smartic_handheld_footer_bar_account_link')) {
    /**
     * The account callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function smartic_handheld_footer_bar_account_link() {
        echo '<a href="' . esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) . '"><span class="title">' . esc_attr__('My Account', 'smartic') . '</span></a>';
    }
}

if (!function_exists('smartic_handheld_footer_bar_shop_link')) {
    /**
     * The shop callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function smartic_handheld_footer_bar_shop_link() {
        echo '<a href="' . esc_url(get_permalink(get_option('woocommerce_shop_page_id'))) . '"><span class="title">' . esc_attr__('Shop', 'smartic') . '</span></a>';
    }
}

if (!function_exists('smartic_handheld_footer_bar_wishlist')) {
    /**
     * The wishlist callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function smartic_handheld_footer_bar_wishlist() {
        if (function_exists('yith_wcwl_count_all_products')) {
            ?>
            <a class="footer-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
                <span class="title"><?php echo esc_html__('Wishlist', 'smartic'); ?></span>
                <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
            </a>
            <?php
        } elseif (function_exists('woosw_init')) {
            $key = WPCleverWoosw::get_key();

            ?>
            <a class="footer-wishlist" href="<?php echo esc_url(WPCleverWoosw::get_url($key, true)); ?>">
                <span class="title"><?php echo esc_html__('Wishlist', 'smartic'); ?></span>
                <span class="count"><?php echo esc_html(WPCleverWoosw::get_count($key)); ?></span>
            </a>
            <?php
        }
    }
}

if (!function_exists('smartic_single_product_pagination')) {
    /**
     * Single Product Pagination
     *
     * @since 2.3.0
     */
    function smartic_single_product_pagination() {

        // Show only products in the same category?
        $in_same_term   = apply_filters('smartic_single_product_pagination_same_category', true);
        $excluded_terms = apply_filters('smartic_single_product_pagination_excluded_terms', '');
        $taxonomy       = apply_filters('smartic_single_product_pagination_taxonomy', 'product_cat');

        $previous_product = smartic_get_previous_product($in_same_term, $excluded_terms, $taxonomy);
        $next_product     = smartic_get_next_product($in_same_term, $excluded_terms, $taxonomy);

        if ((!$previous_product && !$next_product) || !is_product()) {
            return;
        }

        ?>
        <div class="smartic-product-pagination-wrap">
            <nav class="smartic-product-pagination" aria-label="<?php esc_attr_e('More products', 'smartic'); ?>">
                <?php if ($previous_product) : ?>
                    <a href="<?php echo esc_url($previous_product->get_permalink()); ?>" rel="prev">
                        <span class="pagination-prev "><i class="smartic-icon-arrow-circle-left"></i></span>
                        <div class="product-item">
                            <?php echo sprintf('%s', $previous_product->get_image()); ?>
                            <div class="smartic-product-pagination-content">
                                <span class="smartic-product-pagination__title"><?php echo sprintf('%s', $previous_product->get_name()); ?></span>
                                <?php if ($price_html = $previous_product->get_price_html()) :
                                    printf('<span class="price">%s</span>', $price_html);
                                endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($next_product) : ?>
                    <a href="<?php echo esc_url($next_product->get_permalink()); ?>" rel="next">
                        <span class="pagination-next"><i class="smartic-icon-arrow-circle-right"></i></span>
                        <div class="product-item">
                            <?php echo sprintf('%s', $next_product->get_image()); ?>
                            <div class="smartic-product-pagination-content">
                                <span class="smartic-product-pagination__title"><?php echo sprintf('%s', $next_product->get_name()); ?></span>
                                <?php if ($price_html = $next_product->get_price_html()) :
                                    printf('<span class="price">%s</span>', $price_html);
                                endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </nav><!-- .smartic-product-pagination -->
        </div>
        <?php

    }
}

if (!function_exists('smartic_sticky_single_add_to_cart')) {
    /**
     * Sticky Add to Cart
     *
     * @since 2.3.0
     */
    function smartic_sticky_single_add_to_cart() {
        global $product;

        if (!is_product()) {
            return;
        }

        $show = false;

        if ($product->is_purchasable() && $product->is_in_stock()) {
            $show = true;
        } else if ($product->is_type('external')) {
            $show = true;
        }

        if (!$show) {
            return;
        }

        $params = apply_filters(
            'smartic_sticky_add_to_cart_params', array(
                'trigger_class' => 'entry-summary',
            )
        );

        wp_localize_script('smartic-sticky-add-to-cart', 'smartic_sticky_add_to_cart_params', $params);
        ?>

        <section class="smartic-sticky-add-to-cart">
            <div class="col-full">
                <div class="smartic-sticky-add-to-cart__content">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                    <div class="smartic-sticky-add-to-cart__content-product-info">
						<span class="smartic-sticky-add-to-cart__content-title"><?php esc_attr_e('You\'re viewing:', 'smartic'); ?>
							<strong><?php the_title(); ?></strong></span>
                        <span class="smartic-sticky-add-to-cart__content-price"><?php echo sprintf('%s', $product->get_price_html()); ?></span>
                        <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                    </div>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="smartic-sticky-add-to-cart__content-button button alt">
                        <?php echo esc_attr($product->add_to_cart_text()); ?>
                    </a>
                </div>
            </div>
        </section><!-- .smartic-sticky-add-to-cart -->
        <?php
    }
}

if (!function_exists('smartic_woocommerce_product_loop_start')) {
    function smartic_woocommerce_product_loop_start() {
        echo '<div class="product-block">';
    }
}

if (!function_exists('smartic_woocommerce_product_loop_end')) {
    function smartic_woocommerce_product_loop_end() {
        echo '</div>';
    }
}

if (!function_exists('smartic_woocommerce_product_caption_start')) {
    function smartic_woocommerce_product_caption_start() {
        echo '<div class="product-caption">';
    }
}

if (!function_exists('smartic_woocommerce_product_caption_end')) {
    function smartic_woocommerce_product_caption_end() {
        echo '</div>';
    }
}

if (!function_exists('smartic_woocommerce_product_loop_image')) {
    function smartic_woocommerce_product_loop_image() {
        ?>
        <div class="product-transition"><?php do_action('smartic_woocommerce_product_loop_image') ?></div>
        <?php
    }
}

if (!function_exists('smartic_woocommerce_product_loop_action')) {
    function smartic_woocommerce_product_loop_action() {
        ?>
        <div class="group-action">
            <div class="shop-action">
                <?php do_action('smartic_woocommerce_product_loop_action'); ?>
            </div>
        </div>
        <?php
    }
}
if (!function_exists('smartic_stock_label')) {
    function smartic_stock_label() {
        global $product;
        if ($product->is_in_stock()) {
            echo '<span class="inventory_status">' . esc_html__('In stock', 'smartic') . '</span>';
        } else {
            echo '<span class="inventory_status out-stock">' . esc_html__('Out of stock', 'smartic') . '</span>';
        }
    }
}


if (!function_exists('smartic_woocommerce_product_gallery_image')) {
    function smartic_woocommerce_product_gallery_image() {
        /**
         * @var $product WC_Product
         */
        global $product;
        $gallery = $product->get_gallery_image_ids();
        if (count($gallery) > 0) {
            $size = apply_filters('woocommerce_product_loop_size', 'woocommerce_thumbnail');
            echo '<div class="woocommerce-loop-product__gallery">';
            $url1    = wp_get_attachment_image_src($product->get_image_id(), $size);
            $srcset1 = wp_get_attachment_image_srcset($product->get_image_id(), $size);

            echo '<span class="gallery_item active" data-image="' . $url1[0] . '"  data-scrset="' . $srcset1 . '">' . $product->get_image('thumbnail') . '</span>';
            foreach ($gallery as $attachment_id) {
                $url    = wp_get_attachment_image_src($attachment_id, $size);
                $srcset = wp_get_attachment_image_srcset($attachment_id, $size);
                echo '<span class="gallery_item" data-image="' . $url[0] . '" data-scrset="' . $srcset . '">' . wp_get_attachment_image($attachment_id, 'thumbnail') . '</span>';
            }
            echo '</div>';
        }
    }
}

if (!function_exists('smartic_template_loop_product_thumbnail')) {
    function smartic_template_loop_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0) {
        global $product;
        if (!$product) {
            return '';
        }
        $gallery    = $product->get_gallery_image_ids();
        $hover_skin = smartic_get_theme_option('woocommerce_product_hover', 'none');
        if ($hover_skin == 'none' || count($gallery) <= 0) {
            echo '<div class="product-image">' . $product->get_image('woocommerce_thumbnail') . '</div>';

            return '';
        }
        $image_featured = '<div class="product-image">' . $product->get_image('woocommerce_thumbnail') . '</div>';
        $image_featured .= '<div class="product-image second-image">' . wp_get_attachment_image($gallery[0], 'woocommerce_thumbnail') . '</div>';

        echo <<<HTML
<div class="product-img-wrap {$hover_skin}">
    <div class="inner">
        {$image_featured}
    </div>
</div>
HTML;
    }
}

if (!function_exists('smartic_template_loop_product_thumbnail_special')) {
    function smartic_template_loop_product_thumbnail_special($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0) {
        global $product;
        if ($product) {
            echo '<div class="product-image">' . $product->get_image('woocommerce_thumbnail') . '</div>';
        }
    }
}

if (!function_exists('smartic_woocommerce_single_product_image_thumbnail_html')) {
    function smartic_woocommerce_single_product_image_thumbnail_html($image, $attachment_id) {
        return wc_get_gallery_image_html($attachment_id, true);
    }
}

if (!function_exists('woocommerce_template_loop_product_title')) {

    /**
     * Show the product title in the product loop.
     */
    function woocommerce_template_loop_product_title() {
        echo '<h3 class="woocommerce-loop-product__title"><a href="' . esc_url_raw(get_the_permalink()) . '">' . get_the_title() . '</a></h3>';
    }
}

if (!function_exists('smartic_woocommerce_get_product_category')) {
    function smartic_woocommerce_get_product_category() {
        global $product;
        echo wc_get_product_category_list($product->get_id(), ', ', '<div class="posted-in">', '</div>');
    }
}

if (!function_exists('smartic_woocommerce_get_product_description')) {
    function smartic_woocommerce_get_product_description() {
        global $post;

        $short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo sprintf('%s', $short_description); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('smartic_woocommerce_get_product_short_description')) {
    function smartic_woocommerce_get_product_short_description() {
        global $post;
        $short_description = wp_trim_words(apply_filters('woocommerce_short_description', $post->post_excerpt), 20);
        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo sprintf('%s', $short_description); ?>
            </div>
            <?php
        }
    }
}


if (!function_exists('smartic_woocommerce_product_loop_wishlist_button')) {
    function smartic_woocommerce_product_loop_wishlist_button() {
        if (smartic_is_woocommerce_extension_activated('YITH_WCWL')) {
            echo smartic_do_shortcode('yith_wcwl_add_to_wishlist');
        }
    }
}

if (!function_exists('smartic_woocommerce_product_loop_compare_button')) {
    function smartic_woocommerce_product_loop_compare_button() {
        if (smartic_is_woocommerce_extension_activated('YITH_Woocompare')) {
            global $yith_woocompare;
            if (get_option('yith_woocompare_compare_button_in_products_list', 'no') == 'yes') {
                remove_action('woocommerce_after_shop_loop_item', array(
                    $yith_woocompare->obj,
                    'add_compare_link'
                ), 20);
            }

            echo smartic_do_shortcode('yith_compare_button');
        }
    }
}

if (!function_exists('smartic_header_wishlist')) {
    function smartic_header_wishlist() {
        if (function_exists('yith_wcwl_count_all_products')) {
            ?>
            <div class="site-header-wishlist">
                <a class="header-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
                    <i class="smartic-icon-heart"></i>
                    <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
                </a>
            </div>
            <?php
        } elseif (function_exists('woosw_init')) {
            $key = WPCleverWoosw::get_key();

            ?>
            <div class="site-header-wishlist">
                <a class="header-wishlist" href="<?php echo esc_url(WPCleverWoosw::get_url($key, true)); ?>">
                    <i class="smartic-icon-heart"></i>
                    <span class="count"><?php echo esc_html(WPCleverWoosw::get_count($key)); ?></span>
                </a>
            </div>
            <?php
        }
    }
}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
    function yith_wcwl_ajax_update_count() {
        wp_send_json(array(
            'count' => yith_wcwl_count_all_products(),
            'text'  => esc_html(_nx('Item', 'Items', yith_wcwl_count_all_products(), 'items wishlist', 'smartic'))
        ));
    }

    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
}

if (!function_exists('smartic_button_grid_list_layout')) {
    function smartic_button_grid_list_layout() {
        ?>
        <div class="gridlist-toggle desktop-hide-down">
            <a href="<?php echo esc_url(add_query_arg('layout', 'grid')); ?>" id="grid" class="<?php echo isset($_GET['layout']) && $_GET['layout'] == 'list' ? '' : 'active'; ?>" title="<?php echo esc_html__('Grid View', 'smartic'); ?>"><i class="smartic-icon-grid"></i></a>
            <a href="<?php echo esc_url(add_query_arg('layout', 'list')); ?>" id="list" class="<?php echo isset($_GET['layout']) && $_GET['layout'] == 'list' ? 'active' : ''; ?>" title="<?php echo esc_html__('List View', 'smartic'); ?>"><i class="smartic-icon-list"></i></a>
        </div>
        <?php
    }
}

if (!function_exists('smartic_woocommerce_change_path_shortcode')) {
    function smartic_woocommerce_change_path_shortcode($template, $slug, $name) {
        wc_get_template('content-widget-product.php', apply_filters('smartic_product_template_arg', array('show_rating' => false)));
    }
}

if (!function_exists('smartic_woocommerce_list_show_rating_arg')) {
    function smartic_woocommerce_list_show_rating_arg($arg) {
        $arg['show_rating'] = true;

        return $arg;
    }
}

if (!function_exists('smartic_woocommerce_list_get_excerpt')) {
    function smartic_woocommerce_list_show_excerpt() {
        echo '<div class="product-excerpt">' . get_the_excerpt() . '</div>';
    }
}

if (!function_exists('smartic_woocommerce_list_get_rating')) {
    function smartic_woocommerce_list_show_rating() {
        global $product;
        echo wc_get_rating_html($product->get_average_rating());
    }
}

if (!function_exists('smartic_single_product_quantity_label')) {
    function smartic_single_product_quantity_label() {
        echo '<label class="quantity_label">' . esc_html__('Quantity', 'smartic') . ' </label>';
    }
}

if (!function_exists('smartic_woocommerce_time_sale')) {
    function smartic_woocommerce_time_sale() {
        /**
         * @var $product WC_Product
         */
        global $product;

        if (!$product->is_on_sale()) {
            return;
        }

        $time_sale = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
        if ($time_sale) {
            wp_enqueue_script('smartic-countdown');
            $time_sale += (get_option('gmt_offset') * HOUR_IN_SECONDS);
            ?>
            <div class="time-sale">
                <div class="deal-text"><i class="smartic-icon smartic-icon-fire"></i>
                    <span><?php echo esc_html__('Hungry Up ! Deals end in :', 'smartic'); ?></span>
                </div>
                <div class="smartic-countdown" data-countdown="true" data-date="<?php echo esc_html($time_sale); ?>">
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-days"></span>
                        <span class="countdown-label"><?php echo esc_html__('Days', 'smartic') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-hours"></span>
                        <span class="countdown-label"><?php echo esc_html__('Hours', 'smartic') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-minutes"></span>
                        <span class="countdown-label"><?php echo esc_html__('Mins', 'smartic') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-seconds"></span>
                        <span class="countdown-label"><?php echo esc_html__('Secs', 'smartic') ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if (!function_exists('smartic_single_product_extra')) {
    function smartic_single_product_extra() {
        global $product;
        $product_extra = smartic_get_theme_option('single_product_content_meta', '');
        $product_extra = get_post_meta($product->get_id(), '_extra_info', true) !== '' ? get_post_meta($product->get_id(), '_extra_info', true) : $product_extra;
        if ($product_extra !== '') {
            echo '<div class="smartic-single-product-extra">' . html_entity_decode($product_extra) . '</div>';
        }
    }
}

if (!function_exists('smartic_button_shop_canvas')) {
    function smartic_button_shop_canvas() {
        if (is_active_sidebar('sidebar-woocommerce-shop')) { ?>
            <a href="#" class="filter-toggle" aria-expanded="false">
                <i class="smartic-icon-filter"></i></a>
            <?php
        }
    }
}

if (!function_exists('smartic_button_shop_dropdown')) {
    function smartic_button_shop_dropdown() {
        if (is_active_sidebar('sidebar-woocommerce-shop')) { ?>
            <a href="#" class="filter-toggle-dropdown" aria-expanded="false">
                <i class="smartic-icon-filter"></i><span><?php esc_html_e('Filter', 'smartic'); ?></span></a>
            <?php
        }
    }
}

if (!function_exists('smartic_render_woocommerce_shop_canvas')) {
    function smartic_render_woocommerce_shop_canvas() {
        if (is_active_sidebar('sidebar-woocommerce-shop') && smartic_is_product_archive()) {
            ?>
            <div id="smartic-canvas-filter" class="smartic-canvas-filter">
                <span class="filter-close"><?php esc_html_e('HIDE FILTER', 'smartic'); ?></span>
                <div class="smartic-canvas-filter-wrap">
                    <?php if (smartic_get_theme_option('woocommerce_archive_layout') == 'canvas') {
                        dynamic_sidebar('sidebar-woocommerce-shop');
                    }
                    ?>
                </div>
            </div>
            <div class="smartic-overlay-filter"></div>
            <?php
        }
    }
}
if (!function_exists('smartic_render_woocommerce_shop_dropdown')) {
    function smartic_render_woocommerce_shop_dropdown() {
        ?>
        <div id="smartic-dropdown-filter" class="smartic-dropdown-filter">
            <div class="smartic-dropdown-filter-wrap">
                <?php dynamic_sidebar('sidebar-woocommerce-shop'); ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('woocommerce_checkout_order_review_start')) {

    function woocommerce_checkout_order_review_start() {
        echo '<div class="checkout-review-order-table-wrapper">';
    }
}

if (!function_exists('woocommerce_checkout_order_review_end')) {

    function woocommerce_checkout_order_review_end() {
        echo '</div>';
    }
}

if (!function_exists('smartic_woocommerce_get_product_label_stock')) {
    function smartic_woocommerce_get_product_label_stock() {
        /**
         * @var $product WC_Product
         */
        global $product;
        if ($product->get_stock_status() == 'outofstock') {
            echo '<span class="stock-label">' . esc_html__('Out Of Stock', 'smartic') . '</span>';
        }
    }
}

if (!function_exists('smartic_woocommerce_single_content_wrapper_start')) {
    function smartic_woocommerce_single_content_wrapper_start() {
        echo '<div class="content-single-wrapper">';
    }
}

if (!function_exists('smartic_woocommerce_single_content_wrapper_end')) {
    function smartic_woocommerce_single_content_wrapper_end() {
        echo '</div>';
    }
}

if (!function_exists('smartic_woocommerce_single_brand')) {
    function smartic_woocommerce_single_brand() {
        $id = get_the_ID();

        $terms = get_the_terms($id, 'product_brand');

        if (is_wp_error($terms)) {
            return $terms;
        }

        if (empty($terms)) {
            return false;
        }

        $links = array();

        foreach ($terms as $term) {
            $link = get_term_link($term, 'product_brand');
            if (is_wp_error($link)) {
                return $link;
            }

            $img = get_term_meta($term->term_id, 'product_brand_logo', true);

            if ($img !== "") {
                $src = wp_get_attachment_image_src($img, 'thumbnail');

                $links[] = '<a href="' . esc_url($link) . '" rel="tag"><img src="' . $src[0] . '" alt="' . $term->name . '"/></a>';
            } else {
                $links[] = '<a href="' . esc_url($link) . '" rel="tag">' . $term->name . '</a>';
            }

        }

        echo '<div class="product-brand">' . join('', $links) . '</div>';

    }
}


if (!function_exists('smartic_stock_label')) {
    function smartic_stock_label() {
        global $product;
        if ($product->is_in_stock()) {
            echo '<span class="inventory_status">' . esc_html__('In Stock', 'smartic') . '</span>';
        } else {
            echo '<span class="inventory_status out-stock">' . esc_html__('Out of Stock', 'smartic') . '</span>';
        }
    }
}

if (!function_exists('smartic_single_product_video_360')) {
    function smartic_single_product_video_360() {
        global $product;
        echo '<div class="product-video-360">';
        $images = get_post_meta($product->get_id(), '_product_360_image_gallery', true);
        $video  = get_post_meta($product->get_id(), '_video_select', true);
        if ($images) {
            $array      = explode(',', $images);
            $images_url = [];
            foreach ($array as $id) {
                $url          = wp_get_attachment_image_src($id, 'full');
                $images_url[] = $url[0];
            }

            echo '<a class="product-video-360__btn btn-360" href="#view-360"><i class="smartic-icon-360"></i></a>';
            ?>
            <div id="view-360" class="view-360 zoom-anim-dialog mfp-hide">
                <div id="rotateimages" class="opal-loading" data-images="<?php echo implode(',', $images_url); ?>"></div>
                <div class="view-360-group">
                    <span class='view-360-button view-360-prev'><i class="smartic-icon-chevron-left"></i></span>
                    <i class="smartic-icon-360 view-360-svg"></i>
                    <span class='view-360-button view-360-next'><i class="smartic-icon-chevron-right"></i></span>
                </div>
            </div>
            <?php
        }


        if ($video && wc_is_valid_url($video)) {

            echo '<a class="product-video-360__btn btn-video" href="' . $video . '"><i class="smartic-icon-video"></i></a>';
        }

        echo '</div>';
    }
}

if (!function_exists('smartic_output_product_data_accordion')) {
    function smartic_output_product_data_accordion() {
        $product_tabs = apply_filters('woocommerce_product_tabs', array());
        if (!empty($product_tabs)) : ?>
            <div id="smartic-accordion-container" class="woocommerce-tabs wc-tabs-wrapper product-accordions">
                <?php $_count = 0; ?>
                <?php foreach ($product_tabs as $key => $tab) : ?>
                    <div class="accordion-item">
                        <div class="accordion-head <?php echo esc_attr($key); ?>_tab js-btn-accordion"
                             id="tab-title-<?php echo esc_attr($key); ?>">
                            <h2 class="accordion-title"><?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', esc_html($tab['title']), $key); ?></h2>
                        </div>
                        <div class="accordion-body js-card-body">
                            <?php call_user_func($tab['callback'], $key, $tab); ?>
                        </div>
                    </div>
                    <?php $_count++; ?>
                <?php endforeach; ?>
            </div>
        <?php endif;
    }
}

if (!function_exists('smartic_woocommerce_get_product_short_description')) {
    function smartic_woocommerce_get_product_short_description() {
        global $post;
        $short_description = wp_trim_words(apply_filters('woocommerce_short_description', $post->post_excerpt), 20);
        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo sprintf('%s', $short_description); ?>
            </div>
            <?php
        }
    }
}
if (!function_exists('quickview_button')) {
    function quickview_button() {
        echo do_shortcode('[woosq]');
    }
}
if (!function_exists('compare_button')) {
    function compare_button() {
        echo do_shortcode('[woosc]');
    }
}
if (!function_exists('wishlist_button')) {
    function wishlist_button() {
        echo do_shortcode('[woosw]');
    }
}