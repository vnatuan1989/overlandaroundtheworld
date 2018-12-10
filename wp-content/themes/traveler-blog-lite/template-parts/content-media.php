<?php
/**
 * Display an optional post thumbnail, video in according to post formats
 *
 * @package Traveler Blog Lite
 * @since 1.0 
 */

if ( has_post_thumbnail() ) { ?>           
               <div class="entry-media" >
                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail();  ?></a>
		  </div>
<?php }  ?>