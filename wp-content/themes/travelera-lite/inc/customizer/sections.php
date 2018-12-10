<?php
function travelera_register_theme_customizer_sections( $wp_customize ) {
    
    // Customizer Sections
    //--------------------------------------------//

    /*---[ General Settings -> Main Settings ]---*/
    $wp_customize->add_section( 'general_settings', array(
        'title'         => __('General Settings', 'travelera-lite'),
        'description'   => __('General settings of the theme', 'travelera-lite'),
        'priority'      => 85,
    ) );

    /*---[ General Settings -> Header ]---*/
    $wp_customize->add_section( 'header_options', array(
        'title'         => __('Header', 'travelera-lite'),
        'description'   => __('Change settings of header of the theme', 'travelera-lite'),
        'priority'      => 98,
    ) );

    /*---[ General Settings -> Footer ]---*/
    $wp_customize->add_section( 'footer_options', array(
        'title'         => __('Footer', 'travelera-lite'),
        'description'   => __('Change settings of Footer of the theme', 'travelera-lite'),
        'priority'      => 99,
    ) );

    /*---[ Post Options -> Post Meta ]---*/
    $wp_customize->add_section( 'post_meta_options', array(
        'title'         => __('Post Meta', 'travelera-lite'),
        'description'   => __('Change settings related to post meta', 'travelera-lite'),
        'priority'      => 90,
        'panel'         => 'post_options',
    ) );

    /*---[ Post Options -> Related Posts ]---*/
    $wp_customize->add_section( 'related_posts_options', array(
        'title'         => __('Related Posts', 'travelera-lite'),
        'description'   => __('Show or hide related posts from here', 'travelera-lite'),
        'priority'      => 90,
        'panel'         => 'post_options',
    ) );

    /*---[ Typography Options -> Body Font ]---*/
    $wp_customize->add_section( 'body_font', array(
        'title'         => __('Body', 'travelera-lite'),
        'description'   => __('Change font properties of body of theme', 'travelera-lite'),
        'priority'      => 8,
        'panel'         => 'font_options',
    ) );

    /*---[ Typography Options -> Logo Font ]---*/
    $wp_customize->add_section( 'logo_font', array(
        'title'         => __('Logo', 'travelera-lite'),
        'description'   => __('Change font properties of logo', 'travelera-lite'),
        'priority'      => 10,
        'panel'         => 'font_options',
    ) );

    /*---[ Typography Options -> Navigation Menu Font ]---*/
    $wp_customize->add_section( 'nav_menu_font', array(
        'title'         => __('Navigation Menu', 'travelera-lite'),
        'description'   => __('Change font properties of navigation menu', 'travelera-lite'),
        'priority'      => 12,
        'panel'         => 'font_options',
    ) );

    /*---[ Typography Options -> Headings Font ]---*/
    $wp_customize->add_section( 'headings_font', array(
        'title'         => __('Headings', 'travelera-lite'),
        'description'   => __('Change font properties of headings. These settings applies to headings in posts and also to post titles of widgets and related posts', 'travelera-lite'),
        'priority'      => 14,
        'panel'         => 'font_options',
    ) );

    /*---[  Typography Options -> Post: Entry Title Font  ]---*/
    $wp_customize->add_section( 'entry_title_font', array(
        'title'         => __(' Post: Entry Title', 'travelera-lite'),
        'description'   => __('Change font properties of entry title', 'travelera-lite'),
        'priority'      => 16,
        'panel'         => 'font_options',
    ) );

    /*---[  Typography Options -> Post: Single Title Font  ]---*/
    $wp_customize->add_section( 'single_title_font', array(
        'title'         => __(' Post: Single Title', 'travelera-lite'),
        'description'   => __('Change font properties of single post title', 'travelera-lite'),
        'priority'      => 18,
        'panel'         => 'font_options',
    ) );

    /*---[  Typography Options -> Post: Single Title Font  ]---*/
    $wp_customize->add_section( 'post_meta_font', array(
        'title'         => __(' Post: Meta', 'travelera-lite'),
        'description'   => __('Change font properties of post meta', 'travelera-lite'),
        'priority'      => 18,
        'panel'         => 'font_options',
    ) );

    /*---[  Typography Options -> Post: Content Font  ]---*/
    $wp_customize->add_section( 'post_content_font', array(
        'title'         => __(' Post: Content', 'travelera-lite'),
        'description'   => __('Change font properties of post content', 'travelera-lite'),
        'priority'      => 20,
        'panel'         => 'font_options',
    ) );

    /*---[  Typography Options -> Widgets Title Font  ]---*/
    $wp_customize->add_section( 'widgets_title_font', array(
        'title'         => __(' Widgets Title', 'travelera-lite'),
        'description'   => __('Change font properties of widget title', 'travelera-lite'),
        'priority'      => 22,
        'panel'         => 'font_options',
    ) );


    /*---[ Layout Options -> Main Layout ]---*/
    $wp_customize->add_section( 'main_layout_section', array(
        'title'         => __('Main Layout', 'travelera-lite'),
        'description'   => __('Change layout of blog page of theme', 'travelera-lite'),
        'priority'      => 10,
        'panel'         => 'layout_options',
    ) );
    /*---[ Layout Options -> Archive Layout ]---*/
    $wp_customize->add_section( 'archive_layout_section', array(
        'title'         => __('Archive Layout', 'travelera-lite'),
        'description'   => __('Change layout of archive pages of theme', 'travelera-lite'),
        'priority'      => 12,
        'panel'         => 'layout_options',
    ) );

    /*---[ Layout Options -> Archive Layout ]---*/
    $wp_customize->add_section( 'single_layout_section', array(
        'title'         => __('Single Layout', 'travelera-lite'),
        'description'   => __('Change layout of single posts and pages of theme', 'travelera-lite'),
        'priority'      => 14,
        'panel'         => 'layout_options',
    ) );

    /*---[ Layout Options -> Footer Columns ]---*/
    $wp_customize->add_section( 'footer_columns_section', array(
        'title'         => __('Footer Columns', 'travelera-lite'),
        'description'   => __('Chose number of footer columns for theme', 'travelera-lite'),
        'priority'      => 16,
        'panel'         => 'layout_options',
    ) );

    /*---[ Homepage -> Home Content ]---*/
    $wp_customize->add_section( 'home_content_section', array(
        'title'         => __('Home Content', 'travelera-lite'),
        'description'   => __('Change settings for homepage content', 'travelera-lite'),
        'priority'      => 18,
        'panel'         => 'homepage_options',
    ) );

    /*---[ Homepage -> Slider ]---*/
    $wp_customize->add_section( 'slider_section', array(
        'title'         => __('Featured Slider', 'travelera-lite'),
        'description'   => __('Change settings for featured slider', 'travelera-lite'),
        'priority'      => 20,
        'panel'         => 'homepage_options',
    ) );

    /*---[ Social Profiles ]---*/
    $wp_customize->add_section( 'social_profiles', array(
        'title'         => __('Social Profiles', 'travelera-lite'),
        'description'   => __('Here you can add links to your social profiles', 'travelera-lite'),
        'priority'      => 110,
    ) );

    /*---[ Instagram Photos ]---*/
    $wp_customize->add_section( 'instagram_settings', array(
        'title'         => __('Instagram', 'travelera-lite'),
        'description'   => __('Here you can configure your instagram account', 'travelera-lite'),
        'priority'      => 115,
    ) );
    
}
add_action( 'customize_register', 'travelera_register_theme_customizer_sections' );
?>