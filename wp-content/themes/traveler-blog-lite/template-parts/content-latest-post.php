<?php	
$number_of_lastestpost = traveler_blog_lite_get_theme_mod( 'number_of_lastestpost' );
$cat = traveler_blog_lite_get_theme_mod( 'select_category_for_slider' );
	$query = new WP_Query( array (
				'post_type'      		=> 'post',
				'post_status' 			=> array('publish'),
				'order'          		=> 'DESC',
				'orderby'        		=> 'date', 
				'cat'					=> esc_html($cat),
				'posts_per_page' 		=> absint($number_of_lastestpost),
				'ignore_sticky_posts'	=> true,
			));

	// If post is there
	if( $query->have_posts() ) {
?>
		
			<div class="owl-carousel latest-carousel-post-slider">
				<?php
					while ($query->have_posts()) : $query->the_post();
					$featured_img_url = get_the_post_thumbnail_url($post->ID,'large');
					
				?>
				<div class="owl-carousel-post-slide-main">
					<div class="owl-carousel-post-slide">
						<div class="traveler-blog-lite-content traveler-blog-lite-col-4 traveler-blog-lite-columns">
							<div class="traveler-blog-lite-slider-content">	
								<?php traveler_blog_lite_cat_posted_on(); ?>
								<div class="entry-title-header bgs">							
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								</div>
								<div class="entry-meta posted-on">
										   <?php traveler_blog_lite_latest_posted_on(); ?> 
								</div>
								<div class="entry-summary">
									<?php  the_excerpt(); ?>
								</div>	
							</div>
						</div>
						<div class="traveler-blog-lite-col-8 traveler-blog-lite-columns">
							<div class="entry-media">
								<a class="entry-image-link" href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>" style="background-image: url(<?php echo esc_url($featured_img_url); ?>)"></a>
							</div><!-- end .entry-image-bg -->
						</div>	
					</div>	
					</div><!-- end .medium-12 columns -->
				<?php endwhile;  ?>
			</div><!-- end .row -->

<?php
	wp_reset_postdata();// Reset query
} // End of check have post