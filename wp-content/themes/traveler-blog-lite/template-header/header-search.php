<?php
/**
 *  Traveler Blog Lite Header Search
 *
 * @package Traveler Blog Lite
 * @since 1.0
 */
    
$show_search = traveler_blog_lite_get_theme_mod( 'show_search' );           
?>   
 <div class="header-search floatright">
        <?php
            $data_traveler_blog_lite_str = '{"content":';
            $data_traveler_blog_lite_str .= '{"effect": "fadein", "fullscreen": true, "speedIn": 300, "speedOut": 300, "delay": 300},'; 
            $data_traveler_blog_lite_str .= '"loader":';    
            $data_traveler_blog_lite_str .= '{"active": true}';     
            $data_traveler_blog_lite_str .= '}';
        ?>
        <a class="traveler-blog-lite-link" href="javascript:void(0);" data-traveler-blog-lite-1='<?php echo esc_attr($data_traveler_blog_lite_str);?>'><i class="fa fa-search"></i></a>       
        <div id="traveler-blog-lite-modal-1" class="traveler-blog-lite-modal">
          <a href="javascript:void(0);" onclick="Custombox.modal.close();" class="traveler-blog-lite-close"><i class="fa fa-close"></i></a>      
            <div class="traveler-blog-lite-search-box">
                <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">                         
                    <input placeholder="<?php esc_html_e('Type search term and press enter', 'traveler-blog-lite'); ?>" type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                    <button type="submit" class="search-btn"><?php esc_html_e('Search', 'traveler-blog-lite'); ?></button>         
                </form><!-- end #searchform -->  
            </div>  
        </div>  
</div><!-- .header-search -->

        