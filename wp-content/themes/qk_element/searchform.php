<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Search Form Template
 *
 */
?>
<?php global $textdomain; ?>
    <div class="search-widget">
    <form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="search">
        <input type="search" class="field-search" name="s" placeholder="<?php esc_attr_e( 'Search...', $textdomain ); ?>" />
		<input type="hidden" name="post_type" value="post" />
    </form>    
	</div>