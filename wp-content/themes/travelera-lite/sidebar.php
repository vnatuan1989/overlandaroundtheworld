<aside class="sidebar" id="sidebar" itemscope itemtype="http://schema.org/WPSideBar">
    <?php
        if ( is_active_sidebar( 'sidebar-1' ) ) {
            dynamic_sidebar( 'sidebar-1' );
        }
    ?>
</aside>