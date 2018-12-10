<header class="main-header header-1 bb clearfix" id="site-header" itemscope itemtype="http://schema.org/WPHeader">
    <div class="container">
	   <div class="header clearfix">
            <div class="menu-btn off-menu">
                <span class="fa fa-align-justify" aria-hidden="true"></span>
                <span class="screen-reader-text"><?php esc_html_e('Menu','travelera-lite'); ?></span>
            </div>
           
			<?php travelera_custom_logo(); ?>
           
            <?php
                if ( travelera_theme_mod('header_search') == 'enable' ) {
                    get_template_part( 'template-parts/header/header-search' );
                }
            ?>

            <div class="main-navigation clearfix">
                <div class="main-nav nav-down clearfix">
                    <?php 
                        if ( travelera_theme_mod('header_social_links') == 'enable' ) {
                            travelera_social_links( 'header' );
                        }
                    ?>
                    <nav class="nav-menu" id="nav-menu" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php
                        if ( has_nav_menu( 'main-menu' ) ) {
                            wp_nav_menu( array(
                                'theme_location' => 'main-menu',
                                'menu_class'     => 'menu',
                                'container'      => '',
                            ) );
                        }
                    ?>
				</nav>
                <?php
                    if ( travelera_theme_mod('header_search') == 'enable' ) {
				        get_template_part( 'template-parts/header/header-search' );
                    }
                ?>
                </div><!-- .main-nav -->
            </div><!-- .main-navigation -->
	   </div><!-- .header -->
    </div><!-- .container -->
</header>