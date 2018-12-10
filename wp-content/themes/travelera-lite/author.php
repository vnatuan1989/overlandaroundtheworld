<?php
/**
 * The template for displaying Author archive pages
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

<div class="main-wrapper" itemscope itemtype="http://schema.org/ProfilePage">
    <div class="author-box author-desc-box" itemprop="author" itemscope itemtype="https://schema.org/Person">
        <div class="container">
            <div class="author-page-info archive-cover-content">
                <div class="author-avtar">
                    <?php echo get_avatar( get_the_author_meta('email'), '100' ); ?>
                </div><!--.author-avtar-->
                
                <div class="author-head">
                    <h5 itemprop="name"><?php esc_attr( the_author_meta('display_name') ); ?></h5>
                </div><!--.author-head-->
                
                <span class="uppercase archive-articles-count plane-right">
                    <span class="archive-articles-count-inner plane-left">
                        <?php the_author_posts(); ?>
                        <?php esc_html_e('Articles','travelera-lite'); ?>
                    </span>
                </span>
                
                <?php if ( get_the_author_meta('description') ) { ?>
                    <div class="author-desc" itemprop="description"><?php esc_attr( the_author_meta('description') ); ?></div>
                <?php } ?>
            </div><!--.author-page-info-->
        </div>
    </div><!--.author-box-->
    
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

                    if( !in_array( $travelera_layout, $travelera_layout_array ) ) {
                        get_sidebar();
                    }
				?>
			</div><!--.archive-page-->
<?php get_footer(); ?>