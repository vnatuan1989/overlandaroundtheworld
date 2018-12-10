<div class="read-more">
    <?php
        $travelera_read_more_text_reader = sprintf( wp_kses(__( '%1$s<span class="screen-reader-text"> about %2$s</span>', 'travelera-lite' ), array( 'span' => array( 'class' => array() ) ) ), esc_html__('Read More','travelera-lite'), get_the_title() );
    ?>
    <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="plane-right" rel="bookmark">
        <?php echo $travelera_read_more_text_reader; ?>
    </a>
</div>
<div class="post-footer post-meta clearfix">
    <?php if ( travelera_theme_mod( 'post_avtar' ) ) { ?>
        <div class="post-avtar">
            <?php echo get_avatar( get_the_author_meta('email'), '32' ); ?>
        </div>
    <?php } ?>
    <div class="post-author-date">
        <?php if ( travelera_theme_mod( 'post_author' ) ) { ?>
            <span class="post-author"><span><span class="screen-reader-text"><?php esc_html_e('Posted','travelera-lite'); ?></span> <?php esc_html_e('By','travelera-lite'); ?></span><?php echo '&nbsp;'; the_author_posts_link(); ?></span>
        <?php }

        if ( travelera_theme_mod( 'post_date' ) ) {
            $travelera_time_string = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
                esc_attr( get_the_date( 'c' ) ),
                get_the_date()
            );

            printf( '<span class="post-date"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
                _x( 'Posted on', 'Used before publish date.', 'travelera-lite' ),
                esc_url( get_permalink() ),
                $travelera_time_string
            );
        }
        ?>
    </div>
    <?php
        if ( travelera_theme_mod( 'post_comments' ) ) { ?>
            <span class="post-comments">
                <?php comments_popup_link( '0', '1', '%', 'comments-link', esc_html__( 'Comments are off', 'travelera-lite' )); ?>
            </span>
        <?php }
    ?>
</div><!--.post-footer-->