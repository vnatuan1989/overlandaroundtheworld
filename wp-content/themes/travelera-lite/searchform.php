<form method="get" class="searchform search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<fieldset> 
        <label>
            <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'travelera-lite' ); ?></span>
            <input type="text" name="s" class="s" value="" placeholder="<?php esc_attr_e('Search Now','travelera-lite'); ?>"> 
        </label>
		<button class="fa fa-search search-button" type="submit" value="<?php esc_attr_e('Search','travelera-lite'); ?>">
            <span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'travelera-lite' ); ?></span>
        </button>
	</fieldset>
</form>