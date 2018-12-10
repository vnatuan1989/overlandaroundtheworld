<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the .main-wrapper and #page div elements.
 *
 * @package WordPress
 * @subpackage travelera
 * @since travelera 1.0
 */

// Page Variables
$travelera_footer_columns = travelera_theme_mod('footer_layout');
$travelera_footer_text = travelera_theme_mod('copyright_text');
$travelera_scroll_btn = travelera_theme_mod('scroll_top');
?>
            </div><!--.main-content-->
		</div><!--.container-->
	</div><!--.main-wrapper-->

    <?php
        if ( travelera_theme_mod('footer_social_links') == 'enable' ) {
            travelera_social_links( 'footer' );
        }
    ?>

    <footer id="site-footer" class="footer site-footer clearfix" itemscope itemtype="http://schema.org/WPFooter">
        <div class="footer-bg-img"></div>
        <div class="container">
                <?php
                    dynamic_sidebar( 'before-footer-1' );
                ?>
        </div>
        <div class="container">
            <?php
                // Footer Widgets
                if ( $travelera_footer_columns != '0' ) { ?>
                    <div class="footer-widgets clearfix footer-columns-<?php echo esc_attr( $travelera_footer_columns ); ?>">
                        <?php
                        for ( $i = 1; $i <= $travelera_footer_columns; $i++ ) {
                            $travelera_widget_id = 'footer-' . $i;
                            $travelera_last_class = ( $i == $travelera_footer_columns ) ? ' last' : '';
                            
                            if ( is_active_sidebar( $travelera_widget_id ) ) :
                                echo '<div class="footer-widget footer-widget-' . esc_attr( $i ) . $travelera_last_class . '">';
                                    dynamic_sidebar( $travelera_widget_id );
                                echo '</div>';
                            endif;
                        }
                        ?>
                    </div><!-- .footer-widgets -->
                    <?php
                }
            ?>
        </div><!-- .container -->
        <div class="copyright clearfix">
            <div class="container">
                <div class="copyright-text">
                    <?php
                        $travelera_allowed_html = array(
                            'a' => array(
                                'href' => array(),
                                'title' => array()
                            ),
                            'br' => array(),
                            'em' => array(),
                            'strong' => array(),
                            'h1' => array(),
                            'p' => array(
                                'style' => array(),
                            ),
                            'span' => array(
                                'style' => array(),
                            ),
                        );
                        if ( $travelera_footer_text != '' ) {
                            echo wp_kses( $travelera_footer_text, $travelera_allowed_html );
                        } else {
                            printf( esc_html__( '&copy; Copyright 2018. Theme by %s', 'travelera-lite' ), '<a href="'.esc_url( 'https://www.bloompixel.com/' ).'">BloomPixel</a>' );
                        }
                    ?>
                </div>
                <?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
                    <div class="footer-menu">
                        <?php
                            wp_nav_menu( array(
                                'theme_location' => 'footer-menu',
                                'menu_class'     => 'menu',
                                'container'      => '',
                                'depth'          => '1',
                            ) );
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div><!-- .copyright -->
    </footer>
    <div class="site-overlay"></div>
	</div><!-- .st-pusher -->
</div><!-- .main-container -->
<?php if ( $travelera_scroll_btn == 'show' ) { ?>
	<div class="back-to-top transition"><i class="fa fa-arrow-up"></i></div>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>