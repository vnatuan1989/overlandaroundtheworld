<?php
/**
 * Template Name: Full-width Page Template, No Sidebar

 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area content-area-full-width">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</main><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>