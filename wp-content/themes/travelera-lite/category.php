<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage travelera
 * @since Travelera 1.0
 */

get_header();

// Page Variables
$travelera_layout = travelera_theme_mod('archive_layout');
?>

<div class="main-wrapper">
	<div class="cat-title-wrap">
        <h1 class="category-title">
            <?php printf( wp_kses(__( 'Category: <span>%s</span>', 'travelera-lite' ), array( 'span' => array() ) ), single_cat_title( '', false ) ); ?>
        </h1>
        <?php
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
        ?>
        <span class="uppercase archive-articles-count plane-right">
            <span class="plane-left">
                <?php
                    $travelera_cat = get_the_category();
                    $travelera_cat = $travelera_cat[0];
                    $travelera_cat_count = $travelera_cat->category_count;
                    printf( _n( '%s Article', '%s Articles', intval( $travelera_cat_count ), 'travelera-lite' ), intval( $travelera_cat_count ) );
                ?>
            </span>
        </span>
	</div>
    
	<div class="container">
		<div class="main-content clearfix">
			<div class="archive-page">
				<div class="content-area archive-content-area">
                    <div class="content content-archive">
				        <div id="content" class="clearfix">
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
						</div><!--.content-->
						<?php 
							// Previous/next page navigation.
							travelera_paging_nav();
						?>
					</div><!--.content-archive-->
				</div><!--#content-->
				<?php
					$travelera_layout_array = array(
                        'cb',
                        'flayout'
                    );

                    if ( !in_array( $travelera_layout, $travelera_layout_array ) ) {
                        get_sidebar();
                    }
				?>
			</div><!--.archive-page-->
<?php get_footer(); ?>