<?php
//echo "here";
//die;
require_once("../../../../wp-config.php");
require_once("../../../../wp-load.php");
global $wpdb;
$value=$_POST['value'];
echo $value;
$tablename = "drag_drop_a";
$insert_sql = "INSERT INTO ".$tablename."(value)
 values('" . $value . "') ";
$wpdb->query($insert_sql);
if($insert_sql)
          {
             $result= "success";
          }
          else {
             $result = "fail";
          }
         echo json_encode($result);