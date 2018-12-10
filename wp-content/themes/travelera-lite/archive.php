<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
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
	<div class="cat-title-wrap archive-cover-box">
		<div class="archive-cover-content">
            <?php
                the_archive_title( '<h1 class="category-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
		</div>
	</div><!--."cat-title-wrap-->
    
	<div class="container">
		<div class="main-content clearfix">
			<div class="archive-page">
				<div class="content-area archive-content-area">
                    <div class="content content-archive">
				        <div id="content" class="clearfix">
							<?php
                                $travelera_post_counter = 1;
                            
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

                    if( !in_array( $travelera_layout, $travelera_layout_array ) ) {
                        get_sidebar();
                    }
				?>
			</div><!--.archive-page-->
<?php get_footer(); ?>