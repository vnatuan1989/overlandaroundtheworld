<?php
/**
 * Custom template tags for travelera
 *
 * @package WordPress
 * @subpackage travelera
 * @since travelera 1.0
 */

/*-----------------------------------------------------------------------------------*/
/*	Theme Layout Classes
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'travelera_layout_class' ) ) :
	function travelera_layout_class() {
		$travelera_class = '';
        $travelera_left_sidebar = array(
            'cb-ls'
        );
        $travelera_no_sidebar = array(
            'cb',
        );
		
		if ( is_home() || is_front_page() ) {
            $travelera_layout = travelera_theme_mod( 'main_layout' );
		}
		elseif ( is_archive() ) {
            $travelera_layout = travelera_theme_mod( 'archive_layout' );
		}
		elseif( is_single() || is_page() || is_404() ) {
            $travelera_layout = travelera_theme_mod( 'single_layout' );
		}

        $travelera_layout_class = $travelera_layout;

        if ( in_array( $travelera_layout, $travelera_left_sidebar ) ) {
            $travelera_sidebar_class = 'left-sidebar';
        }
        elseif ( in_array( $travelera_layout, $travelera_no_sidebar ) ) {
            $travelera_sidebar_class = 'no-sidebar';
        } else {
            $travelera_sidebar_class = '';
        }

        $travelera_class = $travelera_layout_class . ' ' . $travelera_sidebar_class;
		
        if ( $travelera_class ) {
            echo $travelera_class;
        }
	}
endif;

/**
 * RTL Check
 * -------------------------------------------------
 * Check if rtl layout is enabled
 * return data-rtl=true if enabled and false otherwise
 */
