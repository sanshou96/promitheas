<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Faster Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_faster($option,$option_key,$option_checkbox){

	foreach ($option_key['faster'] as $key => $value  ) {
		$faster[$key] = $option['faster'][$key];
	}

	foreach ($option_checkbox['faster'] as $key => $value  ) {
		$faster[$key] = isset($option['faster'][$key]) ? true: false;
	}

	?>

	<div id="ya_faster_content" class="tab_content dn fi15">
		<h3><?php esc_html_e('Faster','yahman-add-ons'); ?></h3>

		<table class="form-table">


			<tr valign="top">
				<th scope="row">
					<label for="faster_remove_line_breaks"><?php echo esc_html__('Remove All Whitespace', 'yahman-add-ons'); ?></label>
				</th>
				<td><input name="yahman_addons[faster][remove_line_breaks]" type="checkbox" id="faster_remove_line_breaks"<?php checked(true, $faster['remove_line_breaks']); ?> class="ya_checkbox" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="faster_preconnect_url"><?php esc_html_e('Preconnect url','yahman-add-ons'); ?></label>
				</th>
				<td><textarea name="yahman_addons[faster][preconnect_url]" rows="4" cols="48" id="faster_preconnect_url" class="ya_textbox" /><?php echo $faster['preconnect_url']; ?></textarea>
					<p class="description"><?php esc_html_e('Multiple url must be seperated by a comma.','yahman-add-ons'); ?></p>
				</td>
			</tr>
		</table>

		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="faster_cache"><?php esc_html_e('Cache','yahman-add-ons'); ?></label></th>
				<td><input name="yahman_addons[faster][cache]" type="checkbox" id="faster_cache"<?php checked(true, $faster['cache']); ?> class="ya_checkbox" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><label for="faster_cache_period"><?php esc_html_e('Cache period','yahman-add-ons'); ?></label></th>
				<td>
					<select name="yahman_addons[faster][cache_period]" id="faster_cache_period">
						<option value="1"<?php selected( $faster['cache_period'], '1' ); ?>>1</option>
						<option value="2"<?php selected( $faster['cache_period'], '2' ); ?>>2</option>
						<option value="3"<?php selected( $faster['cache_period'], '3' ); ?>>3</option>
						<option value="4"<?php selected( $faster['cache_period'], '4' ); ?>>4</option>
						<option value="5"<?php selected( $faster['cache_period'], '5' ); ?>>5</option>
						<option value="6"<?php selected( $faster['cache_period'], '6' ); ?>>6</option>
						<option value="7"<?php selected( $faster['cache_period'], '7' ); ?>>7</option>
						<option value="14"<?php selected( $faster['cache_period'], '14' ); ?>>14</option>
						<option value="21"<?php selected( $faster['cache_period'], '21' ); ?>>21</option>
						<option value="28"<?php selected( $faster['cache_period'], '28' ); ?>>28</option>
						</select><?php esc_html_e('Days','yahman-add-ons'); ?>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><label for="faster_cache_delete"><?php esc_html_e('Cache all delete','yahman-add-ons'); ?></label></th>
					<td><input name="yahman_addons_reset[faster][cache]" type="checkbox" id="faster_cache_delete" class="ya_checkbox" /></td>
				</tr>

			</table>

			<h4><?php echo sprintf( esc_html__( 'Input post id then the post do not change to %s.', 'yahman-add-ons'), esc_html__( 'cache', 'yahman-add-ons') ); ?></h4>
			<p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

			<table class="form-table">

				<tr valign="top">
					<th scope="row">
						<label for="faster_cache_post_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
					</th>
					<td>
						<input name="yahman_addons[faster][cache_post_not_in]" type="text" id="faster_cache_post_not_in" value="<?php echo $faster['cache_post_not_in']; ?>" class="widefat" />
					</td>
				</tr>

			</table>

			<h4><?php echo sprintf( esc_html__( 'Input parent post id then child page do not change to %s.','yahman-add-ons'), esc_html__( 'cache', 'yahman-add-ons') ); ?></h4>
			<p class="description"><?php esc_html_e('Multiple id must be seperated by a comma.','yahman-add-ons'); ?></p>

			<table class="form-table">

				<tr valign="top">
					<th scope="row">
						<label for="faster_cache_parent_not_in"><?php echo esc_html_e('Post ID','yahman-add-ons'); ?></label>
					</th>
					<td>
						<input name="yahman_addons[faster][cache_parent_not_in]" type="text" id="faster_cache_parent_not_in" value="<?php echo $faster['cache_parent_not_in']; ?>" class="widefat" />
					</td>
				</tr>

			</table>


		</div>




		<?php
	}
