<?php

/**
 * Template Name:   carlisting
 * Template Post Type:post,page,my-post-type;
 */
get_header();
?>

<?php
//$post_id = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE (meta_key = 'gallery')");
//print_r($post_id);
?>
<section class="news pt-0">
    <div class="container mt-md-5">
       
        <ul class="row d-lg-flex list-unstyled image-block justify-content-center px-lg-0 mx-lg-0">
            <?php
            $args = array(
                'post_type' => 'car',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'order'    => 'ASC'
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
            ?>
                <li class="col-lg-4 col-md-5 image-block full-width p-3">
                    <div class="image-block-inner">
                        <a class="mh-100" href="#">
                        <?php
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); ?>
                        <img src="<?php echo $image[0]; ?>" alt="LunarXP Wins Space Innovator of the Year Award" class="img-responsive w-100"></a>
                        <span class="hp-posts-cat"><?php the_title(); ?></span>
                        <p><?php echo substr(get_the_content(), 0, 100);?></p>
                        <!--  <p></p> -->
                        <a href="<?php the_permalink();?>" class="read-more">Read more ></a>
                    </div><!-- .image-block-inner -->
                </li>
            <?php
            endwhile;
            ?>
        </ul>
    </div>
</section>
<?php
get_footer();
?>