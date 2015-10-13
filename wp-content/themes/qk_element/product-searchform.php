<div class="search-widget">
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
        <input type="search" class="form-control field-search" name="s" placeholder="<?php esc_attr_e( 'Search: ', 'element' ); ?>" />
		<input type="hidden" name="post_type" value="product" />
    </form>
</div>