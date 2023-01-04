<?php
if( ! function_exists( 'smartic_360_metabox_output' ) ) {
	function smartic_360_metabox_output( $post ) {
		?>
		<div id="product_360_images_container">
			<ul class="product_360_images">
				<?php
				$product_image_gallery = array();

				if ( metadata_exists( 'post', $post->ID, '_product_360_image_gallery' ) ) {
					$product_image_gallery = get_post_meta( $post->ID, '_product_360_image_gallery', true );
				} else {
					// Backwards compat
					$attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_360_image&meta_value=1' );
					$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
					$product_image_gallery = implode( ',', $attachment_ids );
				}

				$attachments         = array_filter( explode( ',', $product_image_gallery ) );
				$update_meta         = false;
				$updated_gallery_ids = array();

				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment_id ) {
						$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

						// if attachment is empty skip
						if ( empty( $attachment ) ) {
							$update_meta = true;
							continue;
						}

						echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_html__( 'Delete image', 'smartic' ) . '">' . esc_html__( 'Delete', 'smartic' ) . '</a></li>
								</ul>
							</li>';

						// rebuild ids to be saved
						$updated_gallery_ids[] = $attachment_id;
					}

					// need to update product meta to set new gallery ids
					if ( $update_meta ) {
						update_post_meta( $post->ID, '_product_360_image_gallery', implode( ',', $updated_gallery_ids ) );
					}
				}
				?>
			</ul>

			<input type="hidden" id="product_360_image_gallery" name="product_360_image_gallery" value="<?php echo esc_attr( $product_image_gallery ); ?>" />

		</div>
		<p class="add_product_360_images hide-if-no-js">
			<a href="#" data-choose="<?php esc_attr_e( 'Add Images to Product 360 view Gallery', 'smartic' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'smartic' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'smartic' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'smartic' ); ?>"><?php esc_html_e( 'Add product 360 view gallery images', 'smartic' ); ?></a>
		</p>
		<?php

	}
}

function smartic_product_360_view_meta() {
	add_meta_box( 'woocommerce-product-360-images',
		esc_html__( 'Product 360 View Gallery (optional)', 'smartic' ),
		'smartic_360_metabox_output',
		'product', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'smartic_product_360_view_meta', 50 );

/**
 * ------------------------------------------------------------------------------------------------
 * Save metaboxes
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'smartic_proccess_360_view_metabox' ) ) {
	function smartic_proccess_360_view_metabox( $post_id, $post ) {
		$attachment_ids = isset( $_POST['product_360_image_gallery'] ) ? array_filter( explode( ',', wc_clean( $_POST['product_360_image_gallery'] ) ) ) : array();

		update_post_meta( $post_id, '_product_360_image_gallery', implode( ',', $attachment_ids ) );
	}
}

add_action( 'woocommerce_process_product_meta', 'smartic_proccess_360_view_metabox', 50, 2 );


add_action( 'admin_init', function(){
	global $smartic_version;
	wp_enqueue_script( 'smartic-product-360-admin-scripts', get_theme_file_uri('assets/js/admin/product-360.js'), array(), $smartic_version, true );
	wp_enqueue_style('smartic-product-360-admin-style',get_theme_file_uri('assets/css/admin/product-360.css'), '', $smartic_version);
}, 100 );

