<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
get_header();   ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="error-image">
					<img alt="<?php esc_attr_e( '404', 'traveler-blog-lite' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/404.png' ); ?>" />
				</div>
				<div class="page-content">
					<p><?php esc_html_e( "OOPS! Page you're looking for doesn't exist. Please use search for help", 'traveler-blog-lite' ); ?></p>
					<?php get_search_form(); ?>
					<a class="go-back-home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php esc_html_e( 'Back to Home Page', 'traveler-blog-lite' ); ?>
					</a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();