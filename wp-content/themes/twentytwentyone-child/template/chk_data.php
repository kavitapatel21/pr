<?php
//echo "here";
//die;
require_once("../../../../wp-config.php");
require_once("../../../../wp-load.php");
global $wpdb;
$post_id = $wpdb->get_results("SELECT id FROM 'drag_drop'");
$wpdb->query($post_id);
if($post_id)
          {
             $result= "success";
          }
          else {
             $result = "fail";
          }
         echo json_encode($result);
print_r($post_id);