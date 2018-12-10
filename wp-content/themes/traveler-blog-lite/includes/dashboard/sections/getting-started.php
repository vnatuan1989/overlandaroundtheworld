<?php
/**
 * Display Welcome page Getting started section.
 *
 * @package Traveler Blog Lite
 * @since 1.0
 * 
 */ 

?>
<div id="getting-started" class="gt-tab-pane gt-is-active">
    <div class="feature-section two-col">
        <div class="col">
                <h3><?php esc_html_e( 'Customize The Theme', 'traveler-blog-lite' ); ?></h3>
                <p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'traveler-blog-lite' ); ?></p>
                <p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start Customize', 'traveler-blog-lite' ); ?></a>
				<a href="<?php echo esc_url( 'http://demo.wponlinesupport.com/themes/traveler-blog-lite/'); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'View Demo', 'traveler-blog-lite' ); ?></a> </p>
				
        </div>

        <div class="col">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/screenshot.jpg" alt="<?php esc_attr_e( 'screenshot', 'traveler-blog-lite' ); ?>">
        </div>
    </div>
</div>