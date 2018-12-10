<?php
/**
 * Theme customizer File
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Register theme settings through customizer
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_register_customizer_settings( $wp_customize ) {
	
	$default_settings = traveler_blog_lite_default_settings();	

	/***** Latest Post Settings *****/
	$wp_customize->add_section( 'wpostheme_general_lastestpost_section', array(
		'title' => __( 'Latest Post Slider Settings', 'traveler-blog-lite' ),
	));	

	// Disable Latest Post Slider
	$wp_customize->add_setting( 'dispable_slider', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['dispable_slider'],
									));

	$wp_customize->add_control( 'dispable_slider', array(
										'label'    		  => __( 'Disable Latest Post slider from Header', 'traveler-blog-lite' ),
										'section' 		  => 'wpostheme_general_lastestpost_section',
										'type'            => 'checkbox',
									));

	// number_of_lastestpost
	$wp_customize->add_setting( 'number_of_lastestpost', array(
										'sanitize_callback' => 'absint',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['number_of_lastestpost'],
									));

	$wp_customize->add_control( 'number_of_lastestpost', array(
										'label'    => __( 'No of posts to display', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_lastestpost_section',
										'type'     => 'number'
									));
	// Setting - drop down category for slider.
	$wp_customize->add_setting( 'select_category_for_slider', array(
										'sanitize_callback' => 'sanitize_text_field',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['select_category_for_slider'],
									));

	$wp_customize->add_control( 'select_category_for_slider', array(
										'label'           => esc_html__('Category for slider', 'traveler-blog-lite'),
										'description'     => esc_html__('Add category ID with comma sepraeted ie 2,3,8 etc ', 'traveler-blog-lite'),
										'section'  		  => 'wpostheme_general_lastestpost_section',
										'type'     		  => 'text'
									));	
	
	/***** Website Color Seeings *****/

	$wp_customize->add_panel( 'website_colors_panel', array(
	        'title' => __( 'Website Colors', 'traveler-blog-lite' ),
	));

	$wp_customize->add_section( 'nav_section' , array(
			'title' =>  __('Navigation Color', 'traveler-blog-lite'),
			'panel' => 'website_colors_panel',			
	));

	$wp_customize->add_section( 'heading_section' , array(
			'title' =>  __('Heading Color', 'traveler-blog-lite'),
			'panel' => 'website_colors_panel',			
	));

	$wp_customize->add_section( 'link_section' , array(
			'title' =>  __('Link Color', 'traveler-blog-lite'),
			'panel' => 'website_colors_panel',			
	));

	// Navigation background color
	$txtcolors[] = array(
		'slug'			=>'menu_bar_bg_clr',
		'default' 		=> $default_settings['menu_bar_bg_clr'],
		'label' 		=> __('Navigation Bar - Background Color', 'traveler-blog-lite'),
		'section'   	=> 'nav_section',
		'section_title' => __('Navigation Color', 'traveler-blog-lite'),
	);
	
	// Navigation link color
	$txtcolors[] = array(
		'slug' 			=> 'menu_bar_link_clr',
		'default' 		=> $default_settings['menu_bar_link_clr'],
		'label' 		=> __('Navigation Bar - Link Color', 'traveler-blog-lite'),
		'section'   	=> 'nav_section',
		'section_title' => __('Navigation Color', 'traveler-blog-lite'),
	);
	
	// Navigation link hover color
	$txtcolors[] = array(

		'slug' 			=>'menu_bar_linkh_clr', 
		'default' 		=> $default_settings['menu_bar_linkh_clr'],
		'label' 		=> __('Navigation Bar - Link Hover Color', 'traveler-blog-lite'),
		'section'   	=> 'nav_section',
		'section_title' => __('Navigation Color', 'traveler-blog-lite'),

	);
	
	// Site heading color
	$txtcolors[] = array(
		'slug' 			=> 'h1_clr',
		'default' 		=> $default_settings['h1_clr'],
		'label' 		=> __('H1 Color', 'traveler-blog-lite'),
		'section'   	=> 'heading_section',
		'section_title' => __('Heading Color', 'traveler-blog-lite'),

	);

	// H2 color
	$txtcolors[] = array(
		'slug' 			=> 'h2_clr',
		'default' 		=> $default_settings['h2_clr'],
		'label' 		=> __('H2 Color', 'traveler-blog-lite'),
		'section'   	=> 'heading_section',
		'section_title' => __('Heading Color', 'traveler-blog-lite'),

	);

	// H3 color
	$txtcolors[] = array(
		'slug' 			=> 'h3_clr',
		'default' 		=> $default_settings['h3_clr'],
		'label' 		=> __('H3 Color', 'traveler-blog-lite'),
		'section'   	=> 'heading_section',
		'section_title' => __('Heading Color', 'traveler-blog-lite'),

	);

	// H4 color
	$txtcolors[] = array(
		'slug' 			=> 'h4_clr',
		'default' 		=> $default_settings['h4_clr'],
		'label' 		=> __('H4 Color', 'traveler-blog-lite'),
		'section'   	=> 'heading_section',
		'section_title' => __('Heading Color', 'traveler-blog-lite'),

	);

	// H5 color
	$txtcolors[] = array(
		'slug' 			=> 'h5_clr',
		'default' 		=> $default_settings['h5_clr'],
		'label' 		=> __('H5 Color', 'traveler-blog-lite'),
		'section'   	=> 'heading_section',
		'section_title' => __('Heading Color', 'traveler-blog-lite'),

	);

	// H6 color
	$txtcolors[] = array(
		'slug' 			=> 'h6_clr',
		'default' 		=> $default_settings['h6_clr'],
		'label' 		=> __('H6 Color', 'traveler-blog-lite'),
		'section'   	=> 'heading_section',
		'section_title' => __('Heading Color', 'traveler-blog-lite'),

	);

	// Site link color
	$txtcolors[] = array(
		'slug' 			=> 'link_clr', 
		'default' 		=> $default_settings['link_clr'],
		'label' 		=> __('Link Color', 'traveler-blog-lite'),
		'section'   	=> 'link_section',
		'section_title' => __('Link Color', 'traveler-blog-lite'),
	);

	// Site link hover color
	$txtcolors[] = array(
		'slug' 		=> 'hover_link_clr', 
		'default' 	=> $default_settings['hover_link_clr'],
		'label' 	=> __('Link Hover Color', 'traveler-blog-lite'),
		'section'   	=> 'link_section',
		'section_title' => __('Link Color', 'traveler-blog-lite'),
	);

	// Read continue.
	$txtcolors[] = array(
		'slug' 			=>'continue_read_clr', 
		'default' 		=> $default_settings['continue_read_clr'],
		'label' 		=> __('Continue Reading Button Color', 'traveler-blog-lite'),
		'section'   	=> 'link_section',
		'section_title' => __('Link Color', 'traveler-blog-lite'),
	);

	$txtcolors[] = array(
		'slug' 			=> 'continue_read_hvr_clr', 
		'default' 		=> $default_settings['continue_read_hvr_clr'],
		'label' 		=> __('Continue Reading Button hover Color', 'traveler-blog-lite'),
		'section'   	=> 'link_section',
		'section_title' => __('Link Color', 'traveler-blog-lite'),
	);

	// Website color settings
	foreach( $txtcolors as $txtcolor ) {
	
		// SETTINGS
		$wp_customize->add_setting(
			$txtcolor['slug'], array(
				'default' 				=> $txtcolor['default'],
				'sanitize_callback'     => 'sanitize_hex_color',
				'capability' 			=> 'edit_theme_options'
		));

		// CONTROLS
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $txtcolor['slug'],
				array(
					'label' 	=> $txtcolor['label'], 
					'section' 	=> $txtcolor['section'],
					'settings' 	=> $txtcolor['slug']
				))
		);
	} // End of foreach

	// Header Search Start
	$wp_customize->add_section( 'wpostheme_general_header_search_section', array(
		'title' => __( 'Header Search', 'traveler-blog-lite' ),
	));	

	// Search Icons on Header
	$wp_customize->add_setting( 'show_search', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['show_search'],
									));

	$wp_customize->add_control( 'show_search', array(
										'label'    		  => __( 'Enable Search Icon on Header', 'traveler-blog-lite' ),
										'section' 		  => 'wpostheme_general_header_search_section',
										'type'                    => 'checkbox',
									));
	// Header Search End

	/* Post Settings panel*/
    $wp_customize->add_panel('post_panel', array(
	        'title' => __( 'Post Settings', 'traveler-blog-lite' ),

	));     
    
	/* Blog Page Settings */
	$wp_customize->add_section( 'blog-sett' , array(
		'title' =>  __( 'Blog Page', 'traveler-blog-lite' ),
		'panel' => 'post_panel',
	));
	
 	// Add blog layout grid settings
	$wp_customize->add_setting( 'blog_layout_grid', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_select',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_layout_grid'],
							));
	
	$wp_customize->add_control( 'blog_layout_grid', array(		
		'label'    	=> __( 'Blog Grid', 'traveler-blog-lite' ),
		'section'    => 'blog-sett',
		'settings'   => 'blog_layout_grid',
		'type'       => 'select',
		'choices'    => array(
							'12' => __('Grid 1', 'traveler-blog-lite'),
							'6'  => __('Grid 2', 'traveler-blog-lite'),
							'4'  => __('Grid 3', 'traveler-blog-lite'),
							'3'  => __('Grid 4', 'traveler-blog-lite'),
						),
		'description'	=> __('Choose blog grid.', 'traveler-blog-lite')
	));
	
	// Add blog layout  excerpt length
	$wp_customize->add_setting( 'blog_excerpt_length', array(
									'sanitize_callback' => 'absint',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_excerpt_length'],
							));

	$wp_customize->add_control( 'blog_excerpt_length', array(		
		'label'    	=> __( 'Excerpt Length', 'traveler-blog-lite' ),
		'section'    => 'blog-sett',
		'settings'   => 'blog_excerpt_length',
		'type'       => 'number',		
		'description'	=> __('Enter excerpt length eg 40', 'traveler-blog-lite')
	));
	
	
	// Show/hide Content
	$wp_customize->add_setting( 'blog_show_content', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_content'],
							));

	$wp_customize->add_control( 'blog_show_content', array(
		'label'    		=> __( 'Show Post Content', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_content',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post content.', 'traveler-blog-lite')
	));

	// Show/hide date
	$wp_customize->add_setting( 'blog_show_date', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_date'],
							));

	$wp_customize->add_control( 'blog_show_date', array(
		'label'    		=> __( 'Show Post Date', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_date',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post date.', 'traveler-blog-lite')
	));

	// Show/hide author
	$wp_customize->add_setting( 'blog_show_author', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_author'],
							));

	$wp_customize->add_control( 'blog_show_author', array(		
		'label'    		=> __( 'Show Post Author', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_author',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post author.', 'traveler-blog-lite')
	));
	
	// Show/hide Category
	$wp_customize->add_setting( 'blog_show_cat', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_cat'],
							));

	$wp_customize->add_control( 'blog_show_cat', array(
		'label'    	=> __( 'Show Post Category', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_cat',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post category.', 'traveler-blog-lite')
	));
	
	// Show/hide Tags
	$wp_customize->add_setting( 'blog_show_tags', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_tags'],
							));

	$wp_customize->add_control( 'blog_show_tags', array(		
		'label'    		=> __( 'Show Post Tags', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_tags',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post tags.', 'traveler-blog-lite')
	));
	
	// Show/hide Comments
	$wp_customize->add_setting( 'blog_show_comment', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_comment'],
							));

	$wp_customize->add_control( 'blog_show_comment', array(		
		'label'    		=> __( 'Show Post Comment', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_comment',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post comment.', 'traveler-blog-lite')
	));


	// Show/hide read more button
	$wp_customize->add_setting( 'blog_show_readmore', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['blog_show_readmore'],
							));

	$wp_customize->add_control( 'blog_show_readmore', array(		
		'label'    		=> __( 'Show Continue Reading Button', 'traveler-blog-lite' ),
		'section'    	=> 'blog-sett',
		'settings'  	=> 'blog_show_readmore',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show Continue Reading Button.', 'traveler-blog-lite')
	));


	/***** Category Page Settings *****/
	$wp_customize->add_section( 'cat-sett' , array(
		'title' =>  __( 'Category Page', 'traveler-blog-lite' ),
		'panel' => 'post_panel',
	));	

	// Add blog layout grid settings
	$wp_customize->add_setting( 'cat_layout_grid', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_select',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_layout_grid'],
							));
	
	$wp_customize->add_control( 'cat_layout_grid', array(		
		'label'    	=> __( 'Cat Grid', 'traveler-blog-lite' ),
		'section'    => 'cat-sett',
		'settings'   => 'cat_layout_grid',
		'type'       => 'select',
		'choices'    => array(
							'12' => __('Grid 1', 'traveler-blog-lite'),
							'6'  => __('Grid 2', 'traveler-blog-lite'),
							'4'  => __('Grid 3', 'traveler-blog-lite'),
							'3'  => __('Grid 4', 'traveler-blog-lite'),
						),
		'description'	=> __('Choose blog grid.', 'traveler-blog-lite')
	));

	// Add Category layout  excerpt length
	$wp_customize->add_setting( 'cat_excerpt_length', array(
									'sanitize_callback' => 'absint',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_excerpt_length'],
							));

	$wp_customize->add_control( 'cat_excerpt_length', array(		
		'label'    	=> __( 'Excerpt Length', 'traveler-blog-lite' ),
		'section'    => 'cat-sett',
		'settings'   => 'cat_excerpt_length',
		'type'       => 'number',		
		'description'	=> __('Enter excerpt length eg 40', 'traveler-blog-lite')
	));	

	// Show/hide content
	$wp_customize->add_setting( 'cat_show_content', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_content'],
							));

	$wp_customize->add_control( 'cat_show_content', array(		
		'label'    		=> __( 'Show Post Content', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_content',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post content.', 'traveler-blog-lite')
	));

	// Show/hide date
	$wp_customize->add_setting( 'cat_show_date', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_date'],
							));

	$wp_customize->add_control( 'cat_show_date', array(		
		'label'    		=> __( 'Show Post Date', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_date',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post date.', 'traveler-blog-lite')
	));

	// Show/hide author
	$wp_customize->add_setting( 'cat_show_author', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_author'],
							));

	$wp_customize->add_control( 'cat_show_author', array(		
		'label'    		=> __( 'Show Post Author', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_author',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post author.', 'traveler-blog-lite')
	));

	// Show/hide Category
	$wp_customize->add_setting( 'cat_show_cat', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_cat'],
							));

	$wp_customize->add_control( 'cat_show_cat', array(		
		'label'    		=> __( 'Show Post Category', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_cat',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post category.', 'traveler-blog-lite')
	));
	
	// Show/hide Tags
	$wp_customize->add_setting( 'cat_show_tags', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_tags'],
							));

	$wp_customize->add_control( 'cat_show_tags', array(		
		'label'    		=> __( 'Show Post Tags', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_tags',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post tags.', 'traveler-blog-lite')
	));
	
	// Show/hide Comments
	$wp_customize->add_setting( 'cat_show_comment', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_comment'],
							));

	$wp_customize->add_control( 'cat_show_comment', array(		
		'label'    		=> __( 'Show Post Comment', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_comment',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show post comment.', 'traveler-blog-lite')
	));


	
	// Show/hide read more button
	$wp_customize->add_setting( 'cat_show_readmore', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['cat_show_readmore'],
							));

	$wp_customize->add_control( 'cat_show_readmore', array(		
		'label'    		=> __( 'Show Continue Reading Button', 'traveler-blog-lite' ),
		'section'    	=> 'cat-sett',
		'settings'  	=> 'cat_show_readmore',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show Continue Reading Button.', 'traveler-blog-lite')
	));

	
	/***** Single Post Settings *****/
	$wp_customize->add_section( 'single-post-sett' , array(
		'title' =>  __( 'Single Post', 'traveler-blog-lite' ),
		'panel' => 'post_panel',
	));
	

	// Add blog template settings
	$wp_customize->add_setting( 'single_post_fet_img', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['single_post_fet_img'],
							));

	$wp_customize->add_control( 'single_post_fet_img', array(		
		'label'    		=> __( 'Show Featured Image.', 'traveler-blog-lite' ),
		'section'    	=> 'single-post-sett',
		'settings'  	=> 'single_post_fet_img',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show featured image from single post.', 'traveler-blog-lite')
	));


	// related
	$wp_customize->add_setting( 'related_post_show', array(
									'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
									'transport'         => 'refresh',
									'default'           => $default_settings['related_post_show'],
							));

	$wp_customize->add_control( 'related_post_show', array(		
		'label'    		=> __( 'Related Post.', 'traveler-blog-lite' ),
		'section'    	=> 'single-post-sett',
		'settings'  	=> 'related_post_show',
		'type'       	=> 'checkbox',
		'description' 	=> __('Check this box if you want to show Related post.', 'traveler-blog-lite')
	));


	$wp_customize->add_setting( 'related_post_title', array(
									'sanitize_callback' => 'sanitize_text_field',
									'transport'         => 'refresh',
									'default'           => $default_settings['related_post_title'],
							   ));

	$wp_customize->add_control( 'related_post_title', array(		
		'label'    		=> __( 'Related Post Title.', 'traveler-blog-lite' ),
		'section'    	=> 'single-post-sett',
		'settings'  	=> 'related_post_title',
		'type'       	=> 'text',
		'description' 	=> __('Enter related post title.', 'traveler-blog-lite')
	));

	
	
	/***** Social Icons Settings *****/
	$wp_customize->add_section( 'wpostheme_general_socials_section', array(
		'title' => __( 'Social Profile', 'traveler-blog-lite' ),
	));	

	// Socials Icons on Header
	$wp_customize->add_setting( 'header_social', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['header_social'],
									));

	$wp_customize->add_control( 'header_social', array(
										'label'    		  => __( 'Enable Socials Icons on Header', 'traveler-blog-lite' ),
										'section' 		  => 'wpostheme_general_socials_section',
										'type'                    => 'checkbox',
									));

	// Socials Icons on Footer
	$wp_customize->add_setting( 'footer_social', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_checkbox',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['footer_social'],
									));

	$wp_customize->add_control( 'footer_social', array(
										'label'    		  => __( 'Enable Socials Icons on Footer', 'traveler-blog-lite' ),
										'section' 		  => 'wpostheme_general_socials_section',
										'type'                    => 'checkbox',
									));

	// Facebook
	$wp_customize->add_setting( 'facebook', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['facebook'],
									));

	$wp_customize->add_control( 'facebook', array(
										'label'    => __( 'Facebook', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));

	// Twitter
	$wp_customize->add_setting( 'twitter', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['twitter'],
									));

	$wp_customize->add_control( 'twitter', array(
										'label'    => __( 'Twitter', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',			
									));

	// Linkedin
	$wp_customize->add_setting( 'linkedin', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['linkedin'],
									));

	$wp_customize->add_control( 'linkedin', array(
										'label'    => __( 'Linkedin', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));

	// Instagram
	$wp_customize->add_setting( 'instagram', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['instagram'],
									));

	$wp_customize->add_control( 'instagram', array(
										'label'    => __( 'Instagram', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));

	// YouTube
	$wp_customize->add_setting( 'youtube', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['youtube'],
									));

	$wp_customize->add_control( 'youtube', array(
										'label'    => __( 'YouTube', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));

	// Behance
	$wp_customize->add_setting( 'behance', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['behance'],
									));

	$wp_customize->add_control( 'behance', array(
										'label'    => __( 'Behance', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));

	// Dribbble
	$wp_customize->add_setting( 'dribbble', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['dribbble'],
									));

	$wp_customize->add_control( 'dribbble', array(
										'label'    => __( 'Dribbble', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));

	// Pinterest
	$wp_customize->add_setting( 'pinterest', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_url',
										'transport'         => 'refresh',
										'default' 			=> $default_settings['pinterest'],
									));

	$wp_customize->add_control( 'pinterest', array(
										'label'    => __( 'Pinterest', 'traveler-blog-lite' ),
										'section'  => 'wpostheme_general_socials_section',
									));
	





	/***** Footer Settings *****/
	$wp_customize->add_section( 'wpostheme_general_footer_section', array(
		'title' => __( 'Footer Content', 'traveler-blog-lite' ),			
	));

	// Footer Copyright
	$wp_customize->add_setting( 'copyright', array(
										'sanitize_callback' => 'traveler_blog_lite_sanitize_clean',
										'default'           => $default_settings['copyright'],
										'transport'         => 'refresh',	
									));

	$wp_customize->add_control( 'copyright', array(
										'label'    => __( 'Footer Copyright', 'traveler-blog-lite' ),
										'description'	=> __('If you want to add the copyrights please use the following text - &copy {year} YOUR BRAND NAME', 'traveler-blog-lite'),
										'section'  => 'wpostheme_general_footer_section',
									));	
										
	
	
	
}
add_action( 'customize_register', 'traveler_blog_lite_register_customizer_settings' );
