<?php

/**
 * Theme functions and definitions.
 */

add_action('wp_head', 'header_scripts');
function header_scripts()
{
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function functionName() {
            alert('header call');
        }
    </script>
<?php
}


add_action('woocommerce_thankyou', 'enroll_student', 10, 1);
function enroll_student($order_id)
{

    $order = wc_get_order($order_id);
    $payment_method = $order->payment_method_title;
    $order_data = $order->get_data();
    $order_status = $order_data['status']; // For order status
    $order_billing_first_name = $order_data['billing']['first_name']; // First name
    $order_billing_last_name = $order_data['billing']['last_name']; // Last name
    $fullname = $order_billing_first_name . ' ' . $order_billing_last_name; //full name
    $order_billing_email = $order_data['billing']['email']; // email
    $order_billing_phone = $order_data['billing']['phone']; // phone number
    $order_billing_country = $order_data['billing']['country']; // country
    $order_billing_city = $order_data['billing']['city']; // city
    $order_billing_postcode = $order_data['billing']['postcode']; // postcode
    $order_billing_company = $order_data['billing']['company']; // company
    $order_billing_address_1 = $order_data['billing']['address_1']; // address 1
    $order_billing_address_2 = $order_data['billing']['address_2']; // address 2
    $order_note = $order->customer_note;
    $order_total = $order_data['total'];
    $order_total_tax = $order_data['total_tax'];
    $order_total_gross = $order_total - $order_total_tax;




    $sitemap = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
    $abspath = ABSPATH . 'wp-content/pointex';
    $sitemap .= '<Export_Bfast_POINTEX>' . "\n" .

        "\t" . '<Entete_Commande>' . "\n" .
        "\t\t" . "<Id_commande>" .  $order_id . "</Id_commande>" . "\n" .
        "\t\t" . "<emporter>" . "1" . "</emporter>" . "\n" .
        "\t\t" . "<ID_Point_de_vente>" .  "XX0001" . "</ID_Point_de_vente>" . "\n" .
        "\t\t" . "<etat_commande>" .  $order_status . "</etat_commande>" . "\n" .
        "\t\t" . "<Date_Commande>" . "0" . "</Date_Commande>" . "\n" .
        "\t\t" . "<Date_heure_Commande>" .  "0" . "</Date_heure_Commande>" . "\n" .
        "\t\t" . "<Durée_Saisie_Commande>" .  "0" . "</Durée_Saisie_Commande>" . "\n" .
        "\t\t" . "<Prix_HT_Brut>" .  $order_total_gross . "</Prix_HT_Brut>" . "\n" .
        "\t\t" . "<Prix_HT_Net>" .  $order_total_gross . "</Prix_HT_Net>" . "\n" .
        "\t\t" . "<Prix_TTC_Brut>" .  $order_total . "</Prix_TTC_Brut>" . "\n" .
        "\t\t" . "<Prix_TTC_NET>" .  $order_total . "</Prix_TTC_NET>" . "\n" .
        "\t\t" . "<DiscountOrder_TTC>" .  "0" . "</DiscountOrder_TTC>" . "\n" .
        "\t\t" . "<DiscountItems_TTC>" .  "0" . "</DiscountItems_TTC>" . "\n" .
        "\t\t" . "<ID_Carte_fidélité>" .  "0" . "</ID_Carte_fidélité>" . "\n" .
        "\t\t" . "<HandlingMessage>" .  $order_note . "</HandlingMessage>" . "\n" .
        "\t\t" . "<ShippingMessage>" .  $order_note . "</ShippingMessage>" . "\n" .


        "\t" . '<Client>' . "\n" .
        "\t\t" . "<Numadresse>" .  "0" . "</Numadresse>" . "\n" .
        "\t\t" . "<Nomadresse>" . "commande" . "</Nomadresse>" . "\n" .
        "\t\t" . "<identifiant>" . $order_billing_email . "</identifiant>" . "\n" .
        "\t\t" . "<nom>" . $fullname . "</nom>" . "\n" .
        "\t\t" . "<prenom>" . $order_billing_first_name . "</prenom>" . "\n" .
        "\t\t" . "<societe>" . $order_billing_company . "</societe>" . "\n" .
        "\t\t" . "<numvoie>" .  $order_billing_address_1 . "</numvoie>" . "\n" .
        "\t\t" . "<adresse1>" . $order_billing_address_1 . "</adresse1>" . "\n" .
        "\t\t" . "<adresse2>" .  $order_billing_address_2 . "</adresse2>" . "\n" .
        "\t\t" . "<adresse3>" .  "0" . "</adresse3>" . "\n" .
        "\t\t" . "<batiment>" .  $order_billing_address_2 . "</batiment>" . "\n" .
        "\t\t" . "<escalier>" .  "0" . "</escalier>" . "\n" .
        "\t\t" . "<etage>" .  "0" . "</etage>" . "\n" .
        "\t\t" . "<porte>" .  "0" . "</porte>" . "\n" .
        "\t\t" . "<code_porte>" .  "0" . "</code_porte>" . "\n" .
        "\t\t" . "<code_postal>" .  $order_billing_postcode . "</code_postal>" . "\n" .
        "\t\t" . "<ville>" . $order_billing_city  . "</ville>" . "\n" .
        "\t\t" . "<pays>" .  $order_billing_country . "</pays>" . "\n" .
        "\t\t" . "<telephone_fixe>" .  $order_billing_phone  . "</telephone_fixe>" . "\n" .
        "\t\t" . "<telephone_mobile>" . $order_billing_phone . "</telephone_mobile>" . "\n" .
        "\t" . '</Client>' . "\n" .
        "\t" . '</Entete_Commande>' . "\n";


    $product_count = 0;
    foreach ($order->get_items() as $item_key => $item) {

        $item_data    = $item->get_data();
        $product_id   = $item_data['id'];
        global $wpdb;
        $result = $wpdb->get_results("SELECT meta_value FROM wp_831265_woocommerce_order_itemmeta WHERE meta_key = 'Commentaire (Aliments à ne pas mettre)' AND order_item_id = '" . $product_id . "'");
        $array = json_decode(json_encode($result), true);
        if ($array[0]['meta_value']) {
            $comment = $array[0]['meta_value'];
        } else {
            $comment = "No Comment";
        }
        $excluding_tax_price = $item_data['subtotal'];
        $subtotal_tax = $item_data['subtotal_tax'];
        $total = $excluding_tax_price + $subtotal_tax;
        $product = $item->get_product();
        $quantity = $item->get_quantity();
        if ($product->get_sku()) {
            $sku = $product->get_sku();
        } else {
            $sku = 0;
        }
        $sitemap .= "\t" . '<Ligne_commande>' . "\n" .
            "\t\t" . "<ID_ordre_ligne_commande>" .  $product_count . "</ID_ordre_ligne_commande>" . "\n" .
            "\t\t" . "<ID_Article>" .  $sku . "</ID_Article>" . "\n" .
            "\t\t" . "<TVA>" .  $subtotal_tax . "</TVA>" . "\n" .
            "\t\t" . "<Prix_HT_Brut>" .  $excluding_tax_price . "</Prix_HT_Brut>" . "\n" .
            "\t\t" . "<Prix_TTC_Brut>" .  $total . "</Prix_TTC_Brut>" . "\n" .
            "\t\t" . "<Qté>" .  $quantity . "</Qté>" . "\n" .
            "\t\t" . "<Pourc_Remise>" .  "0" . "</Pourc_Remise>" . "\n" .
            "\t\t" . "<Qté_Offert_Ligne>" .  "0" . "</Qté_Offert_Ligne>" . "\n" .
            "\t\t" . "<Prix_HT_Net>" .  $excluding_tax_price . "</Prix_HT_Net>" . "\n" .
            "\t\t" . "<Prix_TTC_NET>" . $total . "</Prix_TTC_NET>" . "\n" .
            "\t\t" . "<Message_Prod>" .  $comment . "</Message_Prod>" . "\n" .
            "\t" . '</Ligne_commande>' . "\n";
        $product_count++;
    }

    /**"\t".'<Accompagnement>'."\n".
     "\t\t"."<ID_ordre_ligne_commande>".  "0" ."</ID_ordre_ligne_commande>"."\n". 
     "\t\t"."<ID_Article>".  "0" ."</ID_Article>"."\n". 
     "\t\t"."<TVA>".  "0" ."</TVA>"."\n". 
     "\t\t"."<Prix_HT_Brut>".  "0" ."</Prix_HT_Brut>"."\n". 
     "\t\t"."<Prix_TTC_Brut>".  "0" ."</Prix_TTC_Brut>"."\n". 
     "\t\t"."<Qté>".  "0" ."</Qté>"."\n". 
     "\t\t"."<Ordre_Accompagnement>".  "0" ."</Ordre_Accompagnement>"."\n". 
     "\t\t"."<Prix_HT_Net>".  "0" ."</Prix_HT_Net>"."\n". 
     "\t\t"."<Prix_TTC_Net>".  "0" ."</Prix_TTC_Net>"."\n". 
     "\t\t"."<Nom_Menu>".  "0" ."</Nom_Menu>"."\n". 
     "\t\t"."<Nom_Accompagnement>".  "0" ."</Nom_Accompagnement>"."\n". 
     "\t\t"."<Message_Prod>".  "0" ."</Message_Prod>"."\n". 
     "\t".'</Accompagnement>'."\n".*/

    $sitemap .= "\t" . '<Paiement>' . "\n" .
        "\t\t" . "<Montant_réglé>" .  "0" . "</Montant_réglé>" . "\n" .
        "\t\t" . "<Mode_Reglement>" .  $payment_method . "</Mode_Reglement>" . "\n" .
        "\t\t" . "<Montant_pme_utilisé>" .  "0" . "</Montant_pme_utilisé>" . "\n" .
        "\t" . '</Paiement>' . "\n" .

        "\t\t" . "<sql_reponse>" .  "0" . "</sql_reponse>" . "\n" .
        "\t\t" . "<alert_internal>" .  "Opération terminée avec succès" . "</alert_internal>" . "\n" .

        '</Export_Bfast_POINTEX>' . "\n\n";

    $filename = 'order_' . date('m-d-Y_hia') . '.xml';
    $fp = fopen($abspath . '/' . $filename, 'w');
    fwrite($fp, $sitemap);
    fclose($fp);
    //Download xml file
    /**header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    echo $sitemap;
    exit();**/
}



