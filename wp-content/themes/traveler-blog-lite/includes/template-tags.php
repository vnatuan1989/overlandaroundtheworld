<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Traveler Blog Lite
 */

/**
 * Auto add more links.
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_content_more() {	
	/* translators: link read more. */
	$text = wp_kses_post( sprintf( esc_html__( 'Continue reading &#10142; %s', 'traveler-blog-lite' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
	$more = sprintf( '<div class="link-more"><a href="%s#more-%d" class="more-link">%s</a></div>', esc_url( get_permalink() ), get_the_ID(), $text );
	if ( !is_admin() ) {
		return $more;
	}
}
add_filter( 'the_content_more_link', 'traveler_blog_lite_content_more' );

/**
 * Auto add more links.
 * 
 * @package Traveler Blog Lite
 * @since 1.0
 */
function traveler_blog_lite_excerpt_more_link( $excerpt ) {

	if ( is_admin() ) {
		return $excerpt;
	}

	if ( is_home() || is_front_page() ) { 	
		$show_readmore 	= traveler_blog_lite_get_theme_mod( 'blog_show_readmore' );
	} elseif( is_category() || is_archive() ) {
		$show_readmore 	= traveler_blog_lite_get_theme_mod( 'cat_show_readmore' );
	}else{
		$show_readmore 	= traveler_blog_lite_get_theme_mod( 'blog_show_readmore' );
	}
	
	if( !empty($show_readmore) ){
		$excerpt 	.= traveler_blog_lite_content_more();	
	}
    
    return $excerpt;
}
add_filter( 'the_excerpt', 'traveler_blog_lite_excerpt_more_link', 21 );

/**
 * Prints HTML with meta information for the current post-date/time and categories, tags..
 */
function traveler_blog_lite_cat_posted_on( $meta = array() ) {

     $default_meta = array(                                  
                                    'category' 	=> 1,
                          );

	if( !empty($meta) && is_array($meta) ) {
		foreach ($default_meta as $meta_key => $meta_val) {
			$val = in_array($meta_key, $meta) ? 1 : 0;
			$result_meta[$meta_key] = $val;
		}
	}

	$result_meta = !empty($result_meta) ? $result_meta : $default_meta;
	extract( $result_meta, EXTR_SKIP );

	if( is_home() || is_front_page() || is_search()) {
		$category 	= traveler_blog_lite_get_theme_mod( 'blog_show_cat' );
	} elseif( is_category() || is_archive() || is_tag() || is_author() ) {
		$category 	= traveler_blog_lite_get_theme_mod( 'cat_show_cat' );
	}

	// Post Category
	if( $category ) {
		/* translators: used between list items, there is a space after the comma */
		echo '<div class="entry-meta entry-meta-category">';		
		
		$category_name = get_the_category(); 
		
		if(empty($category_name))
		{
		 return;	
		}		

		// use this to echo the slug
		$category_slug = $category_name[0]->slug;

		// use this to echo the cat id
		$category_id = $category_name[0]->cat_ID;
		
		
		// if you've got multiple categories you can run a foreach loop like so
		foreach ( $category_name as $cat ) :				

		$category_link = get_category_link( $cat->cat_ID );
			echo '<a class="cat-link" href="'.esc_url($category_link).'" >' . esc_html($cat->name) . '</a>';

		endforeach;		
		echo '</div>';
	}
		
}

/**
 * Prints HTML with meta information for the current post-date/time and categories, tags..
 */
function traveler_blog_lite_posted_on( $meta = array() ) {

       $default_meta = array(
                                'post_date' => 1,
                                'author' 	=> 1, 
                                'comment'	=> 1,
                        );

	if( !empty($meta) && is_array($meta) ) {
		foreach ($default_meta as $meta_key => $meta_val) {
			$val = in_array($meta_key, $meta) ? 1 : 0;

			$result_meta[$meta_key] = $val;
		}
	}

	$result_meta = !empty($result_meta) ? $result_meta : $default_meta;
	extract( $result_meta, EXTR_SKIP );

	if( is_home() || is_front_page() || is_search()) {

		$post_date 			= traveler_blog_lite_get_theme_mod( 'blog_show_date' );
		$author 			= traveler_blog_lite_get_theme_mod( 'blog_show_author' );			
		$blog_show_comment 	= traveler_blog_lite_get_theme_mod( 'blog_show_comment' );

	} elseif( is_category() || is_archive() ||  is_author() ) {

		$post_date 			= traveler_blog_lite_get_theme_mod( 'cat_show_date' );
		$author 			= traveler_blog_lite_get_theme_mod( 'cat_show_author' );		
		$blog_show_comment 	= traveler_blog_lite_get_theme_mod( 'cat_show_comment' );	

	}

	if( $post_date || $author || !empty( $blog_show_comment ) ){
		echo '<div class="entry-meta">';
	}
	
	if( $author ) {
	   echo '<span class="author vcard byline">';		
       echo get_avatar( get_the_author_meta( 'ID' ), 80 );
       echo sprintf( '<a href="%1$s" class="url fn" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
	   echo '</span>';		
	}

	// Post Date
	if( $post_date ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on"><i class="fa fa-clock-o"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
	}		

	if ( !empty($blog_show_comment) &&  !post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comments-o"></i>';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'traveler-blog-lite' ), array(
			'span' => array(
				'class' => array(),
			),
		) ), get_the_title() ) );
		echo '</span>';
	}

	if( $post_date || $author || !empty($blog_show_comment) ){
	echo '</div>';
	}
}



