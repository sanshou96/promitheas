<?php
/**
 *
 * @package Simple Days
 */


function yahman_addons_carousel_slider_amp( $settings , $latest_posts ){

	
	require_once YAHMAN_ADDONS_DIR . 'inc/get_thumbnail.php';
	?>

	<amp-carousel id="carousel-with-carousel-preview_<?php echo $settings['widget_id_num']; ?>"
		width="400"
		height="200"
		layout="responsive"
		type="slides">
		<?php
		while( $latest_posts->have_posts() ) : $latest_posts->the_post();
			global $post;
			$thumurl = yahman_addons_get_thumbnail( $post->ID , $settings['image_size']);

			$this_url = get_permalink();


			?>


			<div class="slide relative">
				<a href="<?php echo esc_url($this_url); ?>" class="non_hover tap_no db w100 h100 absolute z1"></a>
				<div class="fit_box_img_wrap relative">
					<amp-img src="<?php echo esc_url( $thumurl[0] ); ?>"
						width="<?php echo esc_attr($thumurl[1]); ?>"
						height="<?php echo esc_attr($thumurl[2]); ?>"

						alt="<?php echo esc_attr($post ->post_title); ?>">
					</amp-img>
				</div>
				<div class="slider_info hp_p b_mask absolute z1 bottom0 left0 w100 bc_shadow">
					<div class="slider_category fsS dn100">
						<?php
						$category = get_the_category();
						if(!empty($category)){
							echo '<a href="' . esc_url(get_category_link( $category[0]->term_id )) . '" class="fsS fc_fff non_hover">' . esc_html($category[0]->cat_name) . '</a>';
						}
						?>
					</div>
					<div>
						<a href="<?php echo esc_url($this_url); ?>" rel="bookmark" class="slider_title_a">
							<h3 class="slider_title hp_p fc_fff" style="margin:0;color:#fff;"><?php the_title(); ?></h3>
						</a>
					</div>
					<div class='slider_date hp_p dn100 fsS fc_fff'>
						<?php echo get_the_date(); ?>
					</div>
				</div>
			</div>


			<?php
		endwhile;
		$latest_posts->rewind_posts();
		$i = 0;
		?>
	</amp-carousel>
	<?php
	if($settings['thumbnail']):
		?>
		<amp-carousel class="carousel-preview"
		width="auto"
		height="48"
		layout="fixed-height"
		type="carousel">
		<?php
		while( $latest_posts->have_posts() ) : $latest_posts->the_post();
			global $post;
			$thumurl = yahman_addons_get_thumbnail( $post->ID , 'thumbnail' , $post);
			?>
			<button on="tap:carousel-with-carousel-preview_<?php echo $settings['widget_id_num']; ?>.goToSlide(index=<?php echo esc_attr($i); ?>)">
				<amp-img src="<?php echo esc_url( $thumurl[0] ); ?>"
					width="60"
					height="40"
					alt="<?php echo esc_attr($post ->post_title); ?>">
				</amp-img>
			</button>
			<?php
			++$i;
		endwhile;
		?>
	</amp-carousel>
	<?php
endif;

}


