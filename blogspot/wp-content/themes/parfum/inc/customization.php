<?php
/**
 * This file adds custom CSS (Customizer options).
 *
 * @package Parfum
 */

add_action( 'wp_enqueue_scripts', 'parfum_customization', 11 );
/**
 * Output CSS (Customizer options).
 *
 * @since 1.0.0
 */
function parfum_customization() {

	$color          = esc_html( get_theme_mod( 'parfum_theme_color', '#0199DB' ) );
	$color_contrast = parfum_color_contrast( $color );
	$font_opt       = esc_html( get_theme_mod( 'parfum_fonts', 'Arimo' ) );

	$font = "body.custom-font-enabled {font-family: '$font_opt', Arial, Verdana;}";

	$top_bar_color = get_theme_mod( 'parfum_top_bar_color', '#222222' );
	$top_bar_color_contrast = parfum_color_contrast( $top_bar_color, '#cacaca' );

	$menu_position = get_theme_mod( 'parfum_menu_position', 'inline_with_logo' ) === 'below_the_logo' ?
	'.site-header > .inner-wrap{
		max-width:100%;
	}
	.site-branding-wrapper,
	.main-navigation-wrapper{
		float:none;
		text-align:center;
		max-width:100%;
	}
	.site-branding-wrapper{
		margin-top:7px;
	}
	.main-navigation{
		margin-top:14px;
	}
	.main-navigation ul.nav-menu{
		text-align:center;
	}' : '';

	$color_widget_title = ( get_theme_mod( 'parfum_color_widget_title', 1 ) == 1 ) ?
	".widget-title-tab:after {border-bottom-color:$color;}" : '';

	$excerpt_title_color = ( get_theme_mod( 'parfum_color_excerpt_title', '' ) == 1 ) ?
	".entry-title a, entry-title a:visited {color:$color;}" : '';

	$thumbnail_rounded = ( get_theme_mod( 'parfum_thumbnail_rounded', '' ) == 1 ) ?
	'.wrapper-excerpt-thumbnail img {border-radius:50%;}' : '';

	$text_justify = ( get_theme_mod( 'parfum_text_justify', '' ) == 1 ) ?
	'.entry-content {text-align:justify;}' : '';

	$sidebar_position = ( get_theme_mod( 'parfum_sidebar_position', 'right' ) === 'left' ) ?
	'@media screen and (min-width: 960px) {
		.site-content {float:right;}
		.widget-area {float:left;}
	}' : '';

	$css = "$font
	$menu_position $color_widget_title $excerpt_title_color $thumbnail_rounded $text_justify $sidebar_position
	.site-header,
	.main-navigation .sub-menu,
	.comments-title {
		border-top-color:$color;
	}
	.top-bar {
		background-color:$top_bar_color;
		color:$top_bar_color_contrast;
	}
	.top-bar a,
	.top-bar .fa-search{
		color: $top_bar_color_contrast;
	}
	a,
	a:hover,
	a:focus,
	.main-navigation li a:hover,
	.site-header h1 a:hover,
	.social-icon-wrapper a:hover,
	.sub-title a:hover,
	.entry-title a:hover,
	.entry-meta a:hover,
	.site-content .nav-single a:hover,
	.comment-content a:visited,
	.comments-area article header a:hover,
	a.comment-reply-link:hover,
	a.comment-edit-link:hover,
	.widget-area .widget a:hover,
	footer[role='contentinfo'] a:hover {
		color: $color;
	}
	.theme-color,
	button,
	input[type='submit'],
	input[type='button'],
	input[type='reset'],
	.bypostauthor cite span,
	.wrapper-widget-area-footer .widget-title:after,
	.ir-arriba:hover,
	.currenttext,
	.paginacion a:hover,
	.sticky-excerpt-label,
	.sticky-excerpt-label-no-thumbnail,
	.read-more-link:hover  {
		background-color:$color;
		color:$color_contrast;
	}
	#wp-calendar a{
		font-weight:bold; color: $color;
	}
	.page-numbers.current,
	.page-numbers:not(.dots):hover,
	.widget-area .widget a.tag-cloud-link:hover,
	.wrapper-widget-area-footer .tag-cloud-link:hover{
		background-color: $color;
		color: $color_contrast !important;
	}
	/* Gutenberg */
	.has-theme-color-color,
	.has-parfum-theme-color-color,
	a.has-theme-color-color:hover,
	a.has-parfum-theme-color-color:hover {
		color: $color;
	}
	.has-theme-color-background-color,
	.has-parfum-theme-color-background-color {
		background-color: $color;
	}";

	wp_add_inline_style( 'parfum-style', $css );

}
