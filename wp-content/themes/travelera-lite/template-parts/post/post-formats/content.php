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