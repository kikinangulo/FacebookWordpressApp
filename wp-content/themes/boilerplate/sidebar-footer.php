<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if(!is_active_sidebar( 'app_footer'  )){
		return;
	} else if ( is_active_sidebar( 'app_footer' ) ) {
		dynamic_sidebar( 'app_footer' );
	}
?>