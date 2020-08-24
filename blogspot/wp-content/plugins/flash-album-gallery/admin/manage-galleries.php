<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])){
    die('You are not allowed to call this page directly.');
}

// *** show main gallery list
function flag_manage_gallery_main(){

    global $flag, $flagdb, $wp_query;

    //Build the pagination for more than 25 galleries
    if( !isset($_GET['paged']) || $_GET['paged'] < 1){
        $_GET['paged'] = 1;
    }

    $sort_gall_by  = (isset($_GET['galsort']))? $_GET['galsort'] : 'gid';
    $sort_gall_dir = (isset($_GET['sortdir']))? $_GET['sortdir'] : 'DESC';
    $ascdesc       = ($sort_gall_dir == 'DESC')? 'ASC' : 'DESC';

    $_GET['paged'] = intval($_GET['paged']);
    $perpage       = intval($flag->options['albPerPage'])? intval($flag->options['albPerPage']) : 50;
    $start         = ($_GET['paged'] - 1) * $perpage;
    $gallerylist   = $flagdb->find_all_galleries($sort_gall_by, $sort_gall_dir, $counter = true, $perpage, $start, $exclude = false, $draft = true);

    $page_links = paginate_links(array(
                                     'base'      => add_query_arg('paged', '%#%'),
                                     'format'    => '',
                                     'prev_text' => __('&laquo;'),
                                     'next_text' => __('&raquo;'),
                                     'total'     => $flagdb->paged['max_objects_per_page'],
                                     'current'   => $_GET['paged'],
                                 )
    );

    ?>
    <script type="text/javascript">
        <!--
        function checkAll(form){
            for(i = 0, n = form.elements.length; i < n; i++){
                if(form.elements[i].type == "checkbox"){
                    if(form.elements[i].name == "doaction[]"){
                        if(form.elements[i].checked == true)
                            form.elements[i].checked = false;
                        else
                            form.elements[i].checked = true;
                    }
                }
            }
        }

        function getNumChecked(form){
            var num = 0;
            for(i = 0, n = form.elements.length; i < n; i++){
                if(form.elements[i].type == "checkbox"){
                    if(form.elements[i].name == "doaction[]")
                        if(form.elements[i].checked == true)
                            num++;
                }
            }
            return num;
        }

        // this function check for a the number of selected images, sumbmit false when no one selected
        function checkSelected(){

            var numchecked = getNumChecked(document.getElementById('editgalleries'));

            if(numchecked < 1){
                alert('<?php echo esc_js(__('No images selected', 'flash-album-gallery')); ?>');
                return false;
            }

            actionId = jQuery('#bulkaction').val();

            switch(actionId){
                case "resize_images":
                    showDialog('resize_images', 120);
                    return false;
                    break;
                case "new_thumbnail":
                    showDialog('new_thumbnail', 160);
                    return false;
                    break;
            }

            return confirm('<?php echo sprintf(esc_js(__("You are about to start the bulk edit for %s galleries \n \n 'Cancel' to stop, 'OK' to proceed.", 'flash-album-gallery')), "' + numchecked + '"); ?>');
        }

        function showDialog(windowId, height){
            var form = document.getElementById('editgalleries');
            var elementlist = "";
            for(i = 0, n = form.elements.length; i < n; i++){
                if(form.elements[i].type == "checkbox"){
                    if(form.elements[i].name == "doaction[]")
                        if(form.elements[i].checked == true)
                            if(elementlist == "")
                                elementlist = form.elements[i].value;
                            else
                                elementlist += "," + form.elements[i].value;
                }
            }
            jQuery("#" + windowId + "_bulkaction").val(jQuery("#bulkaction").val());
            jQuery("#" + windowId + "_imagelist").val(elementlist);
            // console.log (jQuery("#TB_imagelist").val());
            tb_show("", "#TB_inline?width=640&height=" + height + "&inlineId=" + windowId + "&modal=true", false);
        }

        //-->
    </script>
	<?php
	if($gallerylist) {
		require_once (dirname(__FILE__) . '/get_skin.php');
		$i_skins = get_skins();
		?>
		<link rel="stylesheet" type="text/css" href="<?php echo set_url_scheme( FLAG_URLPATH, 'admin'); ?>admin/js/selectize/selectize.css" />
		<script language="javascript" type="text/javascript" src="<?php echo set_url_scheme( FLAG_URLPATH, 'admin'); ?>admin/js/selectize/selectize.min.js"></script>
		<script type="text/javascript">/*<![CDATA[*/
			jQuery(document).ready(function() {
				var selected_galleries = jQuery('#mb_items_array').val();
				var galleries = 'gid=' + (selected_galleries ? selected_galleries.join(',') : 'all');
				var galorderby = jQuery('#mb_galorderby').val();
				var galorder = jQuery('#mb_galorder').val();
				var galexclude = jQuery('#mb_galexclude').val();
				if(galexclude) {
					galexclude = galexclude.join(',');
				}
				var skin = jQuery('#mb_skinname option:selected').val();
				if(skin) {
					var skin_preset = skin.split(':');
					skin = ' skin=' + skin_preset[0];
					if(skin_preset[1]) {
						skin += " preset='" + skin_preset[1] + "'";
					}
				} else {
					skin = '';
				}
				if('gid=all' == galleries) {
					if(galorderby) {
						galorderby = ' orderby=' + galorderby;
					} else {
						galorderby = '';
					}
					if(galorder) {
						galorder = ' order=' + galorder;
					} else {
						galorder = '';
					}
					if(galexclude) {
						galexclude = ' exclude=' + galexclude;
					} else {
						galexclude = '';
					}
				} else {
					galorderby = '';
					galorder = '';
					galexclude = '';
					jQuery('.sort_tab').css('display', 'none');
				}
				short_code(galleries, skin, galorderby, galorder, galexclude);

				jQuery('#mb_items_array').selectize({
					plugins: ['drag_drop', 'remove_button'],
					create: false,
					hideSelected: true,
					onChange: function(value) {
						if(value) {
							jQuery('.sort_tab').css('display', 'none');
						} else {
							jQuery('.sort_tab').css('display', '');
						}
						selected_galleries = jQuery('#mb_items_array').val();
						galleries = 'gid=' + (selected_galleries ? selected_galleries.join(',') : 'all');
						if(selected_galleries) {
							short_code(galleries, skin, '', '', '');
						} else {
							short_code(galleries, skin, galorderby, galorder, galexclude);
						}
					},
				});
				jQuery('#mb_skinname').change(function() {
					skin = jQuery(this).val();
					if(skin) {
						var skin_preset = skin.split(':');
						skin = ' skin=' + skin_preset[0];
						if(skin_preset[1]) {
							skin += " preset='" + skin_preset[1] + "'";
						}
					} else {
						skin = '';
					}
					short_code(galleries, skin, galorderby, galorder, galexclude);
				});
				jQuery('#mb_galorderby').change(function() {
					galorderby = jQuery(this).val();
					if(galorderby) {
						galorderby = ' orderby=' + galorderby;
					} else {
						galorderby = '';
					}
					short_code(galleries, skin, galorderby, galorder, galexclude);
				});
				jQuery('#mb_galorder').change(function() {
					galorder = jQuery(this).val();
					if(galorder) {
						galorder = ' order=' + galorder;
					} else {
						galorder = '';
					}
					short_code(galleries, skin, galorderby, galorder, galexclude);
				});
				jQuery('#mb_galexclude').selectize({
					plugins: ['remove_button'],
					create: false,
					hideSelected: true,
					onChange: function(value) {
						var excluded_galleries = jQuery('#mb_galexclude').val();
						if(excluded_galleries) {
							galexclude = ' exclude=' +excluded_galleries.join(',');
						} else {
							galexclude = '';
						}
						short_code(galleries, skin, galorderby, galorder, galexclude);
					},
				});
			});

			function short_code(galleries, skin, galorderby, galorder, galexclude) {
				jQuery('#mb_scode').val('[flagallery ' + galleries + ' w=100%' + skin + galorderby + galorder + galexclude + ']');
			}
		/*]]>*/</script>
		<div class="flag-wrap" style="margin-top:40px;" id="generator1">
			<h2><?php _e('Shortcode Generator', 'flash-album-gallery'); ?></h2>
			<table border="0" cellpadding="4" cellspacing="0" style="width: 90%;">
				<tr>
					<td nowrap="nowrap" valign="middle"><label for="mb_items_array"><?php _e("Select galleries", 'flash-album-gallery'); ?>:</label></td>
					<td style="width: 100%;"><div style="max-width: 600px; width: 98%;"><select id="mb_items_array" size="6" multiple="multiple" placeholder="<?php _e("Leave blank for all galleries", 'flash-album-gallery'); ?>">
							<option value=""><?php _e("Leave blank for all galleries", 'flash-album-gallery'); ?></option>
							<?php
							$gallerylist = $flagdb->find_all_galleries($flag->options['albSort'], $flag->options['albSortDir']);
							if(is_array($gallerylist)) {
								foreach($gallerylist as $gallery) {
									$name = ( empty($gallery->title) ) ? $gallery->name : esc_html(stripslashes($gallery->title));
									if($flag->options['albSort'] == 'gid'){ $name = $gallery->gid.' - '.$name; }
									if($flag->options['albSort'] == 'title'){ $name = $name.' ('.$gallery->gid.')'; }
									echo '<option value="' . $gallery->gid . '">' . $name . '</option>' . "\n";
								}
							}
							?>
							</select></div>
					</td>
				</tr>
				<tr class="sort_tab">
					<td></td>
					<td><div style="margin: -5px 0 7px"><i><?php _e('Drag and drop selected galleries in the field above to sort order them.', 'flash-album-gallery'); ?></i></div>
					</td>
				</tr>
				<tr class="sort_tab">
					<td nowrap="nowrap" valign="middle"><label for="mb_galorderby"><?php _e("Order galleries by", 'flash-album-gallery'); ?>:</label></td>
					<td valign="middle"><select style="max-width: 600px; width: 98%;" id="mb_galorderby">
							<option value=""><?php _e("Gallery IDs (default)", 'flash-album-gallery'); ?></option>
							<option value="title"><?php _e("Gallery Title", 'flash-album-gallery'); ?></option>
							<option value="rand"><?php _e("Randomly", 'flash-album-gallery'); ?></option>
						</select></td>
				</tr>
				<tr class="sort_tab">
					<td nowrap="nowrap" valign="middle"><label for="mb_galorder"><?php _e("Order", 'flash-album-gallery'); ?>:</label></td>
					<td valign="middle"><select style="max-width: 600px; width: 98%;" id="mb_galorder">
							<option value="" selected="selected"><?php _e("DESC (default)", 'flash-album-gallery'); ?></option>
							<option value="ASC"><?php _e("ASC", 'flash-album-gallery'); ?></option>
						</select></td>
				</tr>
				<tr class="sort_tab">
					<td nowrap="nowrap" valign="middle"><label for="mb_galexclude"><?php _e("Exclude galleries", 'flash-album-gallery'); ?>:</label></td>
					<td valign="middle"><div style="max-width: 600px; width: 98%;"><select id="mb_galexclude" size="6" multiple="multiple">
							<option value=""></option>
							<?php
							if(is_array($gallerylist)) {
								foreach($gallerylist as $gallery) {
									$name = ( empty($gallery->title) ) ? $gallery->name : esc_html(stripslashes($gallery->title));
									if($flag->options['albSort'] == 'gid'){ $name = $gallery->gid.' - '.$name; }
									if($flag->options['albSort'] == 'title'){ $name = $name.' ('.$gallery->gid.')'; }
									echo '<option value="' . $gallery->gid . '">' . $name . '</option>' . "\n";
								}
							}
							?>
							</select></div></td>
				</tr>
				<tr>
					<td nowrap="nowrap" valign="middle"><label for="mb_skinname"><?php _e("Choose skin", 'flash-album-gallery'); ?>:</label></td>
					<td valign="top"><div><select style="max-width: 600px; width: 98%;" id="mb_skinname">
								<option value=""><?php _e("skin active by default", 'flash-album-gallery'); ?></option>
								<?php
								foreach ( (array)$i_skins as $skin_file => $skin_data) {
									echo '<option value="'.dirname($skin_file).'">'.$skin_data['Name'].'</option>'."\n";

									$act_skin         = dirname( $skin_file );
									$skin_options_key = "{$act_skin}_options";
									if ( ! empty( $flag->options[ $skin_options_key ]['presets'] ) ) {
										foreach ( $flag->options[ $skin_options_key ]['presets'] as $preset_name => $preset_settings ) {
											$val = dirname($skin_file).':'.esc_attr( $preset_name );
											echo '<option value="'.$val.'">'.$skin_data['Name'].': '.esc_html( $preset_name ).'</option>'."\n";
										}
									}
								}
								?>
							</select></div>
					</td>
				</tr>
				<tr>
					<td nowrap="nowrap" valign="middle"><label for="mb_skinname"><?php _e("SHORTCODE", 'flash-album-gallery'); ?>:</label></td>
					<td valign="top"><input id="mb_scode" type="text" style="max-width: 600px; width: 98%;" value="" readonly /></td>
				</tr>
			</table>
		</div>
		<hr />
		<?php
	}
	?>
    <div class="flag-wrap" style="margin-top:40px;">
        <h2><?php _e('Gallery Overview', 'flash-album-gallery'); ?></h2>
        <form class="search-form" action="" method="get" style="float:right">
            <p class="search-box">
                <label class="hidden" for="media-search-input"><?php _e('Search Images', 'flash-album-gallery'); ?>
                    :</label>
                <input type="hidden" id="page-name" name="page" value="flag-manage-gallery"/>
                <input type="text" id="media-search-input" name="s" value="<?php the_search_query(); ?>"/>
                <input type="submit" value="<?php _e('Search Images', 'flash-album-gallery'); ?>" class="button"/>
            </p>
        </form>
        <form id="editgalleries" class="flagform" method="POST" action="<?php echo $flag->manage_page->base_page . '&amp;paged=' . $_GET['paged']; ?>" accept-charset="utf-8">
            <?php wp_nonce_field('flag_bulkgallery'); ?>
            <input type="hidden" name="flag_page" value="manage-galleries"/>

            <div class="tablenav" style="clear:none">

                <div class="alignleft actions">
                    <?php if(function_exists('json_encode')) : ?>
                        <select name="bulkaction" id="bulkaction">
                            <option value="no_action"><?php _e("No action", 'flash-album-gallery'); ?></option>
                            <option value="webview_images"><?php _e("Create images optimized for web", 'flash-album-gallery'); ?></option>
                            <option value="new_thumbnail"><?php _e("Create new thumbnails", 'flash-album-gallery'); ?></option>
                            <option value="resize_images"><?php _e("Resize images", 'flash-album-gallery'); ?></option>
                            <option value="import_meta"><?php _e("Import metadata", 'flash-album-gallery'); ?></option>
                            <option value="copy_meta"><?php _e("Metadata to description", 'flash-album-gallery'); ?></option>
                            <?php do_action('flag_manage_galleries_bulkaction'); ?>
                        </select>
                        <input name="showThickbox" class="button-secondary" type="submit" value="<?php _e('Apply', 'flash-album-gallery'); ?>" onclick="if ( !checkSelected() ) return false;"/>
                    <?php endif; ?>
                </div>

                <?php if($page_links) : ?>
                    <div class="tablenav-pages"><?php $page_links_text = sprintf('<span class="displaying-num">' . __('Displaying %s&#8211;%s of %s') . '</span>%s',
                                                                                 number_format_i18n(($_GET['paged'] - 1) * $perpage + 1),
                                                                                 number_format_i18n(min($_GET['paged'] * $perpage, $flagdb->paged['total_objects'])),
                                                                                 number_format_i18n($flagdb->paged['total_objects']),
                                                                                 $page_links
                        );
                        echo $page_links_text; ?></div>
                    <br class="clear"/>
                <?php endif; ?>

            </div>
            <table class="widefat flag-table" cellspacing="0">
                <thead>
                <tr>
                    <th scope="col" class="cb column-cb">
                        <input type="checkbox" onclick="checkAll(document.getElementById('editgalleries'));" name="checkall"/>
                    </th>
                    <th scope="col">
                        <a href="<?php echo $flag->manage_page->base_page . "&galsort=gid&sortdir={$ascdesc}&paged=" . $_GET['paged']; ?>"><?php _e('ID'); ?></a>
                    </th>
                    <th scope="col">
                        <a href="<?php echo $flag->manage_page->base_page . "&galsort=title&sortdir={$ascdesc}&paged=" . $_GET['paged']; ?>"><?php _e('Title', 'flash-album-gallery'); ?></a>
                    </th>
                    <th scope="col"><?php _e('Description', 'flash-album-gallery'); ?></th>
                    <th scope="col"><?php _e('Author', 'flash-album-gallery'); ?></th>
                    <th scope="col"><?php _e('Quantity', 'flash-album-gallery'); ?></th>
                    <th scope="col"><?php _e('Action', 'flash-album-gallery'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($gallerylist){
                    foreach($gallerylist as $gallery){
                        $class       = ( !isset($class) || $class == 'alt ')? '' : 'alt ';
                        $gid         = $gallery->gid;
                        $name        = (empty($gallery->title))? $gallery->name : $gallery->title;
                        $author_user = get_userdata((int) $gallery->author);
                        ?>
                        <tr id="gallery-<?php echo $gid; ?>" class="<?php echo $class;
                        echo ($gallery->status)? 'flag_draft' : 'flag_public'; ?>">
                            <th scope="row" class="cb column-cb">
                                <?php if(flagAdmin::can_manage_this_gallery($gallery->author)){ ?>
                                    <input name="doaction[]" type="checkbox" value="<?php echo $gid; ?>"/>
                                <?php } ?>
                            </th>
                            <td scope="row"><?php echo $gid; ?></td>
                            <td style="width:30%">
                                <?php if(flagAdmin::can_manage_this_gallery($gallery->author)){ ?>
                                    <a href="<?php echo wp_nonce_url($flag->manage_page->base_page . "&amp;mode=edit&amp;gid=" . $gid, 'flag_editgallery') ?>" class='edit' title="<?php _e('Edit'); ?>">
                                        <?php echo esc_html(flagGallery::i18n($name)); ?>
                                    </a>
                                <?php } else{ ?>
                                    <?php echo esc_html(flagGallery::i18n($gallery->title)); ?>
                                <?php }
                                if($gallery->status){
                                    echo ' <b>- ' . __('Draft', 'flash-album-gallery') . '</b>';
                                } ?>
                            </td>
                            <td style="width:30%"><?php echo esc_html(flagGallery::i18n($gallery->galdesc)); ?>&nbsp;
                            </td>
                            <td><?php echo $author_user->display_name; ?></td>
                            <td><?php echo $gallery->counter; ?></td>
                            <td style="white-space:nowrap;">
                                <?php if(flagAdmin::can_manage_this_gallery($gallery->author)) : ?>
                                    <a href="<?php echo wp_nonce_url($flag->manage_page->base_page . "&amp;mode=delete&amp;gid=" . $gid, 'flag_editgallery') ?>" class="delete" onclick="javascript:check=confirm( '<?php _e("Delete this gallery ?", 'flash-album-gallery') ?>');if(check==false) return false;"><?php _e('Delete', 'flash-album-gallery'); ?></a>
                                    <?php if($gallery->status){ ?>
                                        |
                                        <a href="<?php echo wp_nonce_url($flag->manage_page->base_page . "&amp;mode=publish&amp;gid=" . $gid, 'flag_editgallery') ?>" class="status" onclick="javascript:check=confirm( '<?php _e("Publish this gallery?", 'flash-album-gallery') ?>');if(check==false) return false;"><?php _e('Publish', 'flash-album-gallery'); ?></a>
                                    <?php } else{ ?>
                                        |
                                        <a href="<?php echo wp_nonce_url($flag->manage_page->base_page . "&amp;mode=draft&amp;gid=" . $gid, 'flag_editgallery') ?>" class="status" onclick="javascript:check=confirm( '<?php _e("Make this gallery draft?", 'flash-album-gallery') ?>');if(check==false) return false;"><?php _e('Draft', 'flash-album-gallery'); ?></a>
                                    <?php } ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else{
                    echo '<tr><td colspan="7" align="center"><strong>' . __('No entries found', 'flash-album-gallery') . '</strong></td></tr>';
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
    <?php if(current_user_can('FlAG Manage others gallery')){ ?>
        <script type="text/javascript">
            /*<![CDATA[*/
            jQuery(document).ready(function(){
                jQuery(".album_categoties").sortable({
                    opacity: 0.6,
                    cursor: 'move',
                    connectWith: ".album_categoties",
                    update: function(){}
                }).disableSelection();
                jQuery("#draggable .acat").draggable({
                    connectToSortable: ".album_categoties",
                    helper: "clone",
                    revert: "invalid"
                }).disableSelection();
                jQuery(".album_categoties").droppable({
                    accept: ".acat",
                    hoverClass: "active",
                    drop: function(event, ui){
                        jQuery(this).find(jQuery(ui.draggable)).addClass("highlight_new").attr("id", "g_" + jQuery(ui.draggable).attr('rel')).removeAttr('style');
                        jQuery(this).find("p").hide();
                    }
                });
                jQuery(".album_categoties").on('click', '.drop', function(){
                    var acat_parent = jQuery(this).parent().parent();
                    jQuery(this).parent().remove();
                    if(!acat_parent.find('.acat').length){
                        acat_parent.find('p').show();
                    }
                });
                jQuery('.flag-ajax-post').click(function(e){
                    var form = jQuery(this).attr('data-form');
                    var edata = jQuery(this).dataset();
                    edata.form = jQuery('#' + form).serialize() + '&' + jQuery(this).parents('.album').find('.album_categoties').sortable("serialize");
                    jQuery.post(ajaxurl, edata,
                        function(response){
                            jQuery(e.target).parent().find('.alb_msg').show().html(response).fadeOut(1200);
                            if(jQuery(e.target).hasClass('del')){
                                jQuery(e.target).parent().parent().parent().remove();
                            }
                            if(response == 'Success'){
                                jQuery(e.target).parents('div.album:first').find('.acat').removeClass('highlight_new');
                                jQuery(e.target).parents('span.album_actions').find('.alb_msg').show().text('OK').fadeOut(1200);
                            }
                        }
                    );
                    return false;
                });
            });
            /*]]>*/
        </script>
        <div class="flag-wrap">
            <div class="floatholder">
                <div style="float:left;">
                    <h2 style="float:left; margin:5px 0;"><?php _e('Albums', 'flash-album-gallery'); ?></h2>
                    <form method="post" style="float: right;" action="<?php echo admin_url('admin.php?page=flag-manage-gallery'); ?>"><?php wp_nonce_field('flag_album'); ?>
                        <div><input type="text" id="album_name" name="album_name" value=""/> &nbsp;
                            <input type="submit" value="<?php _e('Create New Album', 'flash-album-gallery'); ?>" class="button-primary"/>
                        </div></form>
                    <div class="clearfix"></div>
                    <div class="albums_table">
                        <?php $albumlist = $flagdb->find_all_albums();
                        $nonce           = wp_create_nonce('wpMediaLib');
                        if($albumlist){
                            foreach($albumlist as $album){
                                ?>
                                <div class="album">
                                    <div class="album_name"><span class="albID"><?php echo $album->id; ?>.</span>
                                        <form method="post" id="albName_<?php echo $album->id; ?>" name="albName_<?php echo $album->id; ?>">
                                            <input type="text" name="album_name" value="<?php echo esc_html($album->name); ?>"/><input type="hidden" name="album_id" value="<?php echo $album->id; ?>"/>
                                        </form>
                                        <span class="album_actions"><span class="alb_msg"></span>&nbsp;&nbsp;&nbsp;<span class="button del flag-ajax-post" data-action="flag_delete_album" data-_ajax_nonce="<?php echo $nonce; ?>" data-post="<?php echo $album->id; ?>"><?php _e('Delete', 'flash-album-gallery'); ?></span>&nbsp;&nbsp;<span class="album_save flag-ajax-post button-primary" data-action="flag_save_album" data-_ajax_nonce="<?php echo $nonce; ?>" data-form="albName_<?php echo $album->id; ?>"><strong><?php _e('Save', 'flash-album-gallery'); ?></strong></span></span>
                                    </div>
                                    <div class="album_categoties">
                                        <?php $galids = explode(',', $album->categories);
                                        if($album->categories){
                                            foreach($galids as $galid){
                                                $acat = $flagdb->find_gallery($galid);
                                                ?>

                                                <div class="acat" rel="<?php echo $acat->gid; ?>" id="g_<?php echo $acat->gid; ?>"><?php echo esc_html($acat->title); ?>
                                                    <span class="drop">x</span></div>
                                            <?php }
                                        } else{
                                            echo '<p style="text-align:center; padding: 7px 0; margin: 0;">' . __('Drag&Drop Categories Here', 'flash-album-gallery') . '</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php }
                        } else{
                            echo '<p style="text-align:center; padding: 20px 0; margin: 0;">' . __('No Albums', 'flash-album-gallery') . '</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="all_galleries">
                    <h2 style="margin:5px 0 12px;"><?php _e('Galleries', 'flash-album-gallery'); ?></h2>
                    <div id="draggable">
                        <?php
                        if($gallerylist){
                            foreach($gallerylist as $gallery){
                                $gid         = $gallery->gid;
                                $name        = (empty($gallery->title))? $gallery->name : esc_html($gallery->title);
                                $author_user = get_userdata((int) $gallery->author);
                                if(flagAdmin::can_manage_this_gallery($gallery->author)){
                                    ?>
                                    <div class="acat" rel="<?php echo $gid; ?>"><?php echo $name; ?>
                                        <span class="drop">x</span></div>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- #resize_images -->
    <div id="resize_images" style="display: none;">
        <form id="form_resize_images" method="POST" accept-charset="utf-8">
            <?php wp_nonce_field('flag_thickbox_form'); ?>
            <input type="hidden" id="resize_images_imagelist" name="TB_imagelist" value=""/>
            <input type="hidden" id="resize_images_bulkaction" name="TB_bulkaction" value=""/>
            <input type="hidden" name="flag_page" value="manage-galleries"/>
            <table width="100%" border="0" cellspacing="3" cellpadding="3">
                <tr valign="top">
                    <td>
                        <strong><?php _e('Resize Images to', 'flash-album-gallery'); ?>:</strong>
                    </td>
                    <td>
                        <input type="text" size="5" name="imgWidth" value="<?php echo $flag->options['imgWidth']; ?>"/>
                        x
                        <input type="text" size="5" name="imgHeight" value="<?php echo $flag->options['imgHeight']; ?>"/>
                        <br/>
                        <small><?php _e('Width x height (in pixel). FlAGallery will keep ratio size', 'flash-album-gallery'); ?></small>
                    </td>
                </tr>
                <tr align="right">
                    <td colspan="2" class="submit">
                        <input class="button-primary" type="submit" name="TB_ResizeImages" value="<?php _e('OK', 'flash-album-gallery'); ?>"/>
                        &nbsp;
                        <input class="button-secondary" type="reset" value="&nbsp;<?php _e('Cancel', 'flash-album-gallery'); ?>&nbsp;" onclick="tb_remove()"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- /#resize_images -->

    <!-- #new_thumbnail -->
    <div id="new_thumbnail" style="display: none;">
        <form id="form_new_thumbnail" method="POST" accept-charset="utf-8">
            <?php wp_nonce_field('flag_thickbox_form'); ?>
            <input type="hidden" id="new_thumbnail_imagelist" name="TB_imagelist" value=""/>
            <input type="hidden" id="new_thumbnail_bulkaction" name="TB_bulkaction" value=""/>
            <input type="hidden" name="flag_page" value="manage-galleries"/>
            <table width="100%" border="0" cellspacing="3" cellpadding="3">
                <tr valign="top">
                    <th align="left"><?php _e('Width x height (in pixel)', 'flash-album-gallery'); ?></th>
                    <td>
                        <input type="number" size="5" maxlength="5" name="thumbWidth" min="300" max="800" value="<?php echo $flag->options['thumbWidth']; ?>"/>
                        x
                        <input type="number" size="5" maxlength="5" min="300" max="800" name="thumbHeight" value="<?php echo $flag->options['thumbHeight']; ?>"/>
                        <br/>
                        <small><?php _e('These values are maximum values ', 'flash-album-gallery'); ?></small>
                    </td>
                </tr>
                <tr align="right">
                    <td colspan="2" class="submit">
                        <input class="button-primary" type="submit" name="TB_NewThumbnail" value="<?php _e('OK', 'flash-album-gallery'); ?>"/>
                        &nbsp;
                        <input class="button-secondary" type="reset" value="&nbsp;<?php _e('Cancel', 'flash-album-gallery'); ?>&nbsp;" onclick="tb_remove()"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- /#new_thumbnail -->

    <?php
}
