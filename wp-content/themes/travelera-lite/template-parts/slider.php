<div class="fs-wrap clearfix">
    <div class="container">
        <div class="featuredslider owl-carousel loading clearfix" data-dots='true' data-nav='false' <?php travelera_slider_rtl_check(); ?>><?php
            $travelera_slider_cat = travelera_theme_mod('featured_slider_cat');
            if ( empty( $travelera_slider_cat ) ) {
                esc_html_e( 'Please chose a category for slider','travelera-lite' );
            } else {
                $featured_slider_posts_count = travelera_theme_mod('f_slider_posts_count');
                $featured_slider_cat = travelera_theme_mod('featured_slider_cat');

                $featured_posts = new WP_Query( array(
                    'cat'       => $featured_slider_cat,
                    'orderby'   => 'date',
                    'order'     => 'DESC',
                    'showposts' => $featured_slider_posts_count,
                ) );
            }

            if ( $featured_posts->have_posts() ) : while ( $featured_posts->have_posts() ) : $featured_posts->the_post(); ?>
            <div class="item">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="featured-thumbnail f-thumb">
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'travelera-slider' );
                        }
                    ?>
                    <div class="post-inner">
                        <div class="slider-inner">
                            <?php
                                if ( travelera_theme_mod('post_cats') == '1' ) {
                                    ?>
                                    <div class="post-meta post-meta-top">
                                        <?php
                                            if ( $travelera_post_cat == '1' ) { ?>
                                                <span class="post-cats">
                                                    <?php
                                                        // Categories
                                                        $categories = get_the_category();
                                                        $separator = ' ';
                                                        $output = '';
                                                        if( $categories ) {
                                                            echo '<span class="screen-reader-text">'.esc_html__('Posted in','travelera-lite').'</span>';
                                                            foreach( $categories as $category ) {
                                                                $output .= '<span>'.$category->cat_name.'</span>'.$separator;
                                                            }
                                                        echo trim( $output, $separator );
                                                        }
                                                    ?>
                                                </span>
                                        <?php } ?>
                                    </div><!--.post-meta-->
                                    <?php
                                }
                            ?>
                            <header>
                                <h2 class="title f-title">
                                    <?php the_title(); ?>
                                </h2>
                            </header><!--.header-->
                            <?php if( travelera_theme_mod('post_author') == '1' ) { ?>
                                <span class="post-author post-meta">
                                    <?php esc_html_e('By','travelera-lite'); ?> <?php the_author(); ?>
                                </span>
                            <?php } ?>
                            <div class="read-more uppercase">
                                <span class="plane-left">
                                    <span class="plane-right">
                                        <?php esc_html_e('Read More','travelera-lite'); ?>
                                    </span>
                                </span>
                            </div>
                        </div><!--.slider-inner-->
                    </div><!--.post-inner-->
                </a>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            endif;
            ?>
        </div><!--.carousel-->
    </div><!--.container-->
</div><!--.featuredslider-->