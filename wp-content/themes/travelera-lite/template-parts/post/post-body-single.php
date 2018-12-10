<article <?php post_class(); ?>>
	<div id="post-<?php the_ID(); ?>" class="post-box">
        <?php
            // Post Header
            get_template_part('template-parts/post/post-header-single');
        
            if ( has_post_thumbnail() ) { ?>
                <div class="featured-single clearfix">
                    <?php the_post_thumbnail( 'travelera-featured' ); ?>
                </div>
                <?php
            }

            get_template_part('template-parts/post/post-meta-single');
        
            get_template_part('template-parts/post/single-content');
        ?>
    </div>
</article>