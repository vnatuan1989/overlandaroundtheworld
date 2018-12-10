<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage travelera
 * @since Travelera 1.0
 */

get_header();

// Page Variables
$travelera_single_post_layout = travelera_theme_mod('single_layout');

if ( have_posts() ) : the_post();

    if ( function_exists( 'rwmb_meta' ) ) {
        $sidebar_position = rwmb_meta( 'travelera_layout', $args = array('type' => 'image_select'), $post->ID );
    } else {
        $sidebar_position = '';
    }
?>
<div class="main-wrapper">
	<div class="container">
		<div class="main-content clearfix">
			<div id="content" class="content-area single-content-area">
				<div class="content content-single">
					<?php
                        rewind_posts(); while (have_posts()) : the_post(); ?>

                        <div class="single-content-wrap shadow-box">
                            <?php
                                if( travelera_theme_mod( 'breadcrumbs' ) == '1' ) { ?>
                                    <div class="breadcrumbs" itemtype="http://schema.org/BreadcrumbList" itemscope="">
                                        <?php travelera_breadcrumb(); ?>
                                    </div>
                                    <?php
                                }
                            
                                // Post Content
                                get_template_part( 'template-parts/post/post-body-single' );

                                // Author Box
                                if ( travelera_theme_mod( 'author_box' ) == '1' ) {
                                    if ( get_the_author_meta('description') ) {
                                        get_template_part( 'template-parts/post/author-box' );
                                    }
                                }

                                // Post Navigation
                                if ( travelera_theme_mod( 'next_prev_links' ) == '1' ) {
                                    get_template_part( 'template-parts/post/post-navigation' );
                                }
                            ?>
                        </div>
                        <?php
                        // Related Posts
                        if ( travelera_theme_mod( 'related_posts' ) == '1' ) {
                            get_template_part( 'template-parts/post/related-posts' );
                        }

                        endwhile;

                        else :
                            // If no content, include the "No posts found" template.
                            get_template_part( 'template-parts/post-formats/content', 'none' );

                        endif;

                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
				</div>
			</div>
			<?php 				
				if ( $travelera_single_post_layout != 'flayout' ) {
					if ( $sidebar_position == 'cb-ls' || $sidebar_position == 'cb-rs' || $sidebar_position == 'default' || empty( $sidebar_position ) ) {
						get_sidebar();
					}
				}
// Footer
get_footer(); ?>