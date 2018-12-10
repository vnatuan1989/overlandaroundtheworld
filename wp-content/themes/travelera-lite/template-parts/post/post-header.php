<header>
    <?php
        if ( travelera_theme_mod( 'post_cats' ) ) {
            ?>
            <div class="post-meta post-meta-top">
                <span class="post-cats">
                    <?php
                        // Categories
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if( $categories ) {
                            echo '<span class="screen-reader-text">'.esc_html__('Posted in','travelera-lite').'</span>';
                            foreach( $categories as $category ) {
                                $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s','travelera-lite' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                            }
                        echo trim( $output, $separator );
                        }
                    ?>
                </span>
            </div><!--.post-meta-->
            <?php
        }
    ?>

    <h2 class="title entry-title">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h2>
</header><!--.header-->