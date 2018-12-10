<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage travelera
 * @since Travelera 1.0
 */

// Page Variables
$travelera_layout = travelera_theme_mod('single_layout');

get_header(); ?>

<div class="main-wrapper">
	<div class="container">
		<div class="main-content clearfix <?php travelera_layout_class(); ?>">
			<div class="content-area">
				<div class="content content-page">
					<div class="content-detail">
						<div class="page-content">
							<div class="post-box shadow-box error-page-content">
                                <span class="fa fa-frown-o"></span>
								<div class="error-head"><span><?php esc_html_e('Oops, This Page Could Not Be Found!','travelera-lite'); ?></span></div>
								<div class="error-text">
                                    <?php esc_html_e('404','travelera-lite'); ?>
                                </div>
								<p>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button back-to-home"><?php esc_html_e('Back to Homepage','travelera-lite'); ?></a>
                                </p>
								<p>
									<?php esc_html_e( 'It seems we can\'t find what you&rsquo;re looking for. Perhaps searching can help.', 'travelera-lite' ); ?>
								</p>
								<?php get_search_form(); ?>
							</div>
						</div><!--.page-content-->
					</div>
				</div><!--.content-->
			</div><!--.content-area-->
            <?php
                $travelera_layout_array = array(
                    'cb'
                );

                if( !in_array( $travelera_layout, $travelera_layout_array ) ) {
                    get_sidebar();
                }
            ?>
		</div><!--.main-content-->
<?php get_footer();?>