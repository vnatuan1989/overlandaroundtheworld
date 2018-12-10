<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage travelera
 * @since Travelera 1.0
 */

get_header();

// Page Variables
$travelera_slider = travelera_theme_mod('featured_slider');
$travelera_blog_layout = travelera_theme_mod('main_layout');
?>

<div class="main-wrapper clearfix">
    <?php
        // Include Featured Slider
        if( $travelera_slider == '1' ) {
            if( !is_paged() ) {
                get_template_part('template-parts/slider');
            }
        }
    ?>
	<div class="container">
		<div class="main-content clearfix">
            <div class="content-area home-content-area">
                <div class="content content-home">
                    <div id="content" class="clearfix">
                        <?php
                            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                            elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                            else { $paged = 1; }

                            					
                            $args = array(
                                'post_type' => 'post',
                                'paged'     => $paged
                            );

                            // The Query
                            query_posts( $args );

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
                </div><!--content-page-->
            </div><!--content-area-->
            <?php
                $travelera_layout_array = array(
                    'cb',
                    'col3-mason',
                    'col2-mason',
                    'flayout'
                );

                if( !in_array( $travelera_blog_layout, $travelera_layout_array ) ) {
                    get_sidebar();
                }
            ?>
<?php get_footer(); ?>