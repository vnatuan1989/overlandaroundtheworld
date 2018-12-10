<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */


get_header(); ?>

<div class="content-row">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
           <div class="traveler-blog-lite-catdes">
			<header class="page-header">
				<h1 class="page-title">
					<?php
						/* translators: the search query */
						printf( esc_html__( 'Search Results for: %s', 'traveler-blog-lite' ), '<span>"' . get_search_query() . '"</span>' );
					?>
				</h1>
			</header><!-- .page-header -->
           </div>   
           <div class="post-loop-wrap clearfix" id="post-<?php the_ID(); ?>">
			<?php
			/* Start the Loop */
            $i = 1;
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;?>
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
