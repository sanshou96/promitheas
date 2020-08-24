<?php
/**
 * Display Top Bar
 *
 * @package Parfum
 */

?>
<div class="top-bar">
	<div class="inner-wrap">
		<div class="top-bar-inner-wrap">
			<?php
			$parfum_palabra_menu = ( get_theme_mod( 'parfum_mostrar_menu_junto_icono', '' ) == 1 ) ? ' ' . __( 'MENU', 'parfum' ) : '';
			?>

			<div class="boton-menu-movil">
				<i class="fa fa-align-justify"></i><?php echo esc_html( $parfum_palabra_menu ); ?>
			</div>

			<?php
			$parfum_top_bar_custom_text = get_theme_mod( 'parfum_top_bar_left_custom_text', '' );

			if ( ! empty( $parfum_top_bar_custom_text ) ) {
				?>
				<div class="top-bar-left">
					<?php echo wp_kses_post( $parfum_top_bar_custom_text ); ?>
				</div>
				<?php
			}
			?>

			<div class="toggle-search"><i class="fa fa-search"></i></div>

			<div class="top-bar-right">
				<div class="social-icon-wrapper">
					<?php
					if ( has_nav_menu( 'social-1' ) ) {
						$parfum_color_iconos = get_theme_mod( 'parfum_social_icons_color', 'white' ) == 'original_color' ? 'social-icons-original-color' : 'social-icons-unique-color';
						?>
						<nav class="social-navigation <?php echo $parfum_color_iconos; ?>" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'parfum' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social-1',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							) );
						?>
						</nav><!-- .social-navigation -->
						<?php
					}
					?>
				</div><!-- .social-icon-wrapper -->
			</div><!-- .top-bar-right -->

			<div class="wrapper-search-top-bar">
				<div class="search-top-bar">
					<?php get_template_part( PARFUM_TEMPLATE_PARTS . 'searchform-toggle' ); ?>
				</div>
			</div>

		</div><!-- .top-bar-inner-wrap -->
	</div><!-- .inner-wrap -->
</div><!-- .top-bar -->
