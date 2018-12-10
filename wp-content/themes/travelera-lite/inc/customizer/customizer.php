<?php
/**
* Registers options with the Theme Customizer
*
* @param object $wp_customize The WordPress Theme Customizer
* @package travelera
* @since 1.0
*/

$travelera_customizer_dir = get_template_directory() .'/inc/customizer/';

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Travelera 1.0
 *
 * @see travelera_header_style()
 */
function travelera_custom_header_and_background() {

	/**
	 * Filter the arguments used when adding 'custom-background' support in Travelera.
	 *
	 * @since Travelera 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'min_custom_background_args', array(
		'default-color' => 'F9F9F9',
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Travelera.
	 *
	 * @since Travelera 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'travelera_custom_header_args', array(
		'default-text-color' => '#2a2c2b',
		'wp-head-callback'   => 'travelera_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'travelera_custom_header_and_background' );

if ( ! function_exists( 'travelera_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own travelera_header_style() function to override in a child theme.
 *
 * @since Travelera 1.0
 *
 * @see travelera_custom_header_and_background().
 */
function travelera_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="travelera-header-css">
		.logo-wrap #logo,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
            left: 0;
			position: absolute;
		}
	</style>
	<?php
}
endif; // travelera_header_style

function travelera_get_categories_select() {
    $the_cats = get_categories();
    $results;
    $count = count($the_cats);
    for ( $i=0; $i < $count; $i++ ) {
        if ( isset( $the_cats[$i] ) )
            $results[$the_cats[$i]->slug] = $the_cats[$i]->name;
        else
            $count++;
    }
    return $results;
}

function travelera_register_theme_customizer( $wp_customize ) {

    $travelera_customizer_dir = get_template_directory() .'/inc/customizer/';
    
    // Remove header text color option
    $wp_customize->remove_control( 'header_textcolor' );
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.logo a',
			'container_inclusive' => false,
			'render_callback'     => 'travelera_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.tagline',
			'container_inclusive' => false,
			'render_callback'     => 'travelera_customize_partial_blogdescription',
		) );
	}
	
	// Custom Divide Control
	class WP_Customize_Divide_Control extends WP_Customize_Control {
		public $type = 'divide';
	 
		public function render_content() {
			?>
				<h3 class="customize-divide"><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}
	
	// Custom Layout Control
	class Layout_Picker_Custom_Control extends WP_Customize_Control {
		  /**
		   * Render the content on the theme customizer page
		   */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<ul>
				<?php
				foreach ( $this->choices as $key => $value ) {
					?>
					<li class="customizer-control-row">
				        <input type="radio" value="<?php echo esc_attr( $key ) ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php echo esc_attr( $this->link() ); ?> <?php if( $this->value() === $key ) echo 'checked="checked"'; ?>>
						<label for="<?php echo esc_attr( $key ) ?>"></label>
					</li>
					<?php
				}
				?>
			</ul>
			<?php
		}
	}
} // end travelera_register_theme_customizer
add_action( 'customize_register', 'travelera_register_theme_customizer' );
 
/**
 * Render the site title for the selective refresh partial.
 *
 * @since Travelera 1.0
 * @see travelera_register_theme_customizer()
 *
 * @return void
 */
function travelera_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Travelera 1.0
 * @see travelera_register_theme_customizer()
 *
 * @return void
 */
function travelera_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

// Customizer Panels
//--------------------------------------------//
get_template_part( 'inc/customizer/panels' );

// Customizer Sections
//--------------------------------------------//
get_template_part( 'inc/customizer/sections' );

// Customizer Settings
//--------------------------------------------//
get_template_part( 'inc/customizer/settings' );

// Include Fonts
//--------------------------------------------//
get_template_part( 'inc/customizer/fonts' );

/**
 * Registers customizer settings and controls.
 *
 * @since Travelera 1.0
 *
 */
