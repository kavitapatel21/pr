<?php
/**
 * Template Name: Portfolio  Single Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package htportfolio
 */

get_header();?>
<div class="page-wrapper clear">
	
		<?php if( have_posts() ) : ?>

			<?php while( have_posts() ) : the_post(); 
				$htportfolio_related_post_show = htportfolio_get_option( 'htportfolio_related_post_show', 'htportfolio_settings','yes' );
				$relatedtitle = htportfolio_get_option( 'htportfolio_related_title_text', 'htportfolio_settings','Related Portfolio' );
				$htportfolio_title_text = htportfolio_get_option( 'htportfolio_title_text', 'htportfolio_settings','yes' );
				$htportfolio_thumbimage_show = htportfolio_get_option( 'htportfolio_thumbimage_show', 'htportfolio_settings','yes' );
				$htportfolio_info_show = htportfolio_get_option( 'htportfolio_info_show', 'htportfolio_settings','yes' );
				$htportfolio_desc_text = htportfolio_get_option( 'htportfolio_desc_text', 'htportfolio_settings','yes' );
			?>
				
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<?php if($htportfolio_thumbimage_show =='yes'){?>
							<div class="branding-img">
								<?php 
								if(has_post_thumbnail() ){ 
									the_post_thumbnail( 'ht_portfolio_content_image', array( 'class' => 'img-responsive' ) );
								 }?>
							</div>
							<?php } ?>
						</div> 
						<div class="col-lg-6">
							<div class="banner-info">
								<?php if($htportfolio_title_text =='yes'){?>
								<h4><?php the_title(); ?></h4>
								<?php } ?>
								<?php if($htportfolio_desc_text =='yes'){?>
								<?php the_content(); ?>
								<?php } ?>
							   <div class="row">
								<?php $details  = get_post_meta( get_the_ID(),'_htportfolio_project_details', true ); ?>
								<?php $names  = get_post_meta( get_the_ID(),'_htportfolio_name_id', true ); ?>
								<?php $company  = get_post_meta( get_the_ID(),'_htportfolio_company_id', true ); ?>
								<?php $single_team  = get_post_meta( get_the_ID(),'_htportfolio_single_team', true ); ?>
								<?php $project_detailsp  = get_post_meta( get_the_ID(),'_htportfolio_project_detailsp', true ); ?>
								<?php $show_project  = get_post_meta( get_the_ID(),'_htportfolio_show_project', true ); ?>
							   <?php if($htportfolio_info_show =='yes'){?>
							   <div class="col-sm-6">
									<ul>
										<?php
										if($names){
											foreach( (array) $names as $name_akey => $name_a ){ 

											$name1=$name2="";

											if(isset($name_a['start_name'])){

											$name1=$name_a['start_name'];
											}

											if(isset($name_a['start_add'])){
											$name2=$name_a['start_add'];
										}
										?>
										<li><span><?php echo esc_html( $name1 ); ?>: </span><?php echo esc_html( $name2 ); ?>
										</li>
									<?php  } } ?>

									</ul>
							   </div>
							   <div class="col-sm-6">
									<ul>
										<?php
										if($company){
										foreach( (array) $company as $com_akey => $com_a ){ 

										$company=$company_address="";

										if(isset($com_a['start_com'])){
										$company=$com_a['start_com'];
										}
										if(isset($com_a['start_com_ad'])){
										$company_address=$com_a['start_com_ad'];
										}

										?>
										<li>
										<span><?php echo esc_html( $company ); ?>: </span><?php echo esc_html( $company_address ); ?>
										</li>
										<?php  } } ?>
									</ul>
							   </div>
							   <?php } ?>
							   </div>
							</div>
						</div> 
					</div>

					<div class="related-projects-area">
						<div class="row">
							<?php 
							$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3,'post_type' => 'ht_portfolios', 'post__not_in' => array($post->ID) ) );

							if($htportfolio_related_post_show =='yes'){
								?>
								<div class="col-lg-12 ">

									<h2 class="related-projects-title"><?php echo esc_html($relatedtitle);?></h2>
								</div>
								<?php
							 foreach( $related as $post ) { setup_postdata($post); ?>
									<article class="col-lg-4 col-md-4">
										<div class="single-related-project">
											<div class="related-project-img">
												<a href="<?php echo esc_url( get_permalink() );?>">
													<?php if ( has_post_thumbnail() ) : 
													
														 the_post_thumbnail('ht_portfolio_content_image');
													 endif; ?>
												</a>
											</div>
											<div class="portfolio-item-info">
												<h3><a href="<?php echo esc_url( get_permalink() );?>"><?php the_title(); ?></a></h3>

											<?php $portfolio_categories = get_the_terms(get_the_id(),'ht_portfolios_cat'); ?>
													
												<?php if( $portfolio_categories ){
													foreach( $portfolio_categories as $portfolio_category ) { ?> 
														<span class="portfolio-item-category"> 
															<?php echo esc_html( $portfolio_category->name ); ?>
														</span>
												<?php }} ?>
												
											</div>
										</div>
									</article>
							<?php }  } ?>
						</div>
					</div>
				</div>

			<?php endwhile; // while has_post(); ?>

		<?php endif; // if has_post() ?>
</div><!-- #primary -->
<?php
get_footer();