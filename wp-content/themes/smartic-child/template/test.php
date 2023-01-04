<?php

/**
 * Template Name:   TestCustomFn
 * Template Post Type:post,page,my-post-type;
 */
get_header();
?>

<?php 
echo "here";
echo "<br>";
echo customfn();
//wp_schedule_single_event( 1000, 'my_new_event');

get_footer();