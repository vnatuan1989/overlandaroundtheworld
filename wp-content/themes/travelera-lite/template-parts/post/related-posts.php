<?php
    $categories = '';
    $tags = '';
    $travelera_related_posts_count = travelera_theme_mod( 'related_posts_count' );

    $travelera_related_posts_title = esc_html__('Related Posts','travelera-lite');
    $travelera_related_posts_count = ( $travelera_related_posts_count ) ? $travelera_related_posts_count : '3';

    // Related Posts By Tags
    if ( travelera_theme_mod( 'related_posts_by' ) == 'tags') {
        $tags = wp_get_post_tags($post->ID);        
        if ( $tags ) {
            $tag_ids = array();  
            foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;  
            $args = array(
                'tag__in' => $tag_ids,
                'post__not_in' => array( $post->ID ),
                'posts_per_page'=> $travelera_related_posts_count, // Number of related posts to display.  
                'ignore_sticky_posts'=> 1
            ); 
        }
    }
    // Related Posts By Categories
    else {
        $categories = get_the_category($post->ID);
        if ( $categories ) {
            $category_ids = array();
            foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;
            $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array( $post->ID ),
                'posts_per_page'=> $travelera_related_posts_count, // Number of related posts that will be shown.
                'ignore_sticky_posts'=> 1
            );
        }
    }
    if ( $categories || $tags || $travelera_user_post_count ) {
        $my_query = new WP_Query( $args );
        if( $my_query->have_posts() ) {
            echo '<div class="related-posts single-box clearfix"><h3 class="section-heading uppercase">' . esc_attr( $travelera_related_posts_title ) . '</h3>';
            while( $my_query->have_posts() ) {
                $my_query->the_post(); ?>
                <div class="grid-post">
                    <article <?php post_class(); ?>>
                        <div id="post-<?php the_ID(); ?>" class="post-box">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail" itemprop="image">
                                    <?php the_post_thumbnail( 'travelera-featured' ); ?>
                                </a>
                                <div class="post-inner">
                                    <?php
                                        // Post Header
                                        get_template_part('template-parts/post/post-header');
                                    ?>
                                    <?php if ( is_search() ) { ?>
                                        <div class="post-content entry-summary">
                                            <?php the_excerpt(); ?>
                                        </div><!-- .entry-summary -->
                                    <?php } else { ?>
                                        <div class="post-content entry-content">
                                            <?php
                                                $travelera_home_content = travelera_theme_mod( 'home_content' );
                                                if ( $travelera_home_content == 'full_content' ) {
                                                    the_content( esc_html__('Read More','travelera-lite') );
                                                } else {
                                                    the_excerpt();
                                                }

                                                get_template_part('template-parts/post/post-footer');
                                            ?>
                                        </div><!--post-content-->
                                    <?php } ?>
                                </div><!--.post-inner-->
                        </div><!--.post-box-->
                    </article>
                </div>
                <?php
            }
            echo '</div>';
        }
    }
    wp_reset_postdata();
?>