function travelera_customizer_settings_register($wp_customize) {
    $fields = array();
    $fields = apply_filters( 'travelera_customizer_settings_register', $fields );
    
    foreach ( $fields as $field ) {
		$wp_customize->add_setting( $field[ 'id' ], array(
			'default'           => empty( $field[ 'default' ] ) ? null : $field[ 'default' ],
			'type'              => empty( $field[ 'type' ] ) ? null : $field[ 'type' ],
			'capability'        => empty( $field[ 'capability' ] ) ? 'edit_theme_options' : $field[ 'capability' ],
			'transport'         => empty( $field[ 'transport' ] ) ? null : $field[ 'transport' ],
			'sanitize_callback' => empty( $field[ 'sanitize_callback' ] ) ? null : $field[ 'sanitize_callback' ],
		) );
        
        if ( 'color' === $field[ 'control' ] ) {
			$wp_customize->add_control(
                new WP_Customize_Color_Control( $wp_customize, $field['id'], array(
					'label'           => empty( $field[ 'label' ] ) ? null : $field[ 'label' ],
					'description'     => empty( $field[ 'description' ] ) ? null : $field[ 'description' ],
					'section'         => empty( $field[ 'section' ] ) ? null : $field[ 'section' ],
					'settings'        => $field['id'],
					'active_callback' => empty( $field[ 'active_callback' ] ) ? null : $field[ 'active_callback' ],
				)
			) );
		} elseif ( 'layout' === $field[ 'control' ] ) {
            $wp_customize->add_control(
                new Layout_Picker_Custom_Control ( $wp_customize, $field['id'], array(
                    'label'           => empty( $field[ 'label' ] ) ? null : $field[ 'label' ],
                    'section'         => empty( $field[ 'section' ] ) ? null : $field[ 'section' ],
                    'settings'        => $field['id'],
                    'choices'         => $field['choices'],
                )
            ) );
		} elseif ( 'divide' === $field[ 'control' ] ) {
            $wp_customize->add_control(
                new WP_Customize_Divide_Control ( $wp_customize, $field['id'], array(
                    'label'           => empty( $field[ 'label' ] ) ? null : $field[ 'label' ],
                    'section'         => empty( $field[ 'section' ] ) ? null : $field[ 'section' ],
                    'settings'        => $field['id'],
                )
            ) );
		} elseif ( 'image' === $field[ 'control' ] ) {
            $wp_customize->add_control(
                new WP_Customize_Image_Control ( $wp_customize, $field['id'], array(
                    'label'           => empty( $field[ 'label' ] ) ? null : $field[ 'label' ],
                    'section'         => empty( $field[ 'section' ] ) ? null : $field[ 'section' ],
                    'settings'        => $field['id'],
                )
            ) );
		} else {
            $wp_customize->add_control( $field[ 'id' ], array(
                'type'            => empty( $field[ 'control' ] ) ? null : $field[ 'control' ],
                'section'         => empty( $field[ 'section' ] ) ? null : $field[ 'section' ],
                'default'         => empty( $field[ 'default' ] ) ? 0 : $field[ 'default' ],
                'settings'        => $field['id'],
                'label'           => empty( $field[ 'label' ] ) ? null : $field[ 'label' ],
                'description'     => empty( $field[ 'description' ] ) ? null : $field[ 'description' ],
                'choices'         => empty( $field[ 'choices' ] ) ? null : $field[ 'choices' ],
                'input_attrs'     => empty( $field[ 'input_attrs' ] ) ? null : $field[ 'input_attrs' ],
                'active_callback' => empty( $field[ 'active_callback' ] ) ? null : $field[ 'active_callback' ],
            ) );
        }
    }
    
    if ( $wp_customize->is_preview() && ! is_admin() ) {
        add_action( 'wp_footer', 'travelera_customize_preview', 21);
    }
}
add_action( 'customize_register', 'travelera_customizer_settings_register' );

function travelera_customize_preview() {
    ?>
    <script type="text/javascript">
    ( function( $ ){
        
        var arr = {
            color_scheme_1: {
                color: 'a, a:hover, .title a:hover, .sidebar a:hover, .category-title span, .meta a:hover, .post-meta a:hover, .edit-post a, .read-more a:hover, .more-link:hover, .error-text, .primary-color, .post-comments .fa, .post-content ul li:before, .content-page ul li:before, blockquote:before, blockquote:after, .widget li:before',
                background: '.search-button, .tagcloud a:hover, .post-meta .post-comments a:hover, .pagination .current, .pagination .current-post-page, .pagination a:hover, input[type="submit"], #wp-calendar caption, #wp-calendar td#today, .comment-form .submit, .wpcf7-submit, .archive-articles-count, .post-tags a:hover, .widget-title:before, .section-heading:before, .tabs li.active:before, .recent-posts li .thumbnail-big:before, .owl-controls .owl-dot.active span, .owl-controls .owl-dot:hover span, .jetpack_subscription_widget input[type=submit], .thumbnail-big:before, .comment-reply-link:hover, .sb form input[type="submit"]',
                border: '.tagcloud a:hover .post blockquote, .pagination .current, .pagination .current-post-page, .pagination a:hover, .comment-reply-link:hover',
                border_top: '.post-meta .post-comments a:hover:before',
            },
            color_scheme_2: {
                background: '.post-cats a'
            },
            header_background_color: {
                background: '.main-header'
            },
            logo_color: {
                color: '.logo a'
            },
        };
 
        jQuery.each(arr, function (index, valuee) {
            //console.log(valuee.color);
            wp.customize( index, function( value ) {
                value.bind( function( to ) {

                    var style, el;

                    // build the style element
                    style = '<style class="hover-styles">' + valuee.color + ' { color: ' + to + '; }' + valuee.background + ' { background-color: ' + to + '; }</style>';

                    $( 'head' ).append( style ); // style element doesn't exist so add it
                } );
            } );
        } );
 
        var arr_typo = {
            logo: '#logo',
            menu: '.nav-menu',
            headings: '.post-content h1,.post-content h2,.post-content h3,.post-content h4,.post-content h5,.post-content h6,.post-nav-link',
            entry_title: '.entry-title',
            single_title: '.single .entry-title',
            post_meta: '.post-meta, .post-cats',
            post_content: '.post-content',
            widgets_title: '.widget-title, .tabs li a, .section-heading, .post-nav-title',
        };

        jQuery.each(arr_typo, function (index, valuee) {
            wp.customize( index + '_font_style', function( value ) {
                value.bind( function( to ) {
                    $( valuee ).css( 'font-style', to );
                } );
            });

            wp.customize( index + '_font_weight', function( value ) {
                value.bind( function( to ) {
                    $( valuee ).css( 'font-weight', to );
                } );
            });

            wp.customize( index + '_text_transform', function( value ) {
                value.bind( function( to ) {
                    $( valuee ).css( 'text-transform', to );
                } );
            });

            wp.customize( index + '_font_size', function( value ) {
                value.bind( function( to ) {
                    $( valuee ).css( 'font-size', to );
                } );
            });

            wp.customize( index + '_line_height', function( value ) {
                value.bind( function( to ) {
                    $( valuee ).css( 'line-height', to );
                } );
            });
        });
    } )( jQuery )
    </script>
    <?php 
}

