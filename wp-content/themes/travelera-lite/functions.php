<?php
/**
 * Customizer Settings
 * -------------------------------------------------
 */
get_template_part('inc/customizer/customizer');

/**
 * Custom Template Functions
 * -------------------------------------------------
 * Inlcude some custom template functions for this theme
 */
require get_template_directory() . '/inc/template-functions.php';

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
/* UBlog supports.
/*-----------------------------------------------------------------------------------*/
function travelera_theme_setup() {
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// Register WordPress Custom Menus
	add_theme_support( 'menus' );
	register_nav_menu( 'main-menu', esc_html__( 'Main Menu', 'travelera-lite' ) );
	register_nav_menu( 'footer-menu', esc_html__( 'Footer Menu', 'travelera-lite' ) );
    
    /*
	 * Enable support for custom logo.
	 *
	 */
    add_theme_support( 'custom-logo', array(
       'height'      => 62,
       'width'       => 258,
       'flex-width'  => true,
    ) );
    
    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on travelera, use a find and replace
	 * to change 'travelera-lite' to the name of your theme in all the template files
	 */
    load_theme_textdomain( 'travelera-lite', get_template_directory() . '/languages' );
	
    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
    
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 200, true );
	add_image_size( 'travelera-slider', 1150, 490, true );
	add_image_size( 'travelera-featured', 770, 305, true );
	add_image_size( 'travelera-widgetthumb', 74, 74, true );
    
    // Set the default content width.
	$GLOBALS['content_width'] = 770;
    
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
    
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
	) );
    
    /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
    add_editor_style( array( 'assets/css/editor-style.css') );
}
add_action( 'after_setup_theme', 'travelera_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travelera_content_width() {

	$content_width = $GLOBALS['content_width'];
    
    $content_width = 770;

	/**
	 * Filter Travelera content width of the theme.
	 *
	 * @since Travelera 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'travelera_content_width', $content_width );
}
add_action( 'template_redirect', 'travelera_content_width', 0 );

/*-----------------------------------------------------------------------------------*/
/*	Add Stylesheets
/*-----------------------------------------------------------------------------------*/
function travelera_stylesheets() {
	wp_enqueue_style( 'travelera-style', get_stylesheet_uri() );
    
    $travelera_settings_css = travelera_customizer_apply_css();
    wp_add_inline_style('travelera-style', $travelera_settings_css);
	
	// Font-Awesome CSS
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), null );
	
    // Responsive
    wp_enqueue_style( 'travelera-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	
    // RTL
	if ( is_rtl() ) {
		wp_enqueue_style( 'travelera-rtl', get_template_directory_uri() . '/rtl.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'travelera_stylesheets' );

/*-----------------------------------------------------------------------------------*/
/*	Add JavaScripts
/*-----------------------------------------------------------------------------------*/
function travelera_scripts() {
    
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	// Owl Carousel
    if ( travelera_theme_mod('featured_slider') == '1' ) {
        wp_enqueue_script( 'jquery-imagesloaded' );
        wp_enqueue_script( 'jquery-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.2.1', true );
        wp_enqueue_script( 'travelera-jquery-sliders', get_template_directory_uri() . '/assets/js/sliders.js', array( 'jquery' ), '1.0', true );
    }
	
	// Required jQuery Scripts
    wp_enqueue_script( 'travelera-jquery-theme-scripts', get_template_directory_uri() . '/assets/js/theme-scripts.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'travelera_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Add Admin Scripts
/*-----------------------------------------------------------------------------------*/
function travelera_admin_scripts() {
    $current_screen = get_current_screen();

    if ( 'customize' != $current_screen->base ) {
        return;
    }
    
	wp_enqueue_style( 'travelera-admin-css', get_template_directory_uri() . '/assets/css/admin-styles.css' );
}
add_action( 'admin_enqueue_scripts', 'travelera_admin_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Register Theme Widgets
/*-----------------------------------------------------------------------------------*/
function travelera_widgets_init() {
	register_sidebar(array(
		'name'          => esc_html__( 'Primary Sidebar', 'travelera-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Main sidebar of the theme.', 'travelera-lite' ),
		'before_widget' => '<div class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
    register_sidebar( array(
        'name'          => esc_html__( 'Before Footer','travelera-lite' ),
        'id'            => 'before-footer-1',
        'description'   => esc_html__( 'This widget area appears on footer of theme.', 'travelera-lite' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title uppercase"><span>',
        'after_title'   => '</span></h3>'
    ) );
    $travelera_footer_columns = ( travelera_theme_mod('footer_layout') != '0' ? travelera_theme_mod('footer_layout') : '0' );
    for ( $i = 1; $i <= $travelera_footer_columns; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( esc_html__( 'Footer %s','travelera-lite' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => esc_html__( 'This widget area appears on footer of theme.', 'travelera-lite' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title uppercase"><span>',
            'after_title'   => '</span></h3>'
        ) );
    }
}
add_action( 'widgets_init', 'travelera_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*	Breadcrumb
/*-----------------------------------------------------------------------------------*/
function travelera_breadcrumb() {
	if ( !is_home() ) { ?>
		<span itemtype="http://schema.org/ListItem" itemscope="" itemprop="itemListElement" class="breadcrumb-item">
			<a itemprop="item" href="<?php echo esc_url( home_url('/') ); ?>">
	        	<span itemprop="name">
					<?php echo esc_html__( 'Home','travelera-lite' ); ?>
				</span>
			</a>
		</span>
		<?php if ( is_category() || is_single() ) { ?>
            <span class="breadcrumb-separator">
                <?php echo esc_html('/'); ?>
            </span>
            <span itemtype="http://schema.org/ListItem" itemscope="" itemprop="itemListElement" class="breadcrumb-item">
            	<span itemprop="item">
					<?php the_category(' &bull; '); ?>
            	</span>
            </span>
			<?php if ( is_single() ) { ?>
                <span class="breadcrumb-separator">
                    <?php echo esc_html('/'); ?>
                </span>
                <span itemtype="http://schema.org/ListItem" itemscope="" itemprop="itemListElement" class="breadcrumb-item">
                	<span itemprop="item">
						<?php the_title(); ?>
                	</span>
                </span>
			<?php } ?>
		<?php } elseif ( is_page() ) { ?>
            <span class="breadcrumb-separator">
                <?php echo esc_html('/'); ?>
            </span>
			<?php the_title(); ?>
		<?php }
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Comments Callback
/*-----------------------------------------------------------------------------------*/
function travelera_comment($comment, $args, $depth) {
	extract($args, EXTR_SKIP);
?>
	<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body entry-content" itemscope itemtype="http://schema.org/UserComments">
        <?php endif; ?>
        <div class="comment-author vcard">
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment->comment_author_email, 60 ); ?>
            <?php printf(__('<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person"><span itemprop="name">%s</span></span>','travelera-lite'), get_comment_author_link()) ?>

            <div class="comment-meta uppercase commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                <time itemprop="commentTime" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>">
                    <?php
                        printf( esc_html__('%1$s at %2$s','travelera-lite'), get_comment_date(),  get_comment_time())
                    ?>
                </time>
                </a>
                <?php edit_comment_link(esc_html__('(Edit)','travelera-lite'),'  ','' ); ?>
            </div>
        </div>
        <div class="comment-summary">
            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.','travelera-lite') ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-text" itemprop="commentText">
                <?php comment_text() ?>
            </div>

            <div class="reply uppercase">
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => esc_html__('Reply','travelera-lite')))) ?>
            </div>
        </div>
	</div>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Custom wp_link_pages
/*-----------------------------------------------------------------------------------*/
function travelera_wp_link_pages( $args = '' ) {
	$defaults = array(
		'before'           => '<div class="pagination" id="post-pagination"><p class="page-links-title">' . esc_html__( 'Pages:', 'travelera-lite' ) . '</p>',
		'after'            => '</div>',
		'text_before'      => '',
		'text_after'       => '',
		'next_or_number'   => 'number', 
		'nextpagelink'     => esc_html__( 'Next page', 'travelera-lite' ),
		'previouspagelink' => esc_html__( 'Previous page', 'travelera-lite' ),
		'pagelink'         => '%',
		'echo'             => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	if ( $multipage ) {
		if ( 'number' == $next_or_number ) {
			$output .= $before;
			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
				$j = str_replace( '%', $i, $pagelink );
				$output .= ' ';
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= _wp_link_page( $i );
				else
					$output .= '<span class="current-post-page">';

				$output .= $text_before . $j . $text_after;
				if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
					$output .= '</a>';
				else
					$output .= '</span>';
			}
			$output .= $after;
		} else {
			if ( $more ) {
				$output .= $before;
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $previouspagelink . $text_after . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= _wp_link_page( $i );
					$output .= $text_before . $nextpagelink . $text_after . '</a>';
				}
				$output .= $after;
			}
		}
	}

	if ( $echo )
		echo $output;

	return $output;
}

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function travelera_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'travelera_widget_tag_cloud_args' );

/*-----------------------------------------------------------------------------------*/
/*	Custom theme mod functions
/*-----------------------------------------------------------------------------------*/
function travelera_theme_mod( $name ) {
    global $travelera_theme_defaults;

    return get_theme_mod( $name, $travelera_theme_defaults[ $name ] );
}
?>