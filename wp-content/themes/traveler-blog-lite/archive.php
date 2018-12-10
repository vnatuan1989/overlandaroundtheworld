<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */


get_header(); ?>
<div class="content-row">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) :
			?>		
			<div class="traveler-blog-lite-catdes">
				<header class="page-header">
					<?php
						the_archive_title( '<h2 class="page-title">', '</h2>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->
			</div>
			<div class="post-loop-wrap clearfix" id="post-<?php the_ID(); ?>">
			<?php			
			/* Start the Loop */
			while ( have_posts() ) : the_post();
                     
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );
			
			endwhile; ?>
			</div>
			<?php
			the_posts_pagination( array(
				'prev_text' => esc_html__( '&larr; Previous', 'traveler-blog-lite' ),
				'next_text' => esc_html__( 'Next &rarr;', 'traveler-blog-lite' ),
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div> <!-- Content-row -->
<?php
get_footer();