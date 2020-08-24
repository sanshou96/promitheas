<?php
/**
 * Parfum Customizer.
 *
 * @package Parfum
 */

// Enqueue Javascript postMessage handlers for the Customizer.
add_action( 'customize_preview_init', 'parfum_customize_preview_js' );
function parfum_customize_preview_js() {
	wp_enqueue_script( 'parfum-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}

/**
 * Sanitize functions.
 */

function parfum_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

function parfum_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return 1;
	} else {
		return '';
	}
}

function parfum_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function parfum_sanitize_fonts( $input ) {
	$valid = array(
		'Arimo'     => 'Arimo',
		'Bitter'    => 'Bitter',
		'Open Sans' => 'Open Sans',
		'Poppins'   => 'Poppins',
		'Raleway'   => 'Raleway',
		'Ubuntu'    => 'Ubuntu',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/** -------------------------------
 * PARFUM CUSTOMIZER
**------------------------------*/

add_action( 'customize_register', 'parfum_theme_customizer' );

function parfum_theme_customizer( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	class Parfum_Customize_Heading_Control extends WP_Customize_Control {

		public $type  = 'heading_1';
		public $color = 'blue';

		public function render_content() {

			if ( ! empty( $this->label ) ) {
				if ( $this->type == 'heading_1' ) {

					echo '<h3 class="parfum-heading-1-' . esc_attr( $this->color ) . '">' . esc_html( $this->label ) . '<h3>';

				} elseif ( $this->type == 'heading_2' ) { ?>

					<h3 class="parfum-heading-2">
						<?php echo esc_html( $this->label ); ?>
					</h3>
				<?php
				}
			}

			if ( ! empty( $this->description ) ) {
				?>
				<p class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></p>
				<?php
			}

		} // render_content.

	} // Class Parfum_Customize_Heading_Control.

	class Parfum_Text_Control extends WP_Customize_Control {

		public $control_text = '';

		public function render_content() {

			if ( ! empty( $this->label ) ) {
				?>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
				</span>
				<?php
			}

			if ( ! empty( $this->description ) ) {
				?>
				<span class="customize-control-description">
					<?php echo wp_kses_post( $this->description ); ?>
				</span>
				<?php
			}

			if ( ! empty( $this->control_text ) ) {
				?>
				<span class="parfum-text-control-content">
					<?php echo wp_kses_post( $this->control_text ); ?>
				</span>
				<?php
			}

		}

	}

	/**
	 * GENERAL SETTINGS PANEL
	 * Sections: Site indentity, Colors, Fonts, Background image.
	 */

	$wp_customize->add_panel( 'parfum_panel_general_settings',
		array(
			'title'    => __( 'General Settings', 'parfum' ),
			'priority' => 9,
		)
	);

	/**
	 * Static Front Page
	 */
	$wp_customize->get_section( 'static_front_page' )->panel    = 'parfum_panel_general_settings';
	$wp_customize->get_section( 'static_front_page' )->priority = 1;

	/**
	 * Site Logo/Icon/Title/Tagline
	 */

	$wp_customize->get_section( 'title_tagline' )->panel    = 'parfum_panel_general_settings';
	$wp_customize->get_section( 'title_tagline' )->title    = __( 'Site Logo/Icon/Title/Tagline', 'parfum' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;

	/**
	 * Colors
	 */

	$wp_customize->get_section( 'colors' )->panel    = 'parfum_panel_general_settings';
	$wp_customize->get_section( 'colors' )->priority = 11;

	/**
	 * Header image
	 */

	$wp_customize->get_section( 'header_image' )->panel    = 'parfum_panel_header';
	$wp_customize->get_section( 'header_image' )->priority = 13;

	$header_image_description = $wp_customize->get_section( 'header_image' )->description;
	$add_description          = ' <strong>' . __( 'The header image is displayed below the logo and menu.', 'parfum' ) . '</strong>';
	$wp_customize->get_section( 'header_image' )->description = $header_image_description . $add_description;

	/**
	 * Background image
	 */

	$wp_customize->get_section( 'background_image' )->panel    = 'parfum_panel_general_settings';
	$wp_customize->get_section( 'background_image' )->priority = 14;

	// Theme color.
	$wp_customize->add_setting( 'parfum_theme_color', array(
		'default'           => '#0199DB',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_theme_color',
			array(
				'label'    => __( 'Theme Primary Color', 'parfum' ),
				'section'  => 'colors',
				'settings' => 'parfum_theme_color',
				'type'     => 'select',
				'priority' => 1,
				'choices'  => array(
					'#0199DB' => __( 'Blue', 'parfum' ),
					'#77AD0A' => __( 'Green', 'parfum' ),
					'#F17A07' => __( 'Orange', 'parfum' ),
					'#F882B3' => __( 'Pink', 'parfum' ),
					'#DD4040' => __( 'Red', 'parfum' ),
				),
			)
		)
	);

	// Color excerpt title.
	$wp_customize->add_setting( 'parfum_color_excerpt_title', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	) );
	$wp_customize->add_control('parfum_color_excerpt_title', array(
		'type'     => 'checkbox',
		'label'    => __( 'Apply to entry title in excerpts', 'parfum' ),
		'section'  => 'colors',
		'priority' => 2,
	));

	// Widgets title color.
	$wp_customize->add_setting( 'parfum_color_widget_title', array(
		'default'           => 1,
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_color_widget_title', array(
		'type'        => 'checkbox',
		'label'       => __( 'Apply to widget title (border-bottom)', 'parfum' ),
		'section'     => 'colors',
		'description' => __( '( Uncheck: Black )', 'parfum' ),
		'priority'    => 3,
	));

	/**
	 * Fonts
	 */

	$wp_customize->add_section('parfum_fonts', array(
		'panel'    => 'parfum_panel_general_settings',
		'title'    => __( 'Fonts', 'parfum' ),
		'priority' => 12,
	));
	$wp_customize->add_setting( 'parfum_fonts', array(
		'default'           => 'Arimo',
		'sanitize_callback' => 'parfum_sanitize_fonts',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_fonts',
			array(
				'label'    => __( 'Select font', 'parfum' ),
				'section'  => 'parfum_fonts',
				'settings' => 'parfum_fonts',
				'type'     => 'select',
				'choices'  => array(
					'Arimo'     => 'Arimo',
					'Bitter'    => 'Bitter',
					'Open Sans' => 'Open Sans',
					'Poppins'   => 'Poppins',
					'Raleway'   => 'Raleway',
					'Ubuntu'    => 'Ubuntu',
				),
			)
		)
	);

	/**
	 * PANEL: HEADER
	 * Sections: Top bar, Header image
	 */

	$wp_customize->add_panel( 'parfum_panel_header', array(
		'title'    => __( 'Header', 'parfum' ),
		'priority' => 10,
	));

	/**
	 * Top bar
	 */

	$wp_customize->add_section('parfum_top_bar', array(
		'panel'    => 'parfum_panel_header',
		'title'    => __( 'Top bar', 'parfum' ),
		'priority' => 10,
	));

	// Display top bar.
	$wp_customize->add_setting('parfum_display_top_bar', array(
		'default'           => 1,
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_display_top_bar', array(
		'type'    => 'checkbox',
		'label'   => __( 'Display top bar', 'parfum' ),
		'section' => 'parfum_top_bar',
	));

	// Top bar color.
	$wp_customize->add_setting( 'parfum_top_bar_color', array(
		'default'           => '#222222',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_top_bar_color',
			array(
				'label'    => __( 'Top bar color', 'parfum' ),
				'section'  => 'parfum_top_bar',
				'settings' => 'parfum_top_bar_color',
				'type'     => 'select',
				'choices'  => array(
					'#ffffff' => _x( 'White', 'Top bar color', 'parfum' ),
					'#222222' => __( 'Black', 'parfum' ),
				),
			)
		)
	);

	// Custom text.
	$wp_customize->add_setting( 'parfum_top_bar_left_custom_text', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control('parfum_top_bar_left_custom_text', array(
		'type'    => 'textarea',
		'label'   => __( 'Left top bar custom text (HTML allowed)', 'parfum' ),
		'section' => 'parfum_top_bar',
	));

	$wp_customize->add_setting('parfum_social_icons_color', array(
		'default'           => 'gray',
		'sanitize_callback' => 'parfum_sanitize_select',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_social_icons_color',
			array(
				'label'    => __( 'Social icons color', 'parfum' ),
				'section'  => 'parfum_top_bar',
				'settings' => 'parfum_social_icons_color',
				'type'     => 'select',
				'choices'  => array(
					'gray'           => _x( 'Gray', 'Social icons color', 'parfum' ),
					'original_color' => __( 'Original color', 'parfum' ),
				),
			)
		)
	);

	// Word MENU.
	$wp_customize->add_setting( 'parfum_mostrar_menu_junto_icono', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_mostrar_menu_junto_icono', array(
		'type'    => 'checkbox',
		'label'   => __( 'Show the word menu next to the icon menu on mobile devices.', 'parfum' ),
		'section' => 'parfum_top_bar',
	));

	/**
	 * Main menu
	 */

	$wp_customize->add_section('parfum_menu', array(
		'panel'    => 'parfum_panel_header',
		'title'    => __( 'Main menu', 'parfum' ),
		'priority' => 10,
	));

	// Menu position.
	$wp_customize->add_setting('parfum_menu_position', array(
		'default'           => 'inline_whith_logo',
		'sanitize_callback' => 'parfum_sanitize_select',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_menu_position',
			array(
				'label'       => __( 'Menu position', 'parfum' ),
				'section'     => 'parfum_menu',
				'settings'    => 'parfum_menu_position',
				'type'        => 'select',
				'description' => __( "'below the logo' option displays logo and menu centered", 'parfum' ),
				'choices'  => array(
					'inline_whith_logo' => __( 'Inline with logo', 'parfum' ),
					'below_the_logo'    => __( 'Below the logo', 'parfum' ),
				),
			)
		)
	);

	/**
	 * PANEL: CONTENT
	 * Sections: Posts and pages, Sidebar
	 */

	$wp_customize->add_panel( 'parfum_panel_content', array(
		'title'    => __( 'Content', 'parfum' ),
		'priority' => 10,
	));

	/**
	 * Posts
	 */

	$wp_customize->add_section('parfum_posts_and_pages', array(
		'panel' => 'parfum_panel_content',
		'title' => __( 'Posts and Pages', 'parfum' ),
	));

	$wp_customize->add_setting('parfum_full_content_homepage_and_archive', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_full_content_homepage_and_archive', array(
		'type'    => 'checkbox',
		'label'   => __( 'Show full content on homepage and archive pages.', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	// Featured image in post.
	$wp_customize->add_setting('parfum_featured_image_in_post', array(
		'default'           => 'after_post_title',
		'sanitize_callback' => 'parfum_sanitize_select',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_featured_image_in_post',
			array(
				'label'    => __( 'Show featured image in posts', 'parfum' ),
				'section'  => 'parfum_posts_and_pages',
				'settings' => 'parfum_featured_image_in_post',
				'type'     => 'select',
				'choices'  => array(
					'not_show'         => __( 'Not show', 'parfum' ),
					'after_post_title' => __( 'After post title', 'parfum' ),
					'before_post_title' => __( 'Before post title', 'parfum' ),
				),
			)
		)
	);

	$wp_customize->add_setting('parfum_thumbnail_rounded', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_thumbnail_rounded', array(
		'type'    => 'checkbox',
		'label'   => __( "Excerpt's thumbnail image rounded", 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	$wp_customize->add_setting( 'parfum_show_meta_in_excerpts', array(
		'default'           => 1,
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_show_meta_in_excerpts', array(
		'type'    => 'checkbox',
		'label'   => __( 'Show metadata in excerpts (Author, date and number of comments)', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	$wp_customize->add_setting('parfum_text_justify', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_text_justify', array(
		'type'    => 'checkbox',
		'label'   => __( 'Entry text justified', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	$wp_customize->add_setting( 'parfum_related_posts', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_related_posts', array(
		'type'    => 'checkbox',
		'label'   => __( 'Display related posts at the end of entries (based on tags)', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	$wp_customize->add_setting( 'parfum_related_posts_title', array(
		'default'           => __( 'Related posts...', 'parfum' ),
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control('parfum_related_posts_title', array(
		'label'   => __( 'Related posts title', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
		'type'    => 'text',
	));

	$wp_customize->add_setting('parfum_sticky_post_label', array(
		'default'           => __( 'Featured', 'parfum' ),
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control('parfum_sticky_post_label', array(
		'label'   => __( 'Label for Sticky Posts', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
		'type'    => 'text',
	));

	$wp_customize->add_setting('parfum_show_nav_single', array(
		'default'           => 1,
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_show_nav_single', array(
		'type'    => 'checkbox',
		'label'   => __( 'Show navigation at the end of posts (links to previous and next posts)', 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	$wp_customize->add_setting('parfum_back_to_top_button', array(
		'default'           => 1,
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_back_to_top_button', array(
		'type'    => 'checkbox',
		'label'   => __( "Display 'Back to top' button", 'parfum' ),
		'section' => 'parfum_posts_and_pages',
	));

	/**
	 * Sidebar
	 */

	$wp_customize->add_section('parfum_sidebar', array(
		'panel' => 'parfum_panel_content',
		'title' => __( 'Sidebar', 'parfum' ),
	));

	// Sidebar.
	$wp_customize->add_setting('parfum_sidebar_position', array(
		'default'           => 'right',
		'sanitize_callback' => 'parfum_sanitize_select',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'parfum_sidebar_position',
			array(
				'label'    => __( 'Select sidebar position', 'parfum' ),
				'section'  => 'parfum_sidebar',
				'settings' => 'parfum_sidebar_position',
				'type'     => 'radio',
				'choices'  => array(
					'right'      => __( 'Right', 'parfum' ),
					'left'       => __( 'Left', 'parfum' ),
				),
			)
		)
	);

	/**
	 * PANEL: FOOTER
	 * Sections: Footer texts
	 */

	$wp_customize->add_panel( 'parfum_panel_footer', array(
		'title'    => __( 'Footer', 'parfum' ),
		'priority' => 10,
	));
	/**
	 * Footer texts
	 */
	$wp_customize->add_section('parfum_footer_texts', array(
		'panel' => 'parfum_panel_footer',
		'title' => __( 'Footer texts', 'parfum' ),
	));

	$wp_customize->add_setting('parfum_footer_text_1', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control('parfum_footer_text_1', array(
		'label'   => __( 'Footer text 1', 'parfum' ),
		'section' => 'parfum_footer_texts',
		'type'    => 'textarea',
	));

	$wp_customize->add_setting('parfum_footer_text_2', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control('parfum_footer_text_2', array(
		'label'   => __( 'Footer text 2', 'parfum' ),
		'section' => 'parfum_footer_texts',
		'type'    => 'textarea',
	));

	$wp_customize->add_setting('parfum_footer_text_3', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control('parfum_footer_text_3', array(
		'label'   => __( 'Footer text 3', 'parfum' ),
		'section' => 'parfum_footer_texts',
		'type'    => 'textarea',
	));

	$wp_customize->add_setting('parfum_hide_credits', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_checkbox',
	));
	$wp_customize->add_control('parfum_hide_credits', array(
		'type'    => 'checkbox',
		'label'   => __( 'Hide credits', 'parfum' ),
		'section' => 'parfum_footer_texts',
	));

	/*
	* Firts Steps and links
	*/

	$wp_customize->add_section( 'parfum_first_steps_links', array(
		'title'    => __( 'First Steps and Links', 'parfum' ),
		'priority' => 1,
	));

	/* Links */
	$wp_customize->add_setting( 'parfum_heading_first_step_links', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control( new Parfum_Customize_Heading_Control(
		$wp_customize,
		'parfum_heading_first_step_links',
		array(
			'type'     => 'heading_1',
			'settings' => 'parfum_heading_first_step_links',
			'section'  => 'parfum_first_steps_links',
			'label'    => __( 'Links', 'parfum' ),
		)
	));

	// Rate/Review.
	$wp_customize->add_setting( 'parfum_rate_button', array( 'sanitize_callback' => 'parfum_sanitize_text' ) );
	$wp_customize->add_control( new Parfum_Text_Control(
		$wp_customize,
		'parfum_rate_button',
		array(
			'settings'     => 'parfum_rate_button',
			'section'      => 'parfum_first_steps_links',
			'control_text' => __( 'Please, if you are happy with the theme, say it on wordpress.org and give Parfum a nice review. Thank you', 'parfum' ) . '<a class="gt-customizer-link-button" href="https://wordpress.org/support/theme/parfum/reviews/#new-post" target="_blank">' . __( 'Rate/Review', 'parfum' ) . '</a>',
		)
	));

	// Live demo.
	$wp_customize->add_setting( 'parfum_link_buttons', array( 'sanitize_callback' => 'parfum_sanitize_text' ) );
	$wp_customize->add_control( new Parfum_Text_Control(
		$wp_customize,
		'parfum_link_buttons',
		array(
			'settings'     => 'parfum_link_buttons',
			'section'      => 'parfum_first_steps_links',
			'control_text' => '<a class="gt-customizer-link-button" href="http://demo.galussothemes.com/parfum/" target="_blank">' . __( 'Live Demo', 'parfum' ) . '</a>
			<a class="gt-customizer-link-button" href="https://galussothemes.com/wordpress-themes/parfum-pro/" target="_blank">' . __( 'Pro Version', 'parfum' ) . '</a>',
		)
	));

	/* First steps */
	$wp_customize->add_setting('parfum_heading_first_step', array(
		'default'           => '',
		'sanitize_callback' => 'parfum_sanitize_text',
	));
	$wp_customize->add_control( new Parfum_Customize_Heading_Control(
		$wp_customize,
		'parfum_heading_first_step',
		array(
			'type'     => 'heading_1',
			'settings' => 'parfum_heading_first_step',
			'section'  => 'parfum_first_steps_links',
			'label'    => __( 'First Steps', 'parfum' ),
		)
	));

	$wp_customize->add_setting( 'parfum_first_steps', array( 'sanitize_callback' => 'parfum_sanitize_text' ) );
	$wp_customize->add_control( new Parfum_Text_Control(
		$wp_customize,
		'parfum_first_steps',
		array(
			'settings'     => 'parfum_first_steps',
			'section'      => 'parfum_first_steps_links',
			//'label'        => __( 'Images are not displayed correctly', 'parfum' ),
			'control_text' => __( '&bull; <strong>Images are not displayed correctly</strong><p><strong>In order for images to be displayed correctly, featured images must have a minimum size of 576x432 pixels.</strong>.</p><p>If the image thumbnails are not displayed correctly (because Parfum is not the first theme used) you will need to regenerate the thumbnails with a free plugin as', 'parfum' ) . ' <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a></p>' . __( '&bull; <strong>Use Page Builders</strong><p>To design pages with a Page Builder, use the page template "GT Page Builder"</p>', 'parfum' ),
		)
	));

	// Extend customizer.
	do_action( 'parfum_customize_register', $wp_customize );

}