add_action('init', 'enroll_students');
function enroll_students()
{
    $date = "décembre 15, 2022";
    $arr = explode(' ', trim($date));
    $str = $arr[0];
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $enmonth = str_replace($french_months, $english_months, $arr[0]);
    $en_date = str_replace($str, $enmonth, $date);
    $new_date = date_create(".$en_date.");
    //echo date_format($new_date,"d/m/Y");
}

function wpb_demo_shortcode()
{
?>
    <html>

    <body>
        <marquee direction="up" height="100" width="500" scrollamount="2" bgcolor onmouseover="this.stop();" onmouseout="this.start();">
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
        </marquee>
    </body>

    </html>
<?php }
// register shortcode
add_shortcode('greeting', 'wpb_demo_shortcode');


function customfn()
{
    echo "My custom function";
    //echo '<br>';
    //echo date('h:i:s') . "<br>";
    //sleep(15);
    //echo date('h:i:s') . "<br>";
    //echo "Hello";
    /**Call Js function */
    echo "<script>functionName();</script>";
}
//add_action( 'init','customfn'); 
//wp_schedule_single_event( time() + 1000, 'my_new_event');

/**function run_every_five_minutes() {
    echo "Hello ,here";
}

if ( ! get_transient( 'every_1_minutes' ) ) {
    set_transient( 'every_1_minutes', true, 1 * MINUTE_IN_SECONDS );
    run_every_five_minutes();

    // It's better use a hook to call a function in the plugin/theme
    add_action( 'init', 'run_every_five_minutes' );
}**/

add_action('init', 'create_custom_post');
function create_custom_post()
{
    /**Working code(Update custom field on post creation)*/
    /**$post_data = array(
        'post_type'         => 'custompost',
        'post_title'        => 'test2',
        'post_status'       => 'publish',
    );
    //$post_id = wp_insert_post($post_data);
    //$image_src = 'http://localhost/pr/wp-content/uploads/2021/04/more-info.jpg';
    //global $wpdb;
    //$query = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_src));
    //$attachment_id = $query[0];
    //echo do_shortcode('[gallery ids=" '.$attachment_id.'" id= "'.$post_id.'"]');
    //update_field('gallery_1', $attachment_id, $post_id);**/

    $args = array(
        'post_type' => 'custompost',
        'order'    => 'ASC'
    );

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $post_id = get_the_ID();

            /**working code start */
            $images = get_attached_media( 'image', $post_id );

            foreach ( $images as $image ) {
            wp_delete_attachment( $image->ID, true );
            }

            /**Working code end */
        endwhile;
        wp_reset_postdata();
    else :
    endif;
}
