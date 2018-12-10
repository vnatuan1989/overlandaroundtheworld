<?php
// Don't print empty markup if there's nowhere to navigate.
$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );

if ( ! $next && ! $previous ) {
    return;
}

?>
<nav class="navigation post-navigation clearfix">
    <?php
    if ( is_attachment() ) :
        next_post_link('<div class="alignleft post-nav-links prev-link-wrapper"><div class="next-link"><span class="uppercase">'. __("Published In","travelera-lite") .'</span> %link'."</div></div>");
    else :

        $prev_post_bg = '';
        $next_post_bg = '';

        $prev_post = get_previous_post();
        if (!empty( $prev_post )):
            //$prev_post_bg = get_the_post_thumbnail( $prev_post->ID, 'featured370' );
            $prev_post_bg_url = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'featuredthumb' );
            if ( $prev_post_bg_url ) {
                $prev_post_bg = 'style="background-image:url('. $prev_post_bg_url[0] .'); background-size:cover;"';
            }
        endif;

        $next_post = get_next_post();
        if (!empty( $next_post )):
            //$next_post_bg = get_the_post_thumbnail( $next_post->ID, 'featured370' );
            $next_post_bg_url = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'featuredthumb' );
            if ( $next_post_bg_url ) {
                $next_post_bg = 'style="background-image:url('. $next_post_bg_url[0] .'); background-size:cover;"';
            }
        endif;

        previous_post_link('<div class="alignleft post-nav-links prev-link-wrapper"' .$prev_post_bg . '><div class="post-nav-link-bg"></div><div class="prev-link"><span class="uppercase">'. __("Previous Article","travelera-lite").'</span> %link'."</div></div>");
        next_post_link('<div class="alignright post-nav-links next-link-wrapper"'. $next_post_bg .'><div class="post-nav-link-bg"></div><div class="next-link"><span class="uppercase">'. __("Next Article","travelera-lite") .'</i></span> %link'."</div></div>");
    endif;
    ?>
</nav><!-- .navigation -->
