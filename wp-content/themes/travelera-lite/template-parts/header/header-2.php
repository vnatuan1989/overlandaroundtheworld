<header class="main-header header-2 t-center clearfix" id="site-header" itemscope itemtype="http://schema.org/WPHeader">
	<div class="header bb clearfix">
		<div class="container">
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
		</div><!-- .container -->
	</div><!-- .header -->
    <?php if ( travelera_theme_mod('header_social_links') == 'enable' || has_nav_menu( 'main-menu' ) || travelera_theme_mod('header_search') == 'enable' ) { ?>
	<div class="main-navigation">
		<div class="main-nav nav-down">
			<div class="container">
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
			</div><!-- .container -->
		</div><!-- .main-nav -->
	</div><!-- .main-navigation -->
    <?php } ?>
</header>