function travelera_slider_rtl_check() {
    if ( is_rtl() ) {
        $output = 'data-rtl="true"';
    } else {
        $output = 'data-rtl="false"';
    }
    
    echo $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Logo
/*-----------------------------------------------------------------------------------*/
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function travelera_custom_logo() {
    if ( has_custom_logo() ) {
        the_custom_logo();
    }
    else { ?>
        <?php if( is_front_page() || is_home() || is_404() ) { ?>
            <h1 id="logo" class="logo" itemprop="headline">
                <a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
            </h1>
        <?php } else { ?>
            <h2 id="logo" class="logo" itemprop="headline">
                <a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
            </h2>
        <?php } ?>
        <?php if ( travelera_theme_mod( 'tagline' ) == 'show' ) { ?>
        <p class="site-description" itemprop="description">
            <?php bloginfo( 'description' ); ?>
        </p>
        <?php }
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Add Span tag Around Categories and Archives Post Count
/*-----------------------------------------------------------------------------------*/
if( !function_exists('travelera_cat_count') ){ 
	function travelera_cat_count($links) {
		return str_replace(array('</a> (',')'), array('<span class="cat-count">','</span></a>'), $links);
	}
}
add_filter('wp_list_categories', 'travelera_cat_count');

if( !function_exists('travelera_archive_count') ){
	function travelera_archive_count($links) {
	  	return str_replace(array('</a>&nbsp;(',')'), array('<span class="cat-count">','</span></a>'), $links);
	}
}
add_filter('get_archives_link', 'travelera_archive_count');

/*-----------------------------------------------------------------------------------*/
/*	Modify <!--more--> Tag in Posts
/*-----------------------------------------------------------------------------------*/
// Prevent Page Scroll When Clicking the More Link
function travelera_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'travelera_remove_more_link_scroll' );

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'travelera_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since travelera 1.0
 */
function travelera_paging_nav() {
	if ( travelera_theme_mod('pagination_type') == 'nextprev') :
        ?>
        <nav class="navigation pagination">
            <?php
                if ( is_rtl() == '1' ) {
                    echo paginate_links( array(
                        'mid_size'  => 1,
                        'prev_text' => '&rarr; ' . esc_html__( 'Previous', 'travelera-lite' ),
                        'next_text' => esc_html__( 'Next', 'travelera-lite' ).' &larr;',
                    ) );
                } else {
                    echo paginate_links( array(
                        'mid_size'  => 1,
                        'prev_text' => '&larr; ' . esc_html__( 'Previous', 'travelera-lite' ),
                        'next_text' => esc_html__( 'Next', 'travelera-lite' ).' &rarr;',
                    ) );
                }
            ?>
        </nav>
        <?php
	else:
	?>
		<nav class="navigation pagination norm-pagination clearfix">
			<div class="nav-previous"><?php next_posts_link( esc_html__( '&larr; Older posts', 'travelera-lite' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'travelera-lite' ) ); ?></div>
		</nav>
	<?php
	endif;
}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Post Excerpt
/*-----------------------------------------------------------------------------------*/
// Limit the Length of Excerpt from Theme Options
function travelera_excerpt_length( $length ) {
	if ( travelera_theme_mod('excerpt_length') != '') {
		$travelera_excerpt_length = travelera_theme_mod('excerpt_length');
	} else {
		$travelera_excerpt_length = '40';
	}
	
	return $travelera_excerpt_length;
}
add_filter( 'excerpt_length', 'travelera_excerpt_length', 999 );

// Remove […] string
function travelera_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'travelera_excerpt_more');

// Add Shortcodes in Excerpt Field
add_filter( 'get_the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Exceprt Length
/*-----------------------------------------------------------------------------------*/
function travelera_excerpt_limit( $limit ) {
  $travelera_excerpt = explode(' ', get_the_excerpt(), $limit);
    
  if ( count( $travelera_excerpt )>=$limit ) {
    array_pop($travelera_excerpt);
    $travelera_excerpt = implode(" ",$travelera_excerpt).'...';
  } else {
    $travelera_excerpt = implode(" ",$travelera_excerpt);
  }
    
  $travelera_excerpt = preg_replace('`[[^]]*]`','',$travelera_excerpt);
    
  return $travelera_excerpt;
}
add_filter( 'get_the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Optional Excerpt
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'travelera_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own travelera_excerpt() function to override in a child theme.
	 *
	 * @since travelera 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function travelera_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;

/*-----------------------------------------------------------------------------------*/
/*	Sanitize Hex Color
/*-----------------------------------------------------------------------------------*/
function travelera_sanitize_hex_color( $color ) {
    if ( '' === $color )
        return '';
 
    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
    return $color;
}

/*-----------------------------------------------------------------------------------*/
/*	Jetpack Infinite Scroll Support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'infinite-scroll', array(
	'container'    => 'content',
	'render'       => 'travelera_infinite_scroll_render',
	'footer'       => 'footer'
) );

function travelera_infinite_scroll_render() {
    while ( have_posts() ) {
		the_post();
        get_template_part( 'template-parts/post-formats/content', get_post_format() );
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Social Links
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'travelera_social_links' ) ) :

function travelera_social_links( $social_links_pos ) {
    if ( $social_links_pos == 'header' ) { ?>
        <div class="social-links header-links"><?php
        $travelera_social_link_text_class = 'screen-reader-text';
    } else { ?>
        <div class="social-links footer-links"><?php
        $travelera_social_link_text_class = 'social-link-text';
    }

    $travelera_social_link_array = array(
        'facebook'  => array(
            'url'   => 'facebook_url',
            'class' => 'facebook',
            'title' => esc_html__('Facebook','travelera-lite'),
            'icon'  => 'fa fa-facebook'
        ),
        'twitter'  => array(
            'url'   => 'twitter_url',
            'class' => 'twitter',
            'title' => esc_html__('Twitter','travelera-lite'),
            'icon'  => 'fa fa-twitter'
        ),
        'gplus'  => array(
            'url'   => 'gplus_url',
            'class' => 'gplus',
            'title' => esc_html__('Google+','travelera-lite'),
            'icon'  => 'fa fa-google-plus'
        ),
        'pinterest'  => array(
            'url'   => 'pinterest_url',
            'class' => 'pinterest',
            'title' => esc_html__('Pinterest','travelera-lite'),
            'icon'  => 'fa fa-pinterest'
        ),
        'linkedin'  => array(
            'url'   => 'linkedin_url',
            'class' => 'linkedin',
            'title' => esc_html__('LinkedIn','travelera-lite'),
            'icon'  => 'fa fa-linkedin'
        ),
        'youtube'  => array(
            'url'   => 'youtube_url',
            'class' => 'twitter',
            'title' => esc_html__('YouTube','travelera-lite'),
            'icon'  => 'fa fa-youtube-play'
        ),
        'instagram'  => array(
            'url'   => 'instagram_url',
            'class' => 'instagram',
            'title' => esc_html__('Instagram','travelera-lite'),
            'icon'  => 'fa fa-instagram'
        ),
        'rss'  => array(
            'url'   => 'rss_url',
            'class' => 'rss',
            'title' => esc_html__('RSS','travelera-lite'),
            'icon'  => 'fa fa-rss'
        ),
        'reddit'  => array(
            'url'   => 'reddit_url',
            'class' => 'reddit',
            'title' => esc_html__('Reddit','travelera-lite'),
            'icon'  => 'fa fa-reddit'
        ),
        'tumblr'  => array(
            'url'   => 'tumblr_url',
            'class' => 'tumblr',
            'title' => esc_html__('Tumblr','travelera-lite'),
            'icon'  => 'fa fa-tumblr'
        ),
        'flickr'  => array(
            'url'   => 'flickr_url',
            'class' => 'flickr',
            'title' => esc_html__('Flickr','travelera-lite'),
            'icon'  => 'fa fa-flickr'
        ),
        'git'  => array(
            'url'   => 'git_url',
            'class' => 'git',
            'title' => esc_html__('GitHub','travelera-lite'),
            'icon'  => 'fa fa-github'
        ),
        'dribbble'  => array(
            'url'   => 'dribbble_url',
            'class' => 'dribbble',
            'title' => esc_html__('Dribbble','travelera-lite'),
            'icon'  => 'fa fa-dribbble'
        ),
        'behance'  => array(
            'url'   => 'behance_url',
            'class' => 'behance',
            'title' => esc_html__('Behance','travelera-lite'),
            'icon'  => 'fa fa-behance'
        ),
        'soundcloud'  => array(
            'url'   => 'soundcloud_url',
            'class' => 'soundcloud',
            'title' => esc_html__('Soundcloud','travelera-lite'),
            'icon'  => 'fa fa-soundcloud'
        ),
        'xing'  => array(
            'url'   => 'xing_url',
            'class' => 'xing',
            'title' => esc_html__('Xing','travelera-lite'),
            'icon'  => 'fa fa-xing'
        ),
        'vine'  => array(
            'url'   => 'vine_url',
            'class' => 'vine',
            'title' => esc_html__('Vine','travelera-lite'),
            'icon'  => 'fa fa-vine'
        ),
        'stumbleupon'  => array(
            'url'   => 'stumbleupon_url',
            'class' => 'stumbleupon',
            'title' => esc_html__('StumbleUpon','travelera-lite'),
            'icon'  => 'fa fa-stumbleupon'
        ),
    );

    foreach ( $travelera_social_link_array as $key => $data ) {
        if ( travelera_theme_mod( $data['url'] ) != '' ) { ?>
            <a class="<?php echo esc_attr( $data['class'] ); ?>" href="<?php echo esc_url( travelera_theme_mod( $data['url'] ) ); ?>" target="_blank">
                <span class="<?php echo esc_attr( $data['icon'] ); ?>" aria-hidden="true" ></span>
                <span class="<?php echo esc_attr( $travelera_social_link_text_class ); ?>"><?php esc_html( $data['title'] ); ?></span>
            </a>
        <?php }
    } ?>
    </div>
	<?php
}

endif;