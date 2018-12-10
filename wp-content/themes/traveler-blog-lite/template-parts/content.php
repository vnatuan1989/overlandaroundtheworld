<?php
/**
 * 
 * Template part for including posts design formate wise
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package Traveler Blog Lite
 * @since 1.0 
 * 
 */

$show_blog_content 	= traveler_blog_lite_get_theme_mod( 'blog_show_content' );
$show_cat_content 	= traveler_blog_lite_get_theme_mod( 'cat_show_content' );


?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
	<div class="traveler-blog-lite-post-innr">   
		<div class="traveler-blog-lite-post-image-bg">  
					<?php get_template_part( 'template-parts/content', 'media' ); ?>
		</div>	
		<div class="blogdesign-post-grid-content <?php if ( !has_post_thumbnail() ) { echo 'no-thumb-image'; } ?>">				
				<header class="entry-header">
					
						<?php if (is_sticky()) : ?>
										<span class="sticky-label"><i class="fa fa-thumb-tack"></i><span class="sticky-label-text"><?php esc_html_e('Featured', 'traveler-blog-lite'); ?></span></span>
						<?php endif; ?>
					    <?php if ( 'page' !== get_post_type() ) { traveler_blog_lite_cat_posted_on(); }   ?>
						<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
								
						<?php if ( 'page' !== get_post_type() ) { traveler_blog_lite_posted_on(); }  ?>
								
				</header><!-- .entry-header -->
				<?php if ( is_search() ) { ?>
					<div class="entry-summary">
				<?php    
						the_excerpt();
				} else { ?>
					<div class="entry-content">
				<?php 
						$ismore = ! empty( $post->post_content ) ? strpos( $post->post_content, '<!--more-->' ) : '';
						if ( ! empty( $ismore ) ) {
								/* translators: %s: Name of current post */
								the_content( sprintf(
												esc_html__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'traveler-blog-lite' ),
												get_the_title()
										) );
						} else {
							if((!empty($show_blog_content) && is_home()) || (!empty($show_blog_content) && is_search()) || (!empty($show_blog_content) && is_author())){
								the_excerpt();				
							} else if((!empty($show_cat_content) && is_archive()) || (!empty($show_cat_content) && is_category())) {
								the_excerpt();
							}
						}
						wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'traveler-blog-lite' ),
								'after'  => '</div>',
						) );

				}
				traveler_blog_lite_tags_posted_on();
				 ?>
				 
					<footer class="entry-footer">
							<?php traveler_blog_lite_entry_footer(); ?>
					</footer><!-- .entry-footer -->
					
					</div><!-- .entry-content --><!-- .entry-summary -->
				</div>       
	</div>
</article><!-- #post-## -->