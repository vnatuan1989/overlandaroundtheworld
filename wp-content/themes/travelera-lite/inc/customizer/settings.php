<?php
/**
 * Customizer settings.
 *
 * @since Travelera 1.0
 *
 */
function travelera_customizer_settings( $fields ) {
    global $fonts_list;
    global $travelera_theme_defaults;
    
    $travelera_theme_defaults = array(
        
        /*---[ Default Styling Options ]---*/
        
		'color_scheme_1'              => '#f26a44',
		'color_scheme_2'              => '#1e88e5',
		'header_background_color'     => '#222',
		'logo_color'                  => '#fff',
        
        
        /*---[ Default Typography Options ]---*/
        
        // Body Default Typography Options
		'body_font_family'            => 'Muli',
        
        // Logo Default Typography Options',
		'logo_font_family'            => 'Sue Ellen Francisco',
		'logo_font_weight'            => '400',
		'logo_text_transform'         => 'none',
		'logo_font_size'              => '40px',
        
        // Navigation Menu Default Typography Options',
		'menu_font_size'              => '13px',
        
        // Headings Default Typography Options',
		'headings_font_family'        => 'Open Sans',
		'headings_font_weight'        => '400',
        
        // Entry Title Default Typography Options
		'entry_title_font_size'       => '26px',
        
        // Single Title Default Typography Options
		'single_title_font_size'      => '26px',
        
        // Post Meta Default Typography Options
		'post_meta_font_size'         => '12px',
        
        // Post Content Default Typography Options
		'post_content_font_size'      => '14px',
        
        // Widget Title Default Typography Options',
		'widgets_title_font_size'     => '12px',
        
        
        /*---[ Layout Default Options ]---*/
        
        'main_layout'                 => 'cb-rs',
        'archive_layout'              => 'cb-rs',
        'single_layout'               => 'cb-rs',
        'footer_layout'               => '0',
        
        /*---[ Other Default Options ]---*/
        
		'pagination_type'             => 'nextprev',
		'scroll_top'                  => 'show',
		'copyright_text'              => 'Theme by <a href="https://www.bloompixel.com/">Bloompixel</a>. Proudly Powered by WordPress',
		'post_avtar'                  => 1,
		'post_author'                 => 1,
		'post_date'                   => 1,
		'post_comments'               => 1,
		'post_cats'                   => 1,
		'post_views'                  => 0,
		'post_tags'                   => 0,
		'breadcrumbs'                 => 1,
		'author_box'                  => 1,
		'next_prev_links'             => 1,
        
        // Related Posts
		'related_posts'               => 1,
		'related_posts_by'            => 'categories',
		'related_posts_count'         => 3,
        
        // Home Content
		'home_content'                => 'excerpt',
		'excerpt_length'              => '40',
        
        // Featured Slider
		'featured_slider'             => 0,
		'f_slider_posts_count'        => 4,
		'featured_slider_cat'         => 'uncategorized',
        
        // Header Settings
		'header_style'                => '1',
		'tagline'                     => 'hide',
		'header_search'               => 'disable',
		'header_social_links'         => 'disable',
        
        // Footer Settings
		'footer_social_links'         => 'disable',
        
        // Social Links
		'facebook_url'                => '#',
		'twitter_url'                 => '#',
		'gplus_url'                   => '#',
		'instagram_url'               => '',
		'youtube_url'                 => '',
		'pinterest_url'               => '',
		'linkedin_url'                => '',
		'flickr_url'                  => '',
		'git_url'                     => '',
		'dribbble_url'                => '',
		'behance_url'                 => '',
		'soundcloud_url'              => '',
		'xing_url'                    => '',
		'vine_url'                    => '',
		'stumbleupon_url'             => '',
		'rss_url'                     => '',
		'reddit_url'                  => '',
		'tumblr_url'                  => '',
	);
    
    // Settings -> General Settings -> Main Settings
    //------------------------------------------------//
    
    /*---[ Pagination Type ]---*/
    $fields[] = array(
		'id'                => 'pagination_type', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['pagination_type'],
		'label'             => __('Pagination Type', 'travelera-lite'),
		'section'           => 'general_settings',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'num'      => __('Numbered', 'travelera-lite'),
            'nextprev' => __('Next/Prev', 'travelera-lite'),
        ),
	);
    /*---[ Scroll to Top Button ]---*/
    $fields[] = array(
		'id'                => 'scroll_top', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['scroll_top'],
		'label'             => __('Scroll to Top Button', 'travelera-lite'),
		'section'           => 'general_settings',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'  => array(
            'show' => __('Show', 'travelera-lite'),
            'hide' => __('hide', 'travelera-lite'),
        ),
	);
    
    // Settings -> General Settings -> Post Options
    //------------------------------------------------//
    
    /*---[ Post Date ]---*/
    $fields[] = array(
		'id'                => 'post_date', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['post_date'],
		'label'             => __('Show Post Date', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Post Categories ]---*/
    $fields[] = array(
		'id'                => 'post_cats', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['post_cats'],
		'label'             => __('Show Post Categories', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Post Avtar ]---*/
    $fields[] = array(
		'id'                => 'post_avtar', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['post_avtar'],
		'label'             => __('Show Post Avtar', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Post Author ]---*/
    $fields[] = array(
		'id'                => 'post_author', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['post_author'],
		'label'             => __('Show Post Author', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Post Comments ]---*/
    $fields[] = array(
		'id'                => 'post_comments', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['post_comments'],
		'label'             => __('Show Post Comments', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Post Tags ]---*/
    $fields[] = array(
		'id'                => 'post_tags', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['post_tags'],
		'label'             => __('Show Post Tags', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Breadcrumbs ]---*/
    $fields[] = array(
		'id'                => 'breadcrumbs', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['breadcrumbs'],
		'label'             => __('Show Breadcrumbs', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Author Info Box ]---*/
    $fields[] = array(
		'id'                => 'author_box', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['author_box'],
		'label'             => __('Author Info Box', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Next/Prev Article Links ]---*/
    $fields[] = array(
		'id'                => 'next_prev_links', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['next_prev_links'],
		'label'             => __('Next/Prev Article Links', 'travelera-lite'),
		'section'           => 'post_meta_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Related Posts ]---*/
    $fields[] = array(
		'id'                => 'related_posts', 
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['related_posts'],
		'label'             => __('Show Related Posts', 'travelera-lite'),
		'section'           => 'related_posts_options',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    /*---[ Related Posts By ]---*/
    $fields[] = array(
		'id'                => 'related_posts_by', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['related_posts_by'],
		'label'             => __('Related Posts By', 'travelera-lite'),
		'section'           => 'related_posts_options',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'categories' => __('Categories', 'travelera-lite'),
            'tags'       => __('Tags', 'travelera-lite')
        ),
	);
    /*---[ Related Posts Count ]---*/
    $fields[] = array(
		'id'          => 'related_posts_count', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['related_posts_count'],
		'label'       => __('Related Posts Count', 'travelera-lite'),
		'section'     => 'related_posts_options',
	);
    
    // Settings -> General Settings -> Header
    //------------------------------------------------//
    
    /*---[ Header Style ]---*/
    $fields[] = array(
		'id'                => 'header_style', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['header_style'],
		'label'             => __('Header Style', 'travelera-lite'),
		'section'           => 'header_options',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'   => array(
            '1' => __('Style 1', 'travelera-lite'),
            '2' => __('Style 2', 'travelera-lite'),
            '3' => __('Style 3', 'travelera-lite'),
        ),
	);
    /*---[ Tagline ]---*/
    $fields[] = array(
		'id'                => 'tagline',
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['tagline'],
		'label'             => __('Tagline', 'travelera-lite'),
		'section'           => 'header_options',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'   => array(
            'show' => __('Show', 'travelera-lite'),
            'hide' => __('Hide', 'travelera-lite'),
        ),
	);
    /*---[ Sticky Menu ]---*/
    $fields[] = array(
		'id'                => 'header_search', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['header_search'],
		'label'             => __('Search Bar', 'travelera-lite'),
		'section'           => 'header_options',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'     => array(
            'enable'  =>__('Enable', 'travelera-lite'),
            'disable' => __('Disable', 'travelera-lite'),
        ),
	);
    /*---[ Social Links ]---*/
    $fields[] = array(
		'id'                => 'header_social_links', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['header_social_links'],
		'label'             => __('Social Links', 'travelera-lite'),
		'section'           => 'header_options',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'enable'  => __('Enable', 'travelera-lite'),
            'disable' => __('Disable', 'travelera-lite'),
        ),
	);
    
    // Settings -> General Settings -> Footer
    //------------------------------------------------//
    /*---[ Social Links ]---*/
    $fields[] = array(
		'id'                => 'footer_social_links', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['footer_social_links'],
		'label'             => __('Social Links', 'travelera-lite'),
		'section'           => 'footer_options',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'enable'  => __('Enable', 'travelera-lite'),
            'disable' => __('Disable', 'travelera-lite'),
        ),
	);
    /*---[ Copyright Text ]---*/
    $fields[] = array(
		'id'          => 'copyright_text', 
		'control'     => 'textarea',
        'default'     => $travelera_theme_defaults['copyright_text'],
		'label'       => __('Copyright', 'travelera-lite'),
        'description' => __('Change or remove copyright text for footer', 'travelera-lite'),
		'section'     => 'footer_options',
		'transport'   => 'postMessage',
	);
    
    // Settings -> Styling Options
    //------------------------------------------------//
    /*---[ Primary Color Scheme ]---*/
    $fields[] = array(
		'id'        => 'color_scheme_1', 
		'control'   => 'color',
		'default'   => $travelera_theme_defaults['color_scheme_1'],
		'label'     => __('Primary Color Scheme', 'travelera-lite'),
		'section'   => 'colors',
        'transport' => 'postMessage',
        'output'    => array (
            'color'        => 'a, a:hover, .title a:hover, .sidebar a:hover, .category-title span, .meta a:hover, .post-meta a:hover, .edit-post a, .read-more a:hover, .more-link:hover, .error-text, .primary-color, .post-comments .fa, .post-content ul li:before, .content-page ul li:before, blockquote:before, blockquote:after, .widget li:before',
            'background'   => '.search-button, .tagcloud a:hover, .post-meta .post-comments a:hover, .pagination .current, .pagination .current-post-page, .pagination a:hover, input[type="submit"], #wp-calendar caption, #wp-calendar td#today, .comment-form .submit, .wpcf7-submit, .archive-articles-count, .post-tags a:hover, .widget-title:before, .section-heading:before, .tabs li.active:before, .recent-posts li .thumbnail-big:before, .owl-controls .owl-dot.active span, .owl-controls .owl-dot:hover span, .jetpack_subscription_widget input[type=submit], .thumbnail-big:before,  .comment-reply-link:hover, .sb form input[type="submit"]',
            'border-color' => '.tagcloud a:hover .post blockquote, .pagination .current, .pagination .current-post-page, .pagination a:hover, .comment-reply-link:hover',
            'border-top-color' => '.post-meta .post-comments a:hover:before',
		),
	);
    /*---[ Secondary Color Scheme ]---*/
    $fields[] = array(
		'id'        => 'color_scheme_2', 
		'control'   => 'color',
		'default'   => $travelera_theme_defaults['color_scheme_2'],
		'label'     => __('Secondary Color Scheme', 'travelera-lite'),
		'section'   => 'colors',
        'transport' => 'postMessage',
        'output'    => array (
            'background'   => '.post-cats a, .featuredslider .read-more, .featured-cats:before, .total-post, .articles-count, .comment-form .submit, .post-meta:before',
		),
	);
    /*---[ Header Color Options ]---*/
    $fields[] = array(
		'id'        => 'header_background_color', 
		'control'   => 'color',
		'default'   => $travelera_theme_defaults['header_background_color'],
		'label'     => __('Header Background Color', 'travelera-lite'),
		'section'   => 'colors',
        'transport' => 'postMessage',
        'output'    => array (
            'background' => '.main-header',
		),
	);
    $fields[] = array(
		'id'        => 'logo_color', 
		'control'   => 'color',
		'default'   => $travelera_theme_defaults['logo_color'],
		'label'     => __('Logo Color', 'travelera-lite'),
		'section'   => 'colors',
        'transport' => 'postMessage',
        'output'    => array (
            'color' => '.logo a',
		),
	);
    
    // Settings -> Typography
    //--------------------------------------------//
    /*---[ Body Font Properties ]---*/
    $fields[] = array(
		'id'      => 'body_font_family',
		'key'     => 'fonts_family',
		'control' => 'select',
		'default' => $travelera_theme_defaults['body_font_family'],
		'label'   => __('Font Family', 'travelera-lite'),
		'section' => 'body_font',
        'choices' => $fonts_list,
        'output'  => array (
            'font-family' => 'body',
		),
	);
    /*---[ Logo Font Properties ]---*/
    $fields[] = array(
		'id'      => 'logo_font_family',
		'key'     => 'fonts_family',
		'control' => 'select',
		'default' => $travelera_theme_defaults['logo_font_family'],
		'label'   => __('Font Family', 'travelera-lite'),
		'section' => 'logo_font',
        'choices' => $fonts_list,
        'output'  => array (
            'font-family' => '.logo',
		),
	);
    $fields[] = array(
		'id'        => 'logo_font_weight',
		'control'   => 'select',
		'default'   => $travelera_theme_defaults['logo_font_weight'],
		'label'     => __('Font Weight', 'travelera-lite'),
		'section'   => 'logo_font',
        'transport' => 'postMessage',
        'choices'   =>   array(
            '300' => __('Light: 300', 'travelera-lite'),
            '400' => __('Normal: 400', 'travelera-lite'),
            '500' => __('Medium: 500', 'travelera-lite'),
            '600' => __('Semi-Bold: 600', 'travelera-lite'),
            '700' => __('Bold: 700', 'travelera-lite'),
            '800' => __('Extra-Bold: 800', 'travelera-lite'),
        ),
        'output'  => array (
            'font-weight' => '.logo',
		),
	);
    $fields[] = array(
		'id'        => 'logo_text_transform',
		'control'   => 'select',
		'default'   => $travelera_theme_defaults['logo_text_transform'],
		'label'     => __('Text Transform', 'travelera-lite'),
		'section'   => 'logo_font',
        'transport' => 'postMessage',
        'choices'   =>   array(
            'none'       => __('None', 'travelera-lite'),
            'uppercase'  => __('Uppercase', 'travelera-lite'),
            'lowercase'  => __('Lowercase', 'travelera-lite'),
            'capitalize' => __('Capitalize', 'travelera-lite'),
        ),
        'output'  => array (
            'text-transform' => '.logo',
		),
	);
    $fields[] = array(
		'id'          => 'logo_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['logo_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
        'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'logo_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.logo',
		),
	);
    
    /*---[ Navigation Menu Font Properties ]---*/
    $fields[] = array(
		'id'          => 'menu_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['menu_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
		'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'nav_menu_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.nav-menu',
		),
	);
    
    /*---[ Headings Font Properties ]---*/
    $fields[] = array(
		'id'      => 'headings_font_family',
		'key'     => 'fonts_family',
		'control' => 'select',
		'default' => $travelera_theme_defaults['headings_font_family'],
		'label'   => __('Font Family', 'travelera-lite'),
		'section' => 'headings_font',
        'choices' => $fonts_list,
        'output'  => array (
            'font-family' => 'h1,h2,h3,h4,h5,h6,.post-nav-link',
		),
	);
    $fields[] = array(
		'id'        => 'headings_font_weight',
		'control'   => 'select',
		'default'   => $travelera_theme_defaults['headings_font_weight'],
		'label'     => __('Font Weight', 'travelera-lite'),
		'section'   => 'headings_font',
        'transport' => 'postMessage',
        'choices'   =>   array(
            '300' => __('Light: 300', 'travelera-lite'),
            '400' => __('Normal: 400', 'travelera-lite'),
            '500' => __('Medium: 500', 'travelera-lite'),
            '600' => __('Semi-Bold: 600', 'travelera-lite'),
            '700' => __('Bold: 700', 'travelera-lite'),
            '800' => __('Extra-Bold: 800', 'travelera-lite'),
        ),
        'output'    => array (
            'font-weight' => 'h1,h2,h3,h4,h5,h6,.post-nav-link',
		),
	);
    
    /*---[ Post: Entry Title Font Properties ]---*/
    $fields[] = array(
		'id'          => 'entry_title_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['entry_title_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
		'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'entry_title_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.entry-title',
		),
	);
    
    /*---[ Post: Meta Font Properties ]---*/
    $fields[] = array(
		'id'          => 'post_meta_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['post_meta_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
		'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'post_meta_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.post-meta',
		),
	);
    
    /*---[ Post: Single Title Font Properties ]---*/
    $fields[] = array(
		'id'          => 'single_title_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['single_title_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
		'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'single_title_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.single .entry-title',
		),
	);
    
    /*---[ Post: Content Font Properties ]---*/
    $fields[] = array(
		'id'          => 'post_content_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['post_content_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
		'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'post_content_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.post-content',
		),
	);
    
    /*---[ Widgets Title Font Properties ]---*/
    $fields[] = array(
		'id'          => 'widgets_title_font_size', 
		'control'     => 'text',
		'default'     => $travelera_theme_defaults['widgets_title_font_size'],
		'label'       => __('Font Size', 'travelera-lite'),
		'description' => __('Value in pixels', 'travelera-lite'),
		'section'     => 'widgets_title_font',
        'transport'   => 'postMessage',
        'output'      => array (
            'font-size' => '.widget-title, .tabs li a, .section-heading, .post-nav-title',
		),
	);
    
    // Settings -> Layout Options
    //--------------------------------------------//
    $fields[] = array(
		'id'                => 'main_layout', 
		'control'           => 'layout',
		'default'           => $travelera_theme_defaults['main_layout'],
		'label'             => __('Main Layout', 'travelera-lite'),
		'section'           => 'main_layout_section',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'cb-rs'     => __('2 Col Right Sidebar', 'travelera-lite'),
            'cb-ls'     => __('2 Col Left Sidebar', 'travelera-lite'),
            'cb'        => __('No Sidebar', 'travelera-lite'),
        )
	);
    $fields[] = array(
		'id'                => 'archive_layout', 
		'control'           => 'layout',
		'default'           => $travelera_theme_defaults['archive_layout'],
		'label'             => __('Archive Layout', 'travelera-lite'),
		'section'           => 'archive_layout_section',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'cb-rs'     => __('2 Col Right Sidebar', 'travelera-lite'),
            'cb-ls'     => __('2 Col Left Sidebar', 'travelera-lite'),
            'cb'        => __('No Sidebar', 'travelera-lite'),
        )
	);
    $fields[] = array(
		'id'                => 'single_layout', 
		'control'           => 'layout',
		'default'           => $travelera_theme_defaults['single_layout'],
		'label'             => __('Single Layout', 'travelera-lite'),
		'section'           => 'single_layout_section',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'cb-rs'     => __('2 Col Right Sidebar', 'travelera-lite'),
            'cb-ls'     => __('2 Col Left Sidebar', 'travelera-lite'),
            'cb'        => __('No Sidebar', 'travelera-lite'),
        )
	);
    $fields[] = array(
		'id'                => 'footer_layout', 
		'control'           => 'layout',
		'default'           => $travelera_theme_defaults['footer_layout'],
		'title'             => __('Footer Widgets', 'travelera-lite'),
        'description'       => __('Chose number of footer widgets for theme', 'travelera-lite'),
		'section'           => 'footer_columns_section',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            '0' => __('Disable Footer Widgets', 'travelera-lite'),
            '1' => __('Footer 1 Col', 'travelera-lite'),
            '2' => __('Footer 2 Col', 'travelera-lite'),
            '3' => __('Footer 3 Col', 'travelera-lite'),
            '4' => __('Footer 4 Col', 'travelera-lite'),
        )
	);
    
    // Settings -> Home Content
    //--------------------------------------------//
    $fields[] = array(
		'id'                => 'home_content', 
		'control'           => 'radio',
		'default'           => $travelera_theme_defaults['home_content'],
		'label'             => __('Home Content', 'travelera-lite'),
		'section'           => 'home_content_section',
        'sanitize_callback' => 'travelera_sanitize_choices',
        'choices'           => array(
            'excerpt'       => __('Excerpt', 'travelera-lite'),
            'full_content'  => __('Full Content', 'travelera-lite'),
        ),
	);
    $fields[] = array(
		'id'                => 'excerpt_length', 
		'control'           => 'text',
        'default'           => $travelera_theme_defaults['excerpt_length'],
		'label'             => __('Excerpt Length', 'travelera-lite'),
        'description'       => __('Enter excerpt length here', 'travelera-lite'),
		'section'           => 'home_content_section',
        'sanitize_callback' => 'travelera_sanitize_text'
	);
    $fields[] = array(
		'id'                => 'featured_slider',
		'control'           => 'checkbox',
		'default'           => $travelera_theme_defaults['featured_slider'],
		'label'             => __('Show Featured Slider', 'travelera-lite'),
		'section'           => 'slider_section',
        'sanitize_callback' => 'travelera_sanitize_checkbox',
	);
    $fields[] = array(
		'id'          => 'f_slider_posts_count', 
		'control'     => 'text',
		'label'       => __('Slider Posts Count', 'travelera-lite'),
		'default'     => $travelera_theme_defaults['f_slider_posts_count'],
		'label'       => __('Featured Posts Count', 'travelera-lite'),
        'description' => __('Chose number of posts to show in slider', 'travelera-lite'),
		'section'     => 'slider_section',
        'sanitize_callback' => 'travelera_sanitize_text'
	);
    $fields[] = array(
		'id'                => 'featured_slider_cat',
		'control'           => 'select',
        'default'           => $travelera_theme_defaults['featured_slider_cat'],
		'label'             => __('Slider Posts Category', 'travelera-lite'),
		'section'           => 'slider_section',
        'sanitize_callback' => 'travelera_sanitize_cat',
        'choices'           => travelera_get_categories_select()
	);
    
    // Settings -> Social Profiles
    //--------------------------------------------//
    
    /*---[ Facebook ]---*/
    $fields[] = array(
		'id'                => 'facebook_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['facebook_url'],
		'label'             => __('Facebook', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Twitter ]---*/
    $fields[] = array(
		'id'                => 'twitter_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['twitter_url'],
		'label'             => __('Twitter', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Google+ ]---*/
    $fields[] = array(
		'id'                => 'gplus_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['gplus_url'],
		'label'             => __('Google+', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Instagram ]---*/
    $fields[] = array(
		'id'                => 'instagram_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['instagram_url'],
		'label'             => __('Instagram', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ YouTube ]---*/
    $fields[] = array(
		'id'                => 'youtube_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['youtube_url'],
		'label'             => __('YouTube', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Pinterest ]---*/
    $fields[] = array(
		'id'                => 'pinterest_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['pinterest_url'],
		'label'             => __('Pinterest', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Flickr ]---*/
    $fields[] = array(
		'id'                => 'flickr_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['flickr_url'],
		'label'             => __('Flickr', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ RSS ]---*/
    $fields[] = array(
		'id'                => 'rss_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['rss_url'],
		'label'             => __('RSS', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ LinkedIn ]---*/
    $fields[] = array(
		'id'                => 'linkedin_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['linkedin_url'],
		'label'             => __('LinkedIn', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Github ]---*/
    $fields[] = array(
		'id'                => 'git_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['git_url'],
		'label'             => __('Github', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Dribbble ]---*/
    $fields[] = array(
		'id'                => 'dribbble_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['dribbble_url'],
		'label'             => __('Dribbble', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Behance ]---*/
    $fields[] = array(
		'id'                => 'behance_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['behance_url'],
		'label'             => __('Behance', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ SoundCloud ]---*/
    $fields[] = array(
		'id'                => 'soundcloud_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['soundcloud_url'],
		'label'             => __('SoundCloud', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Xing ]---*/
    $fields[] = array(
		'id'                => 'xing_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['xing_url'],
		'label'             => __('Xing', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Vine ]---*/
    $fields[] = array(
		'id'                => 'vine_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['vine_url'],
		'label'             => __('Vine', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ StumbleUpon ]---*/
    $fields[] = array(
		'id'                => 'stumbleupon_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['stumbleupon_url'],
		'label'             => __('StumbleUpon', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Reddit ]---*/
    $fields[] = array(
		'id'                => 'reddit_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['reddit_url'],
		'label'             => __('Reddit', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
        
    /*---[ Tumblr ]---*/
    $fields[] = array(
		'id'                => 'tumblr_url', 
		'control'           => 'text',
		'default'           => $travelera_theme_defaults['tumblr_url'],
		'label'             => __('Tumblr', 'travelera-lite'),
        'sanitize_callback' => 'esc_url_raw',
		'section'           => 'social_profiles',
	);
    
    return $fields;
}

/**
 * Add filters for customizer.
 *
 */
add_filter( 'travelera_customizer_settings_register', 'travelera_customizer_settings' );
add_filter( 'travelera_customizer_apply_css', 'travelera_customizer_settings' );
add_filter( 'travelera_customizer_google_fonts', 'travelera_customizer_settings' );
?>