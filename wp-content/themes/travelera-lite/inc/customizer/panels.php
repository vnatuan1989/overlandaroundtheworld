<?php
function travelera_register_theme_customizer_panels( $wp_customize ) {
    
    // Customizer Panels
    //--------------------------------------------//
    
    /*---[ Typography Options ]---*/
    $wp_customize->add_panel( 'font_options', array(
        'priority'       => 96,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Typography Options', 'travelera-lite'),
        'description'    => __('Here you can change font type, font size and other settings relaetd to typography', 'travelera-lite'),
    ) );
    
    /*---[ Post Options ]---*/
    $wp_customize->add_panel( 'post_options', array(
        'priority'       => 97,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Post Options', 'travelera-lite'),
        'description'    => __('Here you can change settings relaetd to posts', 'travelera-lite'),
    ) );
    
    /*---[ Layout Options ]---*/
    $wp_customize->add_panel( 'layout_options', array(
        'priority'       => 98,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Layout Options', 'travelera-lite'),
        'description'    => __('Here you can change layout of your blog', 'travelera-lite'),
    ) );
    
    /*---[ Homepage ]---*/
    $wp_customize->add_panel( 'homepage_options', array(
        'priority'       => 105,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Homepage', 'travelera-lite'),
        'description'    => __('Here you can change settings of your blog homepage', 'travelera-lite'),
    ) );
    
    /*---[ Social Profiles ]---*/
    $wp_customize->add_panel( 'social_profiles_panel', array(
        'priority'       => 110,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __('Social Profiles', 'travelera-lite'),
        'description'    => __('Here you can add links to your social profiles', 'travelera-lite'),
    ) );
    
}
add_action( 'customize_register', 'travelera_register_theme_customizer_panels' );
?>