<?php
/* Child theme generated with WPS Child Theme Generator */

if (!function_exists('b7ectg_theme_enqueue_styles')) {
    add_action('wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles');

    function b7ectg_theme_enqueue_styles()
    {
        wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
        wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
    }
}


add_action('wp_ajax_chk_data', 'event_callback');
add_action('wp_ajax_nopriv_chk_data', 'event_callback');
function event_callback()
{
    require_once("../../../wp-config.php");
    require_once("../../../wp-load.php");
    global $wpdb;
    $post_id = $wpdb->get_results("SELECT id FROM 'drag_drop'");
    $wpdb->query($post_id);
    if ($post_id) {
        $result = "success";
    } else {
        $result = "fail";
    }
    echo json_encode($result);
    print_r($post_id);
    wp_die();
}


/**add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
	<script type="text/javascript">
	$.ajax({
				method: "GET",
				dataType: "json",
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					'action': 'chk_data',
				},
				success: function(result) {
					alert(result);
				}
			});
	</script>

<?php
}*/

//add new menu for theme-options page with page callback theme-options-page.

add_action('woocommerce_thankyou', 'enroll_student', 10, 1);
function enroll_student( $order_id ) {
echo '<script>alert("Welcome to Geeks for Geeks")</script>';
$order    = wc_get_order( $order_id );
$comments = $order->get_customer_note();
echo $comments;
$sitemap = '<?xml version="1.0" encoding="utf-8"?>'."\n";               
$abspath = ABSPATH.'wp-content/pointex';
$sitemap .= '<Export_Bfast_POINTEX>'."\n".

	"\t".'<Entete_Commande>'."\n".
	"\t\t"."<Id_commande>".  $order_id ."</Id_commande>"."\n".
    "\t\t"."<Id_commande>".  $comments ."</Id_commande>"."\n".
	"\t".'</Entete_Commande>'."\n".  
	 
'</Export_Bfast_POINTEX>'."\n\n";

  $filename = 'order_'.date('m-d-Y_hia').'.xml';
  $fp = fopen($abspath .'/'.$filename, 'w');
  fwrite($fp, $sitemap);
  fclose($fp);
}
