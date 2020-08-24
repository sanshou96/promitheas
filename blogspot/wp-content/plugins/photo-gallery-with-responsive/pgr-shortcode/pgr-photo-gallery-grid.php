<?php
/**
 * 'pgr_grid' Shortcode
 * 
 * @package photo gallery with responsive
 * @since 1.0.0
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
function pgr_gallery_grid( $atts, $content = null ) {
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'id'				=> array(),
		'cell'    			=> '3',
		'template' 			=> 'template-1',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'link_target'		=> 'same-tab',
		'image_height'	=> '',
		'show_title'		=> 'true',
		'show_description'	=> 'false',
		'show_caption'		=> 'true',
		'image_size'		=> 'full',
		'popup'				=> 'true',
		), $atts));
	$shortcode_template 	= pgr_templates();
	$post_ids			= !empty($id)						? explode(',', $id) 				: array();
	$cell 				= (!empty($cell) && $cell <= 12) 	? $cell 							: '3';
	$template 			= ($template && (array_key_exists(trim($template), $shortcode_template))) ? trim($template) : 'template-1';
	$link_target 		= ($link_target == 'new-tab') 		? '_blank' 							: '_self';
	$image_height		= !empty($image_height)			? $image_height 					: '';
	$show_title			= ($show_title == 'true')			? 'true'							: 'false';
	$show_description	= ($show_description == 'true')		? 'true'							: 'false';
	$show_caption		= ($show_caption == 'false')		? 'false'							: 'true';
	$popup				= ($popup == 'false')				? 'false'							: 'true';
	$image_size 		= !empty($image_size)				? $image_size						: $image_size;
	$height_css 		= '';
	// Height
	if( $image_height == 'auto' ) {
		$height_css = "height:auto;";
	} elseif ( !empty($image_height) ) {
		$height_css = "height:{$image_height}px;";
	}
	// If no id is passed then return
	if( empty($post_ids) ) {
		return $content;
	}
	// Enqueue required script
	if( $popup == 'true' ) {
		wp_enqueue_script('wpoh-magnific-js');
		wp_enqueue_script('pgr-custom-js');
	}
	// Shortcode file
	$template_file_path 	= PGR_DIR . '/pgr-templates/template-1.php';
	$template_file 		= (file_exists($template_file_path)) ? $template_file_path : '';	
	// Taking some global
	global $post;
	// Taking some variables
	$prefix 		= PGR_META_PREFIX;
	$unique			= pgr_get_unique();
	$loop_count		= 1;
	$popup_cls 		= ($popup == 'true') ? 'pgr-popup-gallery' 	: '';
	$main_cls 		= "pgr-cnt-wrp pgr-col-{$cell} pgr-columns";	
	// WP Query Parameters
	$args = array (
		'post_type'     	 	=> PGR_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'post__in'		 		=> $post_ids,
		'ignore_sticky_posts'	=> true,
	);
	// WP Query Parameters
	$query = new WP_Query($args);
 //print_r($query);
	ob_start();
	// If post is there
	if ( $query->have_posts() ) { ?>
		<div class="pgr-gallery pgr-gallery-outter pgr-gallery-cell pgr-div-clear pgr-<?php echo $template.' '.$popup_cls; ?>" id="pgr-gallery-<?php echo $unique; ?>">
		<?php  while ( $query->have_posts() ) : $query->the_post();
			 $gallery_imgs = get_post_meta( $post->ID, $prefix.'gallery_imgs', true );
				if( !empty($gallery_imgs) ) {
					foreach ($gallery_imgs as $img_key => $img_data) {
						$gallery_post		= get_post( $img_data );
						$wrpper_cls			= ($loop_count == 1) ? $main_cls.' pgr-one' : $main_cls;
						$gallery_img_src 	= pgr_get_image_src( $img_data, $image_size );
						$image_alt_text		= get_post_meta( $img_data, '_wp_attachment_image_alt', true );
						if( $popup == 'true' ) {
							$image_link	= pgr_get_image_src( $img_data, 'full' );
						} else {
							$image_link = get_post_meta( $img_data, $prefix.'attachment_link', true );
						}
						// Include shortcode html file
						if( $gallery_post && $template_file && $gallery_img_src ) {
							include( $template_file );
							$loop_count++; // Increment loop count
							// Reset loop count
							if( $loop_count == $cell ){
								$loop_count = 0;
							}
						}
					} // End of for each
				}
		endwhile;
		?>
		</div><!-- end .pgr-gallery-outter -->
	<?php }
	wp_reset_query(); // Reset WP Query
	$content .= ob_get_clean();
	return $content;
}
// 'pgr-gallery' shortcode
add_shortcode('pgr_grid', 'pgr_gallery_grid');