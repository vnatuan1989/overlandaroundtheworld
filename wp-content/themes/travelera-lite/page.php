<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage travelera
 * @since Travelera 1.0
 */

get_header();

// Page Variables
$travelera_slider = travelera_theme_mod('featured_slider');
$travelera_page_layout = travelera_theme_mod('single_layout');
?>

<div class="main-wrapper">
    <?php
        // Include Slider
        if ( is_home() || is_front_page() ) {
            if( $travelera_slider == '1' ) {
                if( !is_paged() ) {
                    get_template_part('inc/slider');
                }
            }
        }
    ?>
	<div class="container">
		<div class="main-content clearfix <?php travelera_layout_class(); ?>">
			<div class="content-area single-content-area">
				<div class="content content-page">
					<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
                        <div class="shadow-box">
                            <?php
                                if ( travelera_theme_mod( 'breadcrumbs' ) == '1' ) { ?>
                                    <div class="breadcrumbs" itemtype="http://schema.org/BreadcrumbList" itemscope="">
                                        <?php travelera_breadcrumb(); ?>
                                    </div>
                                    <?php
                                }
                            ?>
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                <div class="post-box post-inner">
                                    <header>
                                        <h1 class="title page-title"><?php the_title(); ?></h1>
                                    </header>

                                    <?php
                                        if ( has_post_thumbnail() ) { ?>
                                            <div class="featured-img-page clearfix">
                                                <?php the_post_thumbnail( 'travelera-featured' ); ?>
                                            </div>
                                            <?php
                                        }
                                    ?>

                                    <div class="post-content entry-content single-page-content">
                                        <?php
                                            the_content();
                                        
                                            edit_post_link( esc_html__( 'Edit', 'travelera-lite' ), '<span class="edit-link">', '</span>' );
                                        
                                            wp_link_pages('before=<div class="pagination">&after=</div>');
                                        ?>
                                    </div>
                                </div><!--.post-box-->
                            </article><!--post-->
						</div><!-- .shadow-box -->
						<?php
							comments_template();
							
							endwhile;
							
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'template-parts/post-formats/content', 'none' );
							endif;
						?>
				</div><!--.content-page-->
			</div><!--.content-area-->
			<?php				
				if ( $travelera_page_layout != 'flayout' ) {
				    get_sidebar();
				}
			?>
<?php get_footer();?>