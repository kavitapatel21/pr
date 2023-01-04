<?php
//echo 'here';
require_once('wp-admin/includes/image.php');
//require_once('wp-admin/includes/file.php');
require_once('wp-admin/includes/media.php');
require_once("wp-load.php");
require_once('wp-includes/wp-db.php');
$upload_dir = wp_upload_dir();
$u = $upload_dir['baseurl'] . '/JT-AUTOMOBILES.xml';
$xml = simplexml_load_file($u) or die("Error: Cannot create object");
//print_r($xml);
//print_r((string)$xml->vehicule[0]->photos[0]->photo);
/**Working code start */
header("Content-type: text/xml");
$file = file_get_contents($u);
echo $file;
/**Working code end */
die;


foreach ($xml->children() as $fields) {
    $img = $fields->photos->photo[0];
    //echo (string)$img;
    //die;
    $post_title = $fields->titre;
    global $wpdb;
    $query = $wpdb->prepare('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_name = %s', sanitize_title_with_dashes($post_title));
    $cID = $wpdb->get_var($query);
    echo $cID;
    if (!empty($cID)) {
        echo "update" . '<br>';
        $my_post = array(
            'ID' =>   $cID,
            'post_type'         => 'car',
            'post_title'    => $post_title,
            'post_status'   => 'publish',
        );
        wp_update_post($my_post);
        update_post_meta($cID, 'reference', (string)$fields->reference);
        update_post_meta($cID, 'reference_externe', (string)$fields->reference_externe);
        update_post_meta($cID, 'type', (string)$fields->type);
        update_post_meta($cID, 'marque', (string)$fields->marque);
        update_post_meta($cID, 'version', (string)$fields->version);
        update_post_meta($cID, 'annee', (string)$fields->annee);
        update_post_meta($cID, 'energie', (string)$fields->energie);
        update_post_meta($cID, 'typeboite', (string)$fields->typeboite);
        update_post_meta($cID, 'puissance_fiscale', (string)$fields->puissance_fiscale);
        update_post_meta($cID, 'prix_neuf', (string)$fields->prix_neuf);
        $array = [];
        foreach ($fields->photos->photo as $imageurl) {
            //print_r((string)$one);
            $image = (string)$imageurl;
            $xmlimgtrim = trim($image);
            $url = $xmlimgtrim;
            //echo $url;
            if (has_post_thumbnail($cID)) {
                echo 'image already set';
            } else {
                global $wpdb;
                $image_src = wp_upload_dir()['baseurl'] . '/2022/08/' . _wp_relative_upload_path(basename($url));
                $query = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_src));
                if ($query[0]) {
                    $image_id = $query[0];
                    $attachment_data = wp_generate_attachment_metadata($image_id, basename($url));
                    wp_update_attachment_metadata($image_id,  $attachment_data);
                    array_push($array, $image_id);
                } else {
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    $src = media_sideload_image($url, null, null, 'src');
                    $image_id = attachment_url_to_postid($src);
                    //echo $image_id . '<br>';
                    $attachment_data = wp_generate_attachment_metadata($image_id, basename($url));
                    wp_update_attachment_metadata($image_id,  $attachment_data);
                    array_push($array, $image_id);
                }
                $str = implode(", ", $array);
                update_post_meta($cID, 'gallery',  $str);
                set_post_thumbnail($cID, $image_id);
            }
        }
    } else {
        echo "create" . '<br>';
        $post_data = array(
            'post_type'         => 'car',
            'post_title'        => $post_title,
            'post_status'       => 'publish',
        );
        $post_id = wp_insert_post($post_data);
        echo $post_id . '<br>';
        update_post_meta($post_id, 'reference', (string)$fields->reference);
        update_post_meta($post_id, 'reference_externe', (string)$fields->reference_externe);
        update_post_meta($post_id, 'type', (string)$fields->type);
        update_post_meta($post_id, 'marque', (string)$fields->marque);
        update_post_meta($post_id, 'version', (string)$fields->version);
        update_post_meta($post_id, 'annee', (string)$fields->annee);
        update_post_meta($post_id, 'energie', (string)$fields->energie);
        update_post_meta($post_id, 'typeboite', (string)$fields->typeboite);
        update_post_meta($post_id, 'puissance_fiscale', (string)$fields->puissance_fiscale);
        update_post_meta($post_id, 'prix_neuf', (string)$fields->prix_neuf);
        $array = [];
        foreach ($fields->photos->photo as $imageurl) {
            //print_r((string)$one);
            $image = (string)$imageurl;
            $xmlimgtrim = trim($image);
            $url = $xmlimgtrim;
            //echo $url;
            global $wpdb;
            $image_src = wp_upload_dir()['baseurl'] . '/2022/08/' . _wp_relative_upload_path(basename($url));
            $query = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_src));
            if ($query[0]) {
                $image_id = $query[0];
                $attachment_data = wp_generate_attachment_metadata($image_id, basename($url));
                wp_update_attachment_metadata($image_id,  $attachment_data);
                array_push($array, $image_id);
                if (has_post_thumbnail($post_id)) {
                    echo 'image already set';
                } else {
                    set_post_thumbnail($post_id, $image_id);
                }
            } else {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                $src = media_sideload_image($url, null, null, 'src');
                $image_id = attachment_url_to_postid($src);
                //echo $image_id . '<br>';
                if (has_post_thumbnail($post_id)) {
                    echo 'image already set';
                } else {
                    set_post_thumbnail($post_id, $image_id);
                }
                $attachment_data = wp_generate_attachment_metadata($image_id, basename($url));
                wp_update_attachment_metadata($image_id,  $attachment_data);
                array_push($array, $image_id);
            }
            $str = implode(", ", $array);
            update_post_meta($post_id, 'gallery',  $str);
        }
    }
}
