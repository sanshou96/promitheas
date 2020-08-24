<?php
defined( 'ABSPATH' ) || exit;
/**
 * Admin Other Page
 *
 * @package YAHMAN Add-ons
 */
function yahman_addons_admin_other($option,$option_key,$option_checkbox){
	foreach ($option_key['other'] as $key => $value  ) {
		$other[$key] = $option['other'][$key];
	}
	foreach ($option_checkbox['other'] as $key => $value  ) {
		$other[$key] = isset($option['other'][$key]) ? true: false;
	}
	?>

	<div id="ya_other_content" class="tab_content dn fi15">
		<h3><?php esc_html_e('Other','yahman-add-ons'); ?></h3>

		<table class="form-table">


			<tr valign="top">
				<th scope="row"><label for="other_no_image"><?php esc_html_e('No thumbnail','yahman-add-ons'); ?></label><br />
					<label for="other_no_image"><?php esc_html_e('YAHMAN Add-ons use this image when no thumbnail as necessary.','yahman-add-ons'); ?></label>
				</th>
				<td>

					<div class="other_no_image" style="width: 100%; max-width:320px; height:auto;">
						<div class="other_no_image_id_placeholder" style="width: 100%; position: relative; text-align: center; cursor: default;border: 1px dashed #b4b9be;box-sizing: border-box;padding: 9px 0;line-height: 20px; margin: 10px 0;<?php if( !empty( $other['no_image'] ) ){echo 'display:none;';} ?>"><?php esc_html_e( 'No image selected', 'yahman-add-ons' ); ?></div>
						<img class="other_no_image_id_media_image custom_media_image" src="<?php if( !empty( $other['no_image'] ) ){echo esc_url($other['no_image']);} ?>" style="width: 100%; max-width: 180px; height:auto; margin-bottom: 10px;" />

					</div>
					<input type="hidden" type="text" class="other_no_image_id_media_id custom_media_id" name="yahman_addons[other][no_image_id]" id="other_no_image_id" value="<?php echo esc_attr($other['no_image_id']); ?>" />

					<input type="hidden" type="text" class="other_no_image_id_media_url custom_media_url" name="yahman_addons[other][no_image]" id="other_no_image_url" value="<?php echo esc_url($other['no_image']); ?>" >
					<input type="button" value="<?php esc_html_e( 'Clear Image', 'yahman-add-ons' ); ?>" class="button other_no_image_id_remove-button custom_media_clear" id="other_no_image_id" style="<?php if( !empty( $other['no_image'] ) ){echo 'display:inline-block;';}else{echo 'display:none;';} ?>" />
					<input type="button" value="<?php esc_html_e( 'Select Image', 'yahman-add-ons' ); ?>" class="button upload-button custom_media_upload" id="other_no_image_id"/>

				</td>
			</tr>



			<tr valign="top">
				<th scope="row">
					<label for="other_user_timing_api"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
					<label for="other_user_timing_api"><?php echo esc_html__('User Timing API', 'yahman-add-ons'); ?></label>
				</th>
				<td><input name="yahman_addons[other][user_timing_api]" type="checkbox" id="other_user_timing_api"<?php checked(true, $other['user_timing_api']); ?> class="ya_checkbox" /></td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="other_delete_all"><?php esc_html_e('Enable','yahman-add-ons'); ?></label><br />
					<label for="other_delete_all"><?php echo esc_html__('Delete all data for YAHMAN Add-ons when uninstall', 'yahman-add-ons'); ?></label>
				</th>
				<td><input name="yahman_addons[other][delete_all]" type="checkbox" id="other_delete_all"<?php checked(true, $other['delete_all']); ?> class="ya_checkbox" /></td>
			</tr>


		</table>

	</div>




	<?php
}
