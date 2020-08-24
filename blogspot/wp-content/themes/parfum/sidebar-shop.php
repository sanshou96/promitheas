<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package Parfum
 */

if ( is_active_sidebar( 'parfum-sidebar-shop' ) ) {
	?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'parfum-sidebar-shop' ); ?>
	</div><!-- #secondary -->
	<?php
}
