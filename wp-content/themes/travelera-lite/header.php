<!DOCTYPE html>
<?php
    // Page Variables
    $travelera_header_style = travelera_theme_mod('header_style');
    $travelera_header_search = travelera_theme_mod('header_search');
?>
<html <?php language_attributes(); ?>>
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta itemprop="url" content="<?php echo esc_url( home_url( '/' ) ); ?>"/>
    <meta itemprop="name" content="<?php bloginfo( 'name' ); ?>"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<?php wp_head(); ?>
</head>
<body id="blog" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'travelera-lite' ); ?></a>
    <nav class="mobile-menu">
        <div class="mobile-menu-bg"></div>
        <?php
            if ( has_nav_menu( 'main-menu' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'menu_class'     => 'menu',
                    'container'      => '',
                ) );
            }

            if ( travelera_theme_mod('header_social_links') == 'enable' ) {
                travelera_social_links( 'header' );
            }
        ?>
    </nav>
    <div class="main-container <?php travelera_layout_class(); ?>">
        <div class="menu-pusher">
            <!-- START HEADER -->
            <?php
                if ( empty( $travelera_header_style ) )  {
                    $travelera_header_style = '1';
                }
                get_template_part('template-parts/header/header-'.$travelera_header_style );

                if ( $travelera_header_search == '1' ) {
                    get_template_part('template-parts/header/modal-search' );
                }
            ?>
            <!-- END HEADER -->