/**
 * Output customizer CSS. Default values are used for output when new settings are not saved
 *
 * @since Travelera 1.0
 *
 */
function travelera_customizer_apply_css() {
    $fields = array();
	$fields = apply_filters( 'travelera_customizer_apply_css', $fields );
    
    $css = '';
    $new_array = array();
    foreach ( $fields as $field ) {
        if ( !empty( $field['output'] ) && is_array($field['output']) ){
            foreach ( $field['output'] as $property => $selector ) {
                $value = get_theme_mod( $field['id'] );
                
                if ( empty( $value ) ) {
                    $value = $field['default'];
                }
                
                if ( !isset($new_array[$selector]) ) {
                    $new_array[$selector] = '';
                }

				$new_array[$selector] .= $property . ':' . $value . ';';
            }
        }
    }
                
    foreach( $new_array as $new_property => $new_value ){ 

        $css .= $new_property . '{' . $new_value . '}';
        
    }
    
	$travelera_custom_css = '';    
    
    // Header Colors
    $travelera_header_css = '';
    $travelera_header_image = get_header_image();
    
    if ( !empty( $travelera_header_image ) ) {
        $travelera_header_css .= '.main-header { background: url('. esc_url( $travelera_header_image ) . ') no-repeat 100% 50%; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; }';
    
        $css .= "\n" . $travelera_header_css;
    }
    
	// Custom CSS
    $travelera_custom_css = get_theme_mod('custom_css');
	if ( $travelera_custom_css != '' ) {
        $css .= "\n" . $travelera_custom_css;
	}
    
    return $css;
}

/**
*
* Adds Google Web Fonts to '<head>' based on fonts selected
* in the Theme Customizer.
*
*/
function travelera_google_fonts() {
	$fonts = array();
    $fields = array();
	$fields = apply_filters( 'travelera_customizer_google_fonts', $fields );
    
    foreach ( $fields as $field ) {
        if ( !empty ( $field['key'] ) ) {
            if ( $field['key'] == 'fonts_family' ) {
                $font_family = get_theme_mod( $field['id'] );
                
				//$value = empty( $field['default'] ) ? $value : $field['default'];
                
                if ( empty( $font_family ) ) {
                    $font_family = $field['default'];
                }
                
                if ( !in_array( $font_family, $fonts ) ) {
                    array_push( $fonts, $font_family );
                }
            }
        }
    }
	
    if ( !empty( $fonts ) ) {
        $travelera_protocol = is_ssl() ? 'https' : 'http';
        $travelera_google_font = implode(':300,400,500,600,700,800|', $fonts);
        $travelera_google_fonts_url = $travelera_protocol.'://fonts.googleapis.com/css?family='.$travelera_google_font.':300,400,500,600,700,800';
        wp_enqueue_style( 'travelera-google-font', "$travelera_google_fonts_url", array(), null );
    }
}
add_action( 'wp_enqueue_scripts', 'travelera_google_fonts' );

function travelera_sanitize_checkbox( $input ) {
    if ( $input ) {
            $output = '1';
    } else {
            $output = false;
    }
    return $output;
}
function travelera_sanitize_choices( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Sanitize CSS
function travelera_sanitize_css( $text ) {

    return esc_textarea( $text );

}

/**
* Sanitizes Font Select Field
*/
function travelera_sanitize_fonts( $input ) {
    global $fonts_list;
    $valid = $fonts_list;

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
* Sanitizes Categories Select Field
*/
function travelera_sanitize_cat( $input ) {
    $valid = travelera_get_categories_select();

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
* Sanitizes the incoming input and returns it prior to serialization.
*
* @param string $input The string to sanitize
* @return string The sanitized string
*/
function travelera_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end travelera_sanitize_text

/**
*
* Registers the Theme Customizer Preview with WordPress.
*
*/
function travelera_customizer_live_preview() {
	wp_enqueue_script(
		'travelera-themecustomizer',
		get_template_directory_uri() . '/assets/js/theme-customizer.js',
		array( 'jquery', 'customize-preview' ),
		'',
		true
	);
} // end travelera_customizer_live_preview
add_action( 'customize_preview_init', 'travelera_customizer_live_preview' );