/**
 * Prints HTML with meta information for the current post  and tags..
 */
function traveler_blog_lite_tags_posted_on( $meta = array() ) {

       $default_meta = array(                                
                                'tag'		=> 1,                               
                        );

	if( !empty($meta) && is_array($meta) ) {
		foreach ($default_meta as $meta_key => $meta_val) {
			$val = in_array($meta_key, $meta) ? 1 : 0;

			$result_meta[$meta_key] = $val;
		}
	}

	$result_meta = !empty($result_meta) ? $result_meta : $default_meta;
	extract( $result_meta, EXTR_SKIP );

	if( is_home() || is_front_page() || is_search()) {			
		$tag 				= traveler_blog_lite_get_theme_mod( 'blog_show_tags' );
	} elseif( is_category() || is_archive() || is_tag() || is_author() ) {		
		$tag 				= traveler_blog_lite_get_theme_mod( 'cat_show_tags' );	

	}

	// Hide category and tag text for pages.
	if ( $tag && 'post' === get_post_type() ) {
		echo '<div class="entry-meta">';
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'traveler-blog-lite' ) );
		if ( $tags_list ) {
			echo '<span class="tags-links"><i class="fa fa-tags"></i>' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
		echo '</div>';
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and categories, tags..
 */
function traveler_blog_lite_latest_posted_on( $meta = array() ) {

       $default_meta = array(
                                'post_date' => 1,
                                'author' 	=> 1,                                 
                        );

	if( !empty($meta) && is_array($meta) ) {
		foreach ($default_meta as $meta_key => $meta_val) {
			$val = in_array($meta_key, $meta) ? 1 : 0;

			$result_meta[$meta_key] = $val;
		}
	}

	$result_meta = !empty($result_meta) ? $result_meta : $default_meta;
	extract( $result_meta, EXTR_SKIP );
	

	if( $post_date || $author){
		echo '<div class="entry-meta">';
	}
	
	if( $author ) {
	   echo '<span class="author vcard byline">';		
       echo get_avatar( get_the_author_meta( 'ID' ), 80 );
       echo sprintf( '<a href="%1$s" class="url fn" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
	   echo '</span>';		
	}

	// Post Date
	if( $post_date ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on"><i class="fa fa-clock-o"></i>' . $posted_on . '</span>'; // WPCS: XSS OK.
	}	

	

	if( $post_date || $author){
	echo '</div>';
	}
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function traveler_blog_lite_entry_footer() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'traveler-blog-lite' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Change the tag could args
 *
 * @param array $args Widget parameters.
 *
 * @return mixed
 */
function traveler_blog_lite_tag_cloud_args( $args ) {
	$args['largest']  = 1; // Largest tag.
	$args['smallest'] = 1; // Smallest tag.
	$args['unit']     = 'em'; // Tag font unit.

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'traveler_blog_lite_tag_cloud_args' );