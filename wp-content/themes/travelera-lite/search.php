<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage travelera
 * @since Travelera 1.0
 */

get_header(); ?>

<div class="main-wrapper" itemscope itemtype="http://schema.org/SearchResultsPage">
	<div class="cat-title-wrap">
        <div class="container">
            <h1 class="category-title">
                <?php esc_html_e('Search Results for', 'travelera-lite'); echo '&nbsp;"<span itemprop="about">' . get_search_query() . '</span>"'; ?>
            </h1>
        </div>
	</div><!--."cat-title-wrap-->

	<div class="container">
		<div class="main-content clearfix">
		<div class="content-area home-content-area">
            <div id="content" class="content content-search clearfix">
                <?php
                    $travelera_post_counter = 1;
                
                    // Start the Loop.
                    if (have_posts()) : while (have_posts()) : the_post();

                        get_template_part( 'template-parts/post/post-formats/content' );

                    endwhile;

                    else:
                        // If no content, include the "No posts found" template.
                        get_template_part( 'template-parts/post/post-formats/content', 'none' );

                    endif;
                ?>
            </div><!--content-->
            <?php 
                // Previous/next page navigation.
                travelera_paging_nav();
            ?>
		</div><!--content-area-->
		<?php
			$travelera_layout_array = array(
                'cb',
				'flayout'
			);

			if ( !in_array( travelera_theme_mod('archive_layout'), $travelera_layout_array ) ) {
				get_sidebar();
			}
		?>
<?php get_footer(); ?>