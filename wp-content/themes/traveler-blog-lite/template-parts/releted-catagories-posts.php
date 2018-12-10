<?php
	$category 			= get_the_category();
	$cat_id 			= $category[0]->term_id;
	$cat_name 			= $category[0]->cat_name;
	$current_post_id 	= get_the_ID();
	$related_post_title = get_theme_mod( 'related_post_title' );

	
	$query = new WP_Query( array (
				'post_type'      		=> 'post',
				'post__not_in' 	 		=> array($current_post_id),
				'showposts'      		=> 3,
				'orderby'       	 	=> 'post_date', 
				'order'          		=> 'DESC',
				'cat'            		=> $cat_id,
				'ignore_sticky_posts'	=> true,
			));

	// If post is there
	if( $query->have_posts() ) {
?>
<div class="traveler-blog-lite-related-posts clearfix">
	<div class="traveler-blog-lite-cat-posts">
		<h3><span><?php echo esc_html($related_post_title).' '. esc_html($cat_name); ?></span></h3>
			<div class="row">
				<?php
					while ($query->have_posts()) : $query->the_post();
					
				?>
					<div class="traveler-blog-lite-col-4 traveler-blog-lite-columns">
						<div class="traveler-blog-lite-related-posts-inner">
							<div class="entry-media">
								<a class="entry-image-link" href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('medium'); ?></a>
							</div><!-- end .entry-image-bg -->
							<div class="entry-meta posted-on">
                                       <?php traveler_blog_lite_posted_on( array('post_date', 'author') ); ?> 
                            </div>
							<div class="entry-title-header bgs">							
								<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							</div>
						</div>
					</div><!-- end .medium-4 columns -->
				<?php endwhile;  ?>
			</div><!-- end .row -->
	</div><!-- end .traveler-blog-lite-cat-posts -->
</div><!-- end .traveler-blog-lite-related-posts -->
<?php
	wp_reset_postdata();// Reset query
} // End of check have post