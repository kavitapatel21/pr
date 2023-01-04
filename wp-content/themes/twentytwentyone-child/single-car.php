<link rel="stylesheet" herf="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<style>
  @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

  * {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    font-family: 'Open Sans', sans-serif;
  }

  body {
    line-height: 1.5;
  }

  .card-wrapper {
    max-width: 1100px;
    margin: 0 auto;
  }

  img {
    width: 100%;
    display: block;
  }

  .img-display {
    overflow: hidden;
  }

  .img-showcase {
    display: flex;
    width: 100%;
    transition: all 0.5s ease;
  }

  .img-showcase img {
    min-width: 100%;
  }

  .img-select {
    display: flex;
  }

  .img-item {
    margin: 0.3rem;
  }

  .img-item:nth-child(1),
  .img-item:nth-child(2),
  .img-item:nth-child(3) {
    margin-right: 0;
  }

  .img-item:hover {
    opacity: 0.8;
  }

  .product-content {
    padding: 2rem 1rem;
  }

  .product-title {
    font-size: 3rem;
    text-transform: capitalize;
    font-weight: 700;
    position: relative;
    color: #12263a;
    margin: 1rem 0;
  }

  .product-title::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 4px;
    width: 80px;
    background: #12263a;
  }

  .product-link {
    text-decoration: none;
    text-transform: uppercase;
    font-weight: 400;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 0.5rem;
    background: #256eff;
    color: #fff;
    padding: 0 0.3rem;
    transition: all 0.5s ease;
  }

  .product-link:hover {
    opacity: 0.9;
  }

  .product-rating {
    color: #ffc107;
  }

  .product-rating span {
    font-weight: 600;
    color: #252525;
  }

  .product-price {
    margin: 1rem 0;
    font-size: 1rem;
    font-weight: 700;
  }

  .product-price span {
    font-weight: 400;
  }

  .last-price span {
    color: #f64749;
    text-decoration: line-through;
  }

  .new-price span {
    color: #256eff;
  }

  .product-detail h2 {
    text-transform: capitalize;
    color: #12263a;
    padding-bottom: 0.6rem;
  }

  .product-detail p {
    font-size: 0.9rem;
    padding: 0.3rem;
    opacity: 0.8;
  }

  .product-detail ul {
    margin: 1rem 0;
    font-size: 0.9rem;
  }

  .product-detail ul li {
    margin: 0;
    list-style: none;
    background: url(https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/checked.png) left center no-repeat;
    background-size: 18px;
    padding-left: 1.7rem;
    margin: 0.4rem 0;
    font-weight: 600;
    opacity: 0.9;
  }

  .product-detail ul li span {
    font-weight: 400;
  }

  .purchase-info {
    margin: 1.5rem 0;
  }

  .purchase-info input,
  .purchase-info .btn {
    border: 1.5px solid #ddd;
    border-radius: 25px;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;

  }

  .purchase-info input {
    width: 60px;
  }

  .purchase-info .btn {
    cursor: pointer;
    color: #fff;
    background: #f64749;
  }

  .purchase-info .btn:first-of-type {
    background: #256eff;
  }

  .purchase-info .btn:last-of-type {
    background: #f64749;
  }

  .purchase-info .btn:hover {
    opacity: 0.9;
  }

  .social-links {
    display: flex;
    align-items: center;
  }

  .social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #000;
    border: 1px solid #000;
    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
  }

  .social-links a:hover {
    background: #000;
    border-color: transparent;
    color: #fff;
  }

  @media screen and (min-width: 992px) {
    .card {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-gap: 1.5rem;
    }

    .card-wrapper {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .product-imgs {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .product-content {
      padding-top: 0;
    }
  }
</style>
<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

//get_header();

/* Start the Loop */
while (have_posts()) :
  the_post();

?>

  <div class="card-wrapper" id="content">

    <div class="card">
      <!-- card left -->
      <div class="product-imgs">
        <div class="img-display">
          <div class="img-showcase">
            <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail'); ?>
            <img src="<?php echo $image[0]; ?>" alt="shoe image">
            <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt="shoe image">
            <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt="shoe image">
            <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt="shoe image">
          </div>
        </div>

        <div class="img-select">
          <div class="img-item">
            <a href="#" data-id="2">
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg" alt="shoe image">
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="3">
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg" alt="shoe image">
            </a>
          </div>
          <div class="img-item">
            <a href="#" data-id="4">
              <img src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg" alt="shoe image">
            </a>
          </div>
          <?php
          $post_id = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE (meta_key = 'gallery' AND post_id = $post->ID)");
          $array = $post_id[0]->meta_value;
          $str = explode(", ", $array);
          //print_r($str);
          foreach ($str as $src) {
            $url = wp_get_attachment_image_src($src, $size = 'thumbnail');
          ?>
            <div class="img-item">
              <a href="#" data-id="1">
                <img src="<?php echo $url[0]; ?>" alt="shoe image">
              </a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <!-- card right -->
      <div class="product-content">
        <h2 class="product-title"><?php the_title(); ?></h2>
        <a href="#" class="product-link">visit nike store</a>
        <div class="product-rating">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star-half-alt"></i>
          <span>4.7(21)</span>
        </div>

        <div class="product-price">
          <p class="last-price">Old Price: <span>$257.00</span></p>
          <p class="new-price">New Price: <span>$249.00 (5%)</span></p>
        </div>

        <div class="product-detail" id="product-detail">
          <h2>about this item: </h2>
          <p><?php the_content(); ?></p>
          <ul>
            <li>Reference: <span><?php echo get_post_meta($post->ID, 'reference', true); ?></span></li>
            <li>Reference_externe: <span><?php echo get_post_meta($post->ID, 'reference_externe', true); ?></span></li>
            <li>Type: <span><?php echo get_post_meta($post->ID, 'type', true); ?></span></li>
            <li>Marque: <span><?php echo get_post_meta($post->ID, 'marque', true); ?></span></li>
            <li>Version: <span><?php echo get_post_meta($post->ID, 'version', true); ?></span></li>
            <li>Annee: <span><?php echo get_post_meta($post->ID, 'annee', true); ?></span></li>
            <li>Energie: <span><?php echo get_post_meta($post->ID, 'energie', true); ?></span></li>
            <li>Typeboite: <span><?php echo get_post_meta($post->ID, 'typeboite', true); ?></span></li>
            <li>Puissance_fiscale: <span><?php echo get_post_meta($post->ID, 'puissance_fiscale', true); ?></span></li>
            <li>Prix_neuf: <span><?php echo get_post_meta($post->ID, 'prix_neuf', true); ?></span></li>
          </ul>
        </div>

        <div class="purchase-info">
          <input type="number" min="0" value="1">
          <button type="button" class="btn">
            Add to Cart <i class="fas fa-shopping-cart"></i>
          </button>
          <button type="button" class="btn">Compare<i class="fas fa-shopping-cart"></i></button>
          <button type="button" id="GetFile" class="btn">Download Pdf</button>
        </div>

        <div class="social-links">
          <p>Share At: </p>
          <a href="#">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#">
            <i class="fab fa-whatsapp"></i>
          </a>
          <a href="#">
            <i class="fab fa-pinterest"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php
  //get_template_part( 'template-parts/content/content-single' );

  if (is_attachment()) {
    // Parent post navigation.
    the_post_navigation(
      array(
        /* translators: %s: Parent post link. */
        'prev_text' => sprintf(__('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentytwentyone'), '%title'),
      )
    );
  }

  // If comments are open or there is at least one comment, load up the comment template.
  if (comments_open() || get_comments_number()) {
    comments_template();
  }

  // Previous/next post navigation.
  $twentytwentyone_next = is_rtl() ? twenty_twenty_one_get_icon_svg('ui', 'arrow_left') : twenty_twenty_one_get_icon_svg('ui', 'arrow_right');
  $twentytwentyone_prev = is_rtl() ? twenty_twenty_one_get_icon_svg('ui', 'arrow_right') : twenty_twenty_one_get_icon_svg('ui', 'arrow_left');

  $twentytwentyone_next_label     = esc_html__('Next post', 'twentytwentyone');
  $twentytwentyone_previous_label = esc_html__('Previous post', 'twentytwentyone');

  the_post_navigation(
    array(
      'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . $twentytwentyone_next . '</p><p class="post-title">%title</p>',
      'prev_text' => '<p class="meta-nav">' . $twentytwentyone_prev . $twentytwentyone_previous_label . '</p><p class="post-title">%title</p>',
    )
  );
endwhile; // End of the loop.

//get_footer();
?>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js" integrity="sha256-c9vxcXyAG4paArQG3xk6DjyW/9aHxai2ef9RpMWO44A=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<script>
  //js from codepan
  const imgs = document.querySelectorAll('.img-select a');
  const imgBtns = [...imgs];
  let imgId = 1;

  imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
      event.preventDefault();
      imgId = imgItem.dataset.id;
      slideImage();
    });
  });

  function slideImage() {
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
  }

  window.addEventListener('resize', slideImage);
</script>
<script>
  //Download pdf
  var doc = new jsPDF();
  var specialElementHandlers = {
    '#editor': function(element, renderer) {
      return true;
    }
  };

  $('#GetFile').on('click', function() {
    doc.fromHTML($('#product-detail').html(), 15, 15, {
      'width': 170,
      'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
  });


  /**$('#GetFile').click(function () {
      domtoimage.toPng(document.getElementById('product-detail'))
        .then(function (blob) {
            var pdf = new jsPDF('l', 'pt', [$('#product-detail').width(), $('#product-detail').height()]);
            pdf.addImage(blob, 'PNG', 0, 0, $('#product-detail').width(), $('#product-detail').height());
            pdf.save("test.pdf");
        });
  });*/
</script>