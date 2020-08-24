<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

/**
 * flagAdmin - Class for admin operation
 */
if ( ! class_exists( 'flagAdmin' ) ) {
class flagAdmin{

	/**
	 * create a new gallery & folder
	 *
	 * @class flagAdmin
	 * @param string $gallery
	 * @param string $defaultpath
	 * @param bool $output if the function should show an error messsage or not
	 * @return bool|int
	 */
	public static function create_gallery($gallery, $defaultpath, $output = true) {
		global $wpdb, $user_ID;

		// get the current user ID
        wp_get_current_user();

		$description = '';
		$status = 0;
		if(is_array($gallery)){
			$gallerytitle = $gallery['title'];
			$description = $gallery['description'];
			$status = intval($gallery['status']);
		} else {
			$gallerytitle = $gallery;
		}
		//cleanup pathname
		$galleryname = sanitize_flagname( $gallerytitle );
		$galleryname = apply_filters('flag_gallery_name', $galleryname);
		$galleryname = preg_replace('/[^\w\._-]+/', '', $galleryname);
		if(!$galleryname) $galleryname = date('y-m-j_h-i-s');

		$flagpath = $defaultpath . $galleryname;
		$flagpath = trim($flagpath, '/');
		$flagRoot = WINABSPATH . $defaultpath;
		$txt = '';

		// No gallery name ?
		if (empty($galleryname)) {
			if ($output) flagGallery::show_error( __('No valid gallery name!', 'flash-album-gallery') );
			return false;
		}

		// check for main folder
		if ( !is_dir($flagRoot) ) {
			if ( !wp_mkdir_p( $flagRoot ) ) {
				$txt  = __('Directory', 'flash-album-gallery').' <strong>' . $defaultpath . '</strong> '.__('didn\'t exist. Please create first the main gallery folder ', 'flash-album-gallery').'!<br />';
				$txt .= __('Check this link, if you didn\'t know how to set the permission :', 'flash-album-gallery').' <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> ';
				if ($output) flagGallery::show_error($txt);
				return false;
			}
		}

		// check for permission settings, Safe mode limitations are not taken into account.
		if ( !is_writeable( $flagRoot ) ) {
			$txt  = __('Directory', 'flash-album-gallery').' <strong>' . $defaultpath . '</strong> '.__('is not writeable !', 'flash-album-gallery').'<br />';
			$txt .= __('Check this link, if you didn\'t know how to set the permission :', 'flash-album-gallery').' <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a> ';
			if ($output) flagGallery::show_error($txt);
			return false;
		}

		// 1. Create new gallery folder
		if ( !is_dir(WINABSPATH . $flagpath) ) {
			if ( !wp_mkdir_p (WINABSPATH . $flagpath) )
				$txt  = __('Unable to create directory ', 'flash-album-gallery').$flagpath.'!<br />';
		}

		// 2. Check folder permission
		if ( !is_writeable(WINABSPATH . $flagpath ) )
			$txt .= __('Directory', 'flash-album-gallery').' <strong>'.$flagpath.'</strong> '.__('is not writeable !', 'flash-album-gallery').'<br />';

		// 3. Now create "thumbs" folder inside
		if ( !is_dir(WINABSPATH . $flagpath . '/thumbs') ) {
			if ( !wp_mkdir_p ( WINABSPATH . $flagpath . '/thumbs') )
				$txt .= __('Unable to create directory ', 'flash-album-gallery').' <strong>' . $flagpath . '/thumbs !</strong>';
		}

		// 4. Now create "webview" folder inside
		if ( !is_dir(WINABSPATH . $flagpath . '/webview') ) {
			if ( !wp_mkdir_p ( WINABSPATH . $flagpath . '/webview') )
				$txt .= __('Unable to create directory ', 'flash-album-gallery').' <strong>' . $flagpath . '/webview !</strong>';
		}

		if (FLAG_SAFE_MODE) {
			$help  = __('The server setting Safe-Mode is on !', 'flash-album-gallery');
			$help .= '<br />'.__('If you have problems, please create directory', 'flash-album-gallery').' <strong>' . $flagpath . '</strong> ';
			$help .= __('and the thumbnails directory', 'flash-album-gallery').' <strong>' . $flagpath . '/thumbs</strong> '.__('with permission 777 manually !', 'flash-album-gallery');
			if ($output) flagGallery::show_message($help);
		}

		// show an error message
		if ( !empty($txt) ) {
			if (FLAG_SAFE_MODE) {
			// for safe_mode , better delete folder, both folder must be created manually
				@rmdir(WINABSPATH . $flagpath . '/thumbs');
				@rmdir(WINABSPATH . $flagpath);
			}
			if ($output) flagGallery::show_error($txt);
			return false;
		}

		$result = $wpdb->get_var($wpdb->prepare("SELECT `name` FROM `{$wpdb->flaggallery}` WHERE `name` = '%s' ", $galleryname));

		if ($result) {
			if ($output) flagGallery::show_error( _n( 'Gallery', 'Galleries', 1, 'flash-album-gallery' ) .' <strong>' . $galleryname . '</strong> '.__('already exists', 'flash-album-gallery'));
			return true;
		} else {
			if(empty($user_ID)){
				$user_ID = $wpdb->get_var("SELECT ID FROM $wpdb->users ORDER BY ID");
			}
			$result = $wpdb->query( $wpdb->prepare("INSERT INTO $wpdb->flaggallery (name, path, title, galdesc, author, status) VALUES (%s, %s, %s, %s, %s, %d)", $galleryname, $flagpath, $gallerytitle, $description, $user_ID, $status) );
			// and give me the new id
			$gallery_id = (int) $wpdb->insert_id;
			// here you can inject a custom function
			do_action('flag_created_new_gallery', $gallery_id);

			if ($result) {
				$message  = __('Gallery \'%1$s\' successfully created.<br/>You can show this gallery with the tag %2$s.<br/>','flash-album-gallery');
				$message  = sprintf($message, esc_html(stripcslashes($gallerytitle)), '[flagallery gid=' . $gallery_id . ']');
				$message .= '<a href="' . admin_url() . 'admin.php?page=flag-manage-gallery&mode=edit&gid=' . $gallery_id . '" >';
				$message .= __('Edit gallery','flash-album-gallery');
				$message .= '</a>';

				if ($output) flagGallery::show_message($message);
			}
			// return only the id if defined
			if ($gallery_id)
				return $gallery_id;

			return true;
		}
	}

	/**
	 * flagAdmin::import_gallery()
	 * TODO: Check permission of existing thumb folder & images
	 *
	 * @class flagAdmin
	 * @param string $galleryfolder contains relative path
	 * @return void
	 */
	public static function import_gallery($galleryfolder) {

		global $wpdb, $user_ID;

		// get the current user ID
        wp_get_current_user();

		$created_msg = '';

		// remove trailing slashes, if somebody use it
		$galleryfolder = str_replace('../','', $galleryfolder );
		$galleryfolder = trim($galleryfolder, '/');
		$gallerypath = WINABSPATH . $galleryfolder;

		if (!is_dir($gallerypath)) {
			flagGallery::show_error(__('Directory', 'flash-album-gallery').' <strong>'.esc_html($gallerypath).'</strong> '.__('doesn&#96;t exist!', 'flash-album-gallery').' '.__('Or imported folder name contains special characters.', 'flash-album-gallery'));
			return ;
		}

		// read list of images
		$new_imageslist = flagAdmin::scandir($gallerypath);
		if (empty($new_imageslist)) {
			flagGallery::show_message(__('Directory', 'flash-album-gallery').' <strong>'.esc_html($gallerypath).'</strong> '.__('contains no pictures', 'flash-album-gallery'));
			return;
		}

		// check & create thumbnail folder
		if ( !flagGallery::create_thumbnail_folder($gallerypath) )
			return;

		// take folder name as gallery name
		$galleryname = basename($galleryfolder);

		// check for existing gallery folder
		$gallery_id = $wpdb->get_var($wpdb->prepare("SELECT gid FROM {$wpdb->flaggallery} WHERE path = '%s' ", $galleryfolder));

		if (!$gallery_id) {
			$result = $wpdb->query( $wpdb->prepare("INSERT INTO {$wpdb->flaggallery} (name, path, title, author) VALUES (%s, %s, %s, %s)", $galleryname, $galleryfolder, $galleryname , $user_ID) );
			if (!$result) {
				flagGallery::show_error(__('Database error. Could not add gallery!','flash-album-gallery'));
				return;
			}
			$created_msg = _n( 'Gallery', 'Galleries', 1, 'flash-album-gallery' ) . ' <strong>' . $galleryname . '</strong> ' . __('successfully created!','flash-album-gallery') . '<br />';
			$gallery_id  = $wpdb->insert_id;  // get index_id
		}

		// Look for existing image list
		$old_imageslist = $wpdb->get_col($wpdb->prepare("SELECT filename FROM {$wpdb->flagpictures} WHERE galleryid = %d ", $gallery_id));

		// if no images are there, create empty array
		if ($old_imageslist == NULL)
			$old_imageslist = array();

		// check difference
		$new_images = array_diff($new_imageslist, $old_imageslist);

		// all images must be valid files
		foreach($new_images as $key => $picture) {
			if (!@getimagesize($gallerypath . '/' . $picture) ) {
				unset($new_images[$key]);
				@unlink($gallerypath . '/' . $picture);
			}
		}

		// add images to database
		$image_ids = flagAdmin::add_Images($gallery_id, $new_images);

		//add the preview image if needed
		flagAdmin::set_gallery_preview ( $gallery_id );

		// now create thumbnails
		flagAdmin::do_ajax_operation( 'create_thumbnail' , $image_ids, __('Create new thumbnails','flash-album-gallery') );

		//TODO:Message will not shown, because AJAX routine require more time, message should be passed to AJAX
		flagGallery::show_message( $created_msg . count($image_ids) .__(' picture(s) successfully added','flash-album-gallery') );

		return;

	}

	/**
	 * flagAdmin::import_video()
	 *
	 * @class flagAdmin
	 * @param string $folder contains relative path
	 * @return void
	 */
	public static function import_video($folder) {


		$created_msg = '';
		// remove trailing slash at the end, if somebody use it
		$folder = str_replace(array('../','\'','"','<','>','$','%','='),'', $folder);
		$folder = rtrim($folder, '/');
		$path = WINABSPATH . $folder;
		if (!is_dir($path)) {
			echo '<p class="message">'.__('Directory', 'flash-album-gallery').' <strong>'.$path.'</strong> '.__('doesn&#96;t exist!', 'flash-album-gallery').' '.__('Or imported folder name contains special characters.', 'flash-album-gallery').'</p>';
			return ;
		}
		// read list of files
		$ext = array('mp4','ogg','webm','flv');
		$new_filelist = flagAdmin::scandir($path, $ext);
		if (empty($new_filelist)) {
			echo '<p class="message">'.__('Directory', 'flash-album-gallery').' <strong>'.$path.'</strong> '.__('does not contain video files', 'flash-album-gallery').'</p>';
			return;
		}
		$i=0;
		foreach($new_filelist as $key => $file) {
			//$new_filelist[$key] = $path . '/' . $file;
			$filename = $path . '/' . $file;
			$id = flagAdmin::handle_import_file($filename);
			if ( is_wp_error($id) ) {
				$created_msg .= '<p>' . sprintf(__('<em>%s</em> was <strong>not</strong> imported due to an error: %s', 'flash-album-gallery'), $file, $id->get_error_message() ) . '</p>';
			} else {
				$i++;
				$created_msg .= '<p>' . sprintf(__('<em>%s</em> has been added to Media library', 'flash-album-gallery'), $file) . '</p>';
			}
		}
		$created_msg .= '<p class="message">'.$i.__(' file(s) successfully added','flash-album-gallery').'</p><div class="hidden">'.$created_msg.'</div>';
		echo $created_msg;
	}

	/**
	 * flagAdmin::import_mp3()
	 *
	 * @class flagAdmin
	 * @param string $folder contains relative path
	 * @return void
	 */
	public static function import_mp3($folder) {

		$created_msg = '';
		// remove trailing slash at the end, if somebody use it
		$folder = str_replace(array('../','\'','"','<','>','$','%','='),'', $folder);
		$folder = rtrim($folder, '/');
		$path = WINABSPATH . $folder;
		if (!is_dir($path)) {
			echo '<p class="message">'.__('Directory', 'flash-album-gallery').' <strong>'.$path.'</strong> '.__('doesn&#96;t exist!', 'flash-album-gallery').' '.__('Or imported folder name contains special characters.', 'flash-album-gallery').'</p>';
			return ;
		}
		// read list of files
		$ext = array('mp3', 'ogg', 'wav');
		$new_filelist = flagAdmin::scandir($path, $ext);
		if (empty($new_filelist)) {
			echo '<p class="message">'.__('Directory', 'flash-album-gallery').' <strong>'.$path.'</strong> '.__('does not contain audio files', 'flash-album-gallery').'</p>';
			return;
		}
		$i=0;
		foreach($new_filelist as $key => $file) {
			//$new_filelist[$key] = $path . '/' . $file;
			$filename = $path . '/' . $file;
			$id = flagAdmin::handle_import_file($filename);
			if ( is_wp_error($id) ) {
				$created_msg .= '<p>' . sprintf(__('<em>%s</em> was <strong>not</strong> imported due to an error: %s', 'flash-album-gallery'), $file, $id->get_error_message() ) . '</p>';
			} else {
				$i++;
				$created_msg .= '<p>' . sprintf(__('<em>%s</em> has been added to Media library', 'flash-album-gallery'), $file) . '</p>';
			}
		}
		$created_msg .= '<p class="message">'.$i.__(' file(s) successfully added','flash-album-gallery').'</p><div class="hidden">'.$created_msg.'</div>';
		echo $created_msg;
	}

	/**
	 * flagAdmin::import_banner()
	 *
	 * @class flagAdmin
	 * @param string $folder contains relative path
	 * @return array
	 */
	public static function import_banner($folder) {

		$created_msg = '';
		// remove trailing slash at the end, if somebody use it
		$folder = str_replace(array('../','\'','"','<','>','$','%','='),'', $folder);
		$folder = rtrim($folder, '/');
		$path = WINABSPATH . $folder;
		if (!is_dir($path)) {
			echo '<p class="message">'.__('Directory', 'flash-album-gallery').' <strong>'.$path.'</strong> '.__('doesn&#96;t exist!', 'flash-album-gallery').' '.__('Or imported folder name contains special characters.', 'flash-album-gallery').'</p>';
			return false;
		}
		// read list of files
		$new_filelist = flagAdmin::scandir($path);
		if (empty($new_filelist)) {
			echo '<p class="message">'.__('Directory', 'flash-album-gallery').' <strong>'.$path.'</strong> '.__('does not contain image files', 'flash-album-gallery').'</p>';
			return false;
		}
		$created_msg .= '<div class="message"><p>'.count($new_filelist).' '.__('image(s) in the folder','flash-album-gallery').':</p><div class="flag_crunching"><div class="flag_progress"><span class="flag_complete"></span><span class="txt">'.__('Crunching...','flash-album-gallery').'</span></div></div></div>';
		echo $created_msg;
		return $new_filelist;
	}

	//Handle an individual file import.
	public static function handle_import_file($file, $post_id = 0) {
		set_time_limit(120);
		$time = current_time('mysql');
		if ( $post = get_post($post_id) ) {
			if ( substr( $post->post_date, 0, 4 ) > 0 )
				$time = $post->post_date;
		}

		// A writable uploads dir will pass this test. Again, there's no point overriding this one.
		if ( ! ( ( $uploads = wp_upload_dir($time) ) && false === $uploads['error'] ) )
			return new WP_Error($uploads['error']);

		$wp_filetype = wp_check_filetype( $file, null );

		/** @var $type
		 *  @var $ext */
		extract( $wp_filetype );

		if ( ( !$type || !$ext ) && !current_user_can( 'unfiltered_upload' ) )
			return new WP_Error('wrong_file_type', __( 'File type does not meet security guidelines. Try another.' ) ); //A WP-core string..

		$match = preg_match('|^' . preg_quote(str_replace('\\', '/', $uploads['basedir'])) . '(.*)$|i', $file, $mat);
		//Is the file allready in the uploads folder?
		if( $match ) {

			$filename = basename($file);
			$new_file = $file;

			$url = $uploads['baseurl'] . $mat[1];

			$attachment = get_posts(array( 'post_type' => 'attachment', 'meta_key' => '_wp_attached_file', 'meta_value' => $uploads['subdir'] . '/' . $filename ));
			if ( !empty($attachment) )
				return $attachment[0]->ID;

			//Ok, Its in the uploads folder, But NOT in WordPress's media library.
			if ( preg_match("|(\d+)/(\d+)|", $mat[1], $datemat) ) //So lets set the date of the import to the date folder its in, IF its in a date folder.
				$time = mktime(0, 0, 0, $datemat[2], 1, $datemat[1]);
			else //Else, set the date based on the date of the files time.
				$time = @filemtime($file);

			if ( $time ) {
				$post_date = date( 'Y-m-d H:i:s', $time);
				$post_date_gmt = gmdate( 'Y-m-d H:i:s', $time);
			}
		} else {
			$filename = wp_unique_filename( $uploads['path'], basename($file));

			// copy the file to the uploads dir
			$new_file = $uploads['path'] . '/' . $filename;
			if ( false === @copy( $file, $new_file ) ){
                wp_die(sprintf(__('The selected file could not be copied to %s.', 'flash-album-gallery'), $uploads['path']));
            }

			// Set correct file permissions
			$stat = stat( dirname( $new_file ));
			$perms = $stat['mode'] & 0000666;
			@ chmod( $new_file, $perms );
			// Compute the URL
			$url = $uploads['url'] . '/' . rawurlencode($filename);
		}

		// Compute the URL
		//Apply upload filters
		$return = apply_filters( 'wp_handle_upload', array( 'file' => $new_file, 'url' => $url, 'type' => $type ) );
		$new_file = $return['file'];
		$url = $return['url'];
		$type = $return['type'];

		$title = preg_replace('!\.[^.]+$!', '', basename($file));
		$content = '';

		// use image exif/iptc data for title and caption defaults if possible
		if ( $image_meta = @wp_read_image_metadata($new_file) ) {
			if ( '' != trim($image_meta['title']) )
				$title = trim($image_meta['title']);
			if ( '' != trim($image_meta['caption']) )
				$content = trim($image_meta['caption']);
		}

		if ( empty($post_date) )
			$post_date = current_time('mysql');
		if ( empty($post_date_gmt) )
			$post_date_gmt = current_time('mysql', 1);

		// Construct the attachment array
		$attachment = array(
			'post_mime_type' => $type,
			'guid' => $url,
			'post_parent' => $post_id,
			'post_title' => $title,
			'post_name' => $title,
			'post_content' => $content,
			'post_date' => $post_date,
			'post_date_gmt' => $post_date_gmt
		);

		// Save the data
		$id = wp_insert_attachment($attachment, $new_file, $post_id);
		if ( !is_wp_error($id) ) {
			$data = wp_generate_attachment_metadata( $id, $new_file );
			wp_update_attachment_metadata( $id, $data );
			if( !$match && isset($_POST['delete_files']) ) {
				@unlink($file);
			}
		}

		return $id;
	}

	/**
	 * flagAdmin::scandir()
	 *
	 * @class flagAdmin
	 * @param string $dirname
	 * @param array $ext
	 * @return array
	 */
	public static function scandir($dirname = '.', $ext = array()) {
		// thx to php.net :-)
		if(empty($ext))
			$ext = array('jpeg', 'jpg', 'png', 'gif');
		$files = array();
		if($handle = opendir($dirname)) {
		   while(false !== ($file = readdir($handle)))
		       for($i=0;$i<sizeof($ext);$i++)
		           if(stristr($file, '.' . $ext[$i]))
		               $files[] = utf8_encode($file);
		   closedir($handle);
		}
		sort($files);
		return ($files);
	}

	/**
	 * flagAdmin::createThumbnail() - function to create or recreate a thumbnail
	 *
	 * @param object | int $image contain all information about the image or the id
	 * @return string result code
	 */
	public static function create_thumbnail($image) {

		global $flag;

		if ( is_numeric($image) )
			$image = flagdb::find_image( $image );

		if ( !is_object($image) )
			return __('Object didn\'t contain correct data','flash-album-gallery');

		$dest_path = dirname($image->webimagePath);
		if(!is_dir($dest_path)){
			flagGallery::create_webview_folder(dirname($image->imagePath));
			@chmod( $dest_path, 0755 );
		}

		if(! class_exists('flag_Thumbnail'))
			require_once( flagGallery::graphic_library() );

		// check for existing thumbnail
		if (file_exists($image->thumbPath))
			if (!is_writable($image->thumbPath))
				return $image->filename . __(' is not writeable ','flash-album-gallery');

		$thumb = new flag_Thumbnail($image->imagePath, TRUE);
		$img_size = @getimagesize ( $image->imagePath );

		// skip if file is not there
		if (!$thumb->error) {
			$thumb->resize($flag->options['thumbWidth'],$flag->options['thumbHeight']);

			// save the new thumbnail
			$thumb->save($image->thumbPath, $flag->options['thumbQuality']);
			flagAdmin::chmod ($image->thumbPath);

			//read the new sizes
			$new_size = @getimagesize ( $image->thumbPath );
			$size['width'] = $new_size[0];
			$size['height'] = $new_size[1];

			// add them to the database
			flagdb::update_image_meta($image->pid, array( 'thumbnail' => $size) );
		}

		$thumb->destruct();

		if ( !empty($thumb->errmsg) )
			return $image->filename . ' (Error : '.$thumb->errmsg .')';

		do_action('flag_thumbnail_created', $image);

		flagAdmin::webview_image($image);

		// success
		return '1';
	}

	/**
	 * flagAdmin::resize_image() - create a new image, based on the height /width
	 *
	 * @class flagAdmin
	 * @param object | int $image contain all information about the image or the id
	 * @param integer $width optional
	 * @param integer $height optional
	 * @return string result code
	 */
	public static function resize_image($image, $width = 0, $height = 0) {

		global $flag;

		if(! class_exists('flag_Thumbnail'))
			require_once( flagGallery::graphic_library() );

		if ( is_numeric($image) )
			$image = flagdb::find_image( $image );

		if ( !is_object($image) )
			return __('Object didn\'t contain correct data','flash-album-gallery');

		// before we start we import the meta data to database (required for uploads before V0.40)
		flagAdmin::maybe_import_meta( $image->pid );

		// if no parameter is set, take global settings
		$width  = ($width  == 0) ? $flag->options['imgWidth']  : $width;
		$height = ($height == 0) ? $flag->options['imgHeight'] : $height;

		if (!is_writable($image->imagePath))
			return ' <strong>' . $image->filename . __(' is not writeable','flash-album-gallery') . '</strong>';

		$file = new flag_Thumbnail($image->imagePath, TRUE);

		// skip if file is not there
		if (!$file->error) {
			$file->resize($width, $height, 4);
			$file->save($image->imagePath, $flag->options['imgQuality']);
			// read the new sizes
			$size = @getimagesize ( $image->imagePath );
			// add them to the database
			flagdb::update_image_meta($image->pid, array( 'width' => $size[0], 'height' => $size[1] ) );
			$file->destruct();
		} else {
            $file->destruct();
			return ' <strong>' . $image->filename . ' (Error : ' . $file->errmsg . ')</strong>';
		}

		do_action('flag_image_resized', $image);

		return '1';
	}

    /**
     * flagAdmin::webview_image() - create a new image, based on the height /width
     *
     * @class flagAdmin
     *
     * @param object | int $image contain all information about the image or the id
     * @param bool         $return_size
     *
     * @return string result code
     */
	public static function webview_image($image, $return_size = false) {

		global $flag;

		if ( is_numeric($image) )
			$image = flagdb::find_image( $image );

		if ( !is_object($image) )
			return __('Object didn\'t contain correct data','flash-album-gallery');

		$img_size = @getimagesize ( $image->imagePath );
        $webviewsize = '0';
        $dest_path = dirname($image->webimagePath);
		if(flagGallery::create_webview_folder(dirname($image->imagePath))){
			if (! is_writable( $dest_path ) ) {
				@chmod( $dest_path, 0755 );
			}

			if (file_exists($image->webimagePath)){
                $webviewsize = @getimagesize ( $image->webimagePath );
                flagdb::update_image_meta($image->pid, array( 'webview' => $webviewsize) );
                if($return_size){
                    return $webviewsize;
                } else {
                    return '1';
                }
			}

			$imgquality = $flag->options['imgQuality'];
			$max_width = ($img_size[0] < 2000)? $img_size[0] : 2000;
			$max_height = ($img_size[1] < 2000)? $img_size[1] : 2000;
			if( function_exists('wp_get_image_editor') ) {
				$editor = wp_get_image_editor( $image->imagePath );
                if ( ! is_wp_error( $editor ) ) {
                    $editor->set_quality( $imgquality );
                    $editor->resize( $max_width, $max_height, 0 );
                    $saved = $editor->save( $image->webimagePath );
	                if($saved['path'] !== $image->webimagePath) {
		                @rename($saved['path'], $image->webimagePath);
	                }
                    if(@filesize($image->webimagePath) > @filesize($image->imagePath)) {
                        @copy($image->imagePath, $image->webimagePath);
                    }
	                $webviewsize = @getimagesize ( $image->webimagePath );
                    flagdb::update_image_meta($image->pid, array( 'webview' => $webviewsize) );

                    do_action('flag_image_optimized', $image);
                }
			}
		}

        if($return_size){
            return $webviewsize;
        } else {
            return '1';
        }
	}

	/**
	 * Add images to database
	 *
	 * @class flagAdmin
	 * @param int $galleryID
	 * @param array $imageslist
	 * @param bool $name2alt
	 * @return array $image_ids Id's which are sucessful added
	 */
	public static function add_Images($galleryID, $imageslist, $name2alt = false) {
		global $wpdb;

		$alttext = '';
		$image_ids = array();

		if ( is_array($imageslist) ) {
			foreach($imageslist as $picture) {
				if($name2alt) {
					// strip off the extension of the filename
					$path_parts = pathinfo( $picture );
					$alttext = ( !isset($path_parts['filename']) ) ? substr($path_parts['basename'], 0,strpos($path_parts['basename'], '.')) : $path_parts['filename'];
				}
				// save it to the database
				$result = $wpdb->query( $wpdb->prepare("INSERT INTO $wpdb->flagpictures (galleryid, filename, alttext, exclude) VALUES (%s, %s, %s, 0)", $galleryID, $picture, $alttext) );
				// and give me the new id
				$pic_id = (int) $wpdb->insert_id;
				if ($result)
					$image_ids[] = $pic_id;

				// add the metadata
				flagAdmin::import_MetaData($pic_id);

				// action hook for post process after the image is added to the database
				$image = array( 'id' => $pic_id, 'filename' => $picture, 'galleryID' => $galleryID);
				do_action('flag_added_new_image', $image);

			}
		} // is_array

		return $image_ids;

	}

	/**
	 * Import some metadata into the database (if avialable)
	 *
	 * @class flagAdmin
	 * @param array|int $imagesIds
	 * @return bool
	 */
	public static function import_MetaData($imagesIds) {

		global $wpdb;

		require_once(FLAG_ABSPATH . 'lib/image.php');

		if (!is_array($imagesIds))
			$imagesIds = array($imagesIds);

		foreach($imagesIds as $imageID) {
			$image = flagdb::find_image($imageID);
			if (!$image->error) {

				$meta = flagAdmin::get_MetaData($image->pid);

				// get the title
				$alttext = empty( $meta['title'] ) ? $image->alttext : $meta['title'];
				// get the caption / description field
				$description = empty( $meta['caption'] ) ? $image->description : $meta['caption'];
				// get the file date/time from exif
				$timestamp = $meta['timestamp'];
				// update database
				$result = $wpdb->query( $wpdb->prepare("UPDATE $wpdb->flagpictures SET alttext = %s, description = %s, imagedate = %s WHERE pid = %d", $alttext, $description, $timestamp, $image->pid) );
				if ($result === false)
					return ' <strong>' . $image->filename . ' ' . __('(Error : Couldn\'t not update data base)', 'flash-album-gallery') . '</strong>';

				//this flag will inform us the import is already one time performed
				$meta['common']['saved']  = true;
				$result = flagdb::update_image_meta($image->pid, $meta['common']);

				if ($result === false)
					return ' <strong>' . $image->filename . ' ' . __('(Error : Couldn\'t not update meta data)', 'flash-album-gallery') . '</strong>';
			} else
				return ' <strong>' . $image->filename . ' ' . __('(Error : Couldn\'t not find image)', 'flash-album-gallery') . '</strong>';// error check
		}

		return '1';

	}

	/**
	 * Copy some metadata into the image description (if avialable)
	 *
	 * @class flagAdmin
	 * @param array|int $imagesIds
	 * @return bool
	 */
	public static function copy_MetaData($imagesIds) {

		global $wpdb;

		/** @var $meta */
		require_once(FLAG_ABSPATH . 'lib/meta.php');
		require_once(FLAG_ABSPATH . 'lib/image.php');

		if (!is_array($imagesIds))
			$imagesIds = array($imagesIds);

		foreach($imagesIds as $imageID) {

			$image = flagdb::find_image($imageID);
			if (!$image->error) {
				/** @var $makedescription
				 *  @var $timestamp */
				require_once(FLAG_ABSPATH . 'admin/grab_meta.php');

				// get the title
				$alttext = empty( $alttext ) ? $image->alttext : $meta['title'];
				if($alttext) $alttext = '<font size="16"><b>'.$alttext."</b></font>\n";
				// get the caption / description field
				$description = empty($description ) ? $image->description : $meta['caption'];
				if($description) $description = $description."<br>\n";
				// get the file date/time from exif
				$makedescription = $alttext.$description.$makedescription;
				// update database
				$result = $wpdb->query( $wpdb->prepare("UPDATE $wpdb->flagpictures SET alttext = %s, description = %s, imagedate = %s WHERE pid = %d", '', $makedescription, $timestamp, $image->pid) );
				if ($result === false)
					return ' <strong>' . $image->filename . ' ' . __('(Error : Couldn\'t not update data base)', 'flash-album-gallery') . '</strong>';

			} else
				return ' <strong>' . $image->filename . ' ' . __('(Error : Couldn\'t not find image)', 'flash-album-gallery') . '</strong>';// error check
		}

		return '1';

	}

	/**
	 * flagAdmin::get_MetaData()
	 *
	 * @class flagAdmin
	 * @require Meta class
	 * @param $id
	 * @return array metadata
	 */
	public static function get_MetaData($id) {

		require_once(FLAG_ABSPATH . 'lib/meta.php');

		$meta = array();

		$pdata = new flagMeta( $id );

		$meta['title'] = trim ( $pdata->get_META('title') );
		$meta['caption'] = trim ( $pdata->get_META('caption') );
		$meta['keywords'] = trim ( $pdata->get_META('keywords') );
		$meta['timestamp'] = $pdata->get_date_time();
		// this contain other useful meta information
		$meta['common'] = $pdata->get_common_meta();

		return $meta;

	}

	/**
	 * Maybe import some meta data to the database. The functions checks the flag 'saved'
	 * and if based on compat reason (pre V0.40) we save then some meta datas to the database
	 *
	 * @param int $id
	 * @return mixed  result
	 */
	public static function maybe_import_meta( $id ) {

		require_once(FLAG_ABSPATH . 'lib/meta.php');

		$meta_obj = new flagMeta( $id );

		if ( $meta_obj->image->meta_data['saved'] != true ) {
			$common = $meta_obj->get_common_meta();
			//this flag will inform us that the import is already one time performed
			$common['saved']  = true;
			$result = flagdb::update_image_meta($id, $common);
		} else
			return false;

		return $result;

	}

	/**
	 * flagAdmin::getOnlyImages()
	 *
	 * @class flagAdmin
	 * @param mixed $p_event
	 * @param mixed $p_header
	 * @return bool
	 */
	public static function getOnlyImages($p_event, $p_header)	{

		$info = pathinfo($p_header['filename']);
		// check for extension
		$ext = array('jpeg', 'jpg', 'png', 'gif');
		if ( in_array( strtolower($info['extension']), $ext) ) {
			// For MAC skip the ".image" files
			if ($info['basename']{0} ==  '.' )
				return 0;
			else
				return 1;
		}
		// ----- all other files are skipped
		else {
		  return 0;
		}
	}

	/**
	 * Function for uploading of images via the upload form
	 *
	 * @class flagAdmin
	 * @return void
	 */
	public static function upload_images() {

		global $wpdb;

		// WPMU action
		if (flagAdmin::check_quota())
			return;

		// Images must be an array
		$imageslist = array();

		// get selected gallery
		$galleryID = (int) $_POST['galleryselect'];

		if ($galleryID == 0) {
			flagGallery::show_error(__('No gallery selected !','flash-album-gallery'));
			return;
		}

		// get the path to the gallery
		$gallery = flagdb::find_gallery($galleryID);

		if ( empty($gallery->path) ){
			flagGallery::show_error(__('Failure in database, no gallery path set !','flash-album-gallery'));
			return;
		}

		// read list of images
		$dirlist = flagAdmin::scandir(WINABSPATH.$gallery->path);

		$imagefiles = $_FILES['imagefiles'];

		if (is_array($imagefiles)) {
			foreach ($imagefiles['name'] as $key => $value) {

				// look only for uploded files
				if ($imagefiles['error'][$key] == 0) {

					$temp_file = $imagefiles['tmp_name'][$key];

					//clean filename and extract extension
					$filepart = flagGallery::fileinfo( $imagefiles['name'][$key] );
					$filename = sanitize_title($filepart['filename']) . '.' . $filepart['extension'];

					// check for allowed extension and if it's an image file
					$ext = array('jpg', 'jpeg', 'png', 'gif');
					if ( !in_array(strtolower($filepart['extension']), $ext) || !@getimagesize($temp_file) ){
						flagGallery::show_error('<strong>' . $imagefiles['name'][$key] . ' </strong>' . __('is no valid image file!','flash-album-gallery'));
						continue;
					}

					// check if this filename already exist in the folder
					$i = 0;
					while ( in_array( $filename, $dirlist ) ) {
						$filename = $filepart['filename'] . '_' . $i++ . '.' .$filepart['extension'];
					}

					$dest_file = $gallery->abspath . '/' . $filename;

					//check for folder permission
					if ( !is_writeable($gallery->abspath) ) {
						$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'flash-album-gallery'), $gallery->abspath);
						flagGallery::show_error($message);
						return;
					}

					// save temp file to gallery
					if ( !@move_uploaded_file($temp_file, $dest_file) ){
						if( !file_exists($dest_file)){
							flagGallery::show_error(__('Error, the file could not moved to : ','flash-album-gallery') . $dest_file);
							flagAdmin::check_safemode( $gallery->abspath );
							continue;
						}
					}
					if ( !flagAdmin::chmod($dest_file) ) {
						flagGallery::show_error(__('Error, the file permissions could not set','flash-album-gallery'));
						continue;
					}

					// add to imagelist & dirlist
					$imageslist[] = $filename;
					$dirlist[] = $filename;
				}
			}
		}

		if (count($imageslist) > 0) {

			// add images to database
			$image_ids = flagAdmin::add_Images($galleryID, $imageslist);

			//create thumbnails
			flagAdmin::do_ajax_operation( 'create_thumbnail' , $image_ids, __('Create new thumbnails','flash-album-gallery') );
			//add the preview image if needed
			flagAdmin::set_gallery_preview ( $galleryID );

			flagGallery::show_message( count($image_ids) . __(' Image(s) successfully added','flash-album-gallery'));
		}

		return;

	} // end function

	/**
	 * Upload function will be called via the Flash uploader
	 *
	 * @class flagAdmin
	 * @param integer $galleryID
	 * @return string $result
	 */
	static function swfupload_image($galleryID = 0) {

		global $wpdb, $flag;

		if ($galleryID == 0) {
			//@unlink($temp_file);
			return __('No gallery selected!','flash-album-gallery');
		}

		// WPMU action
		if (flagAdmin::check_quota())
			return '0';

		// Check the upload
		if (!isset($_FILES['file']) || !is_uploaded_file($_FILES["file"]["tmp_name"]) || $_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
			return flagAdmin::file_upload_error_message( $_FILES['file']['error'] );
		}

		// get the filename and extension
		$temp_file = $_FILES["file"]['tmp_name'];

		$filepart = flagGallery::fileinfo( $_FILES['file']['name'] );
		$filename = sanitize_title($filepart['filename']) . '.' . $filepart['extension'];

		// check for allowed extension
		$ext = array('jpeg', 'jpg', 'png', 'gif');
		if (!in_array(strtolower($filepart['extension']), $ext)){
			if(!@getimagesize($temp_file))
				return $filename . ' '. __('is no valid image file!','flash-album-gallery');
		}

		// get the path to the gallery
		$gallerypath = $wpdb->get_var($wpdb->prepare("SELECT path FROM {$wpdb->flaggallery} WHERE gid = %d ", $galleryID));
		if (!$gallerypath){
			@unlink($temp_file);
			return __('Failure in database, no gallery path set !','flash-album-gallery');
		}

		// read list of images
		$imageslist = flagAdmin::scandir( WINABSPATH.$gallerypath );

		// check if this filename already exist
		$i = 0;
		while (in_array($filename,$imageslist)) {
			$filename = sanitize_title($filepart['filename']) . '_' . $i++ . '.' . $filepart['extension'];
		}

		$dest_file = WINABSPATH . $gallerypath . '/' . $filename;

		// save temp file to gallery
		if ( !@move_uploaded_file($temp_file, $dest_file) ){
			if( !file_exists($dest_file)){
				flagAdmin::check_safemode(WINABSPATH.$gallerypath);
				return __('Error, the file could not moved to : ','flash-album-gallery').$dest_file;
			}
		}

		if ( !flagAdmin::chmod($dest_file) )
			return __('Error, the file permissions could not set','flash-album-gallery');

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $angle      = 0;
        $image_meta = wp_read_image_metadata($dest_file);
        if(!empty($image_meta['orientation'])){
            switch($image_meta['orientation']){
                case 3:
                    $angle = 180;
                break;
                case 6:
                    $angle = 270;
                break;
                case 8:
                    $angle = 90;
                break;
            }
        }
        if($angle){
            $editor = wp_get_image_editor($dest_file);
            if(!is_wp_error($editor)){
                $editor->rotate($angle);
                $editor->set_quality(90);
                $editor->save($dest_file);
            }
        }

		// add images to database
		$image_ids = flagAdmin::add_Images($galleryID, array($filename));
		$return = '';
		//create thumbnails

		//save the thumb size values
		$flag->options['thumbWidth']  = intval($_POST['thumbw'])? intval($_POST['thumbw']) : 300;
		$flag->options['thumbHeight'] = intval($_POST['thumbh'])? intval($_POST['thumbh']) : 300;
		update_option('flag_options', $flag->options);

		foreach($image_ids as $picture){
			$return = flagAdmin::create_thumbnail($picture);
		}
		//add the preview image if needed
		if(intval($_POST['last']) == 1)
			flagAdmin::set_gallery_preview ( $galleryID );

		return (intval($return) == 1)? '' : $return;

	}

	/**
	 * File upload error message
	 *
	 * @class flagAdmin
	 * @param $error_code
	 * @return string $result
	 */
    public static function file_upload_error_message($error_code) {
		switch ($error_code) {
			case UPLOAD_ERR_INI_SIZE:
				return __('The uploaded file exceeds the upload_max_filesize directive in php.ini','flash-album-gallery');
			case UPLOAD_ERR_FORM_SIZE:
				return __('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form','flash-album-gallery');
			case UPLOAD_ERR_PARTIAL:
				return __('The uploaded file was only partially uploaded','flash-album-gallery');
			case UPLOAD_ERR_NO_FILE:
				return __('No file was uploaded','flash-album-gallery');
			case UPLOAD_ERR_NO_TMP_DIR:
				return __('Missing a temporary folder','flash-album-gallery');
			case UPLOAD_ERR_CANT_WRITE:
				return __('Failed to write file to disk','flash-album-gallery');
			case UPLOAD_ERR_EXTENSION:
				return __('File upload stopped by extension','flash-album-gallery');
			default:
				return __('Unknown upload error','flash-album-gallery');
		}
	}

	/**
	 * Check the Quota under WPMU. Only needed for this case
	 *
	 * @class flagAdmin
	 * @return bool $result
	 */
    public static function check_quota() {

			if ( (IS_WPMU) && flagGallery::flag_wpmu_enable_function('wpmuQuotaCheck'))
				if( $error = upload_is_user_over_quota( false ) ) {
					flagGallery::show_error( __( 'Sorry, you have used your space allocation. Please delete some files to upload more files.','flash-album-gallery' ) );
					return true;
				}
			return false;
	}

	/**
	 * Set correct file permissions (taken from wp core)
	 *
	 * @class flagAdmin
	 * @param string $filename
	 * @return bool $result
	 */
	public static function chmod($filename = '') {

		$stat = @ stat(dirname($filename));
		$perms = $stat['mode'] & 0007777;
		$perms = $perms & 0000666;
		if ( @chmod($filename, $perms) )
			return true;

		return false;
	}

	/**
	 * Check UID in folder and Script
	 * Read http://www.php.net/manual/en/features.safe-mode.php to understand safe_mode
	 *
	 * @class flagAdmin
	 * @param string $foldername
	 * @return bool $result
	 */
	public static function check_safemode($foldername) {

		if ( FLAG_SAFE_MODE ) {

			//$script_uid = ( ini_get('safe_mode_gid') ) ? getmygid() : getmyuid();
			$script_uid = getmyuid();
			$folder_uid = fileowner($foldername);

			if ($script_uid != $folder_uid) {
				$message  = sprintf(__('SAFE MODE Restriction in effect! You need to create the folder <strong>%s</strong> manually','flash-album-gallery'), $foldername);
				$message .= '<br />' . sprintf(__('When safe_mode is on, PHP checks to see if the owner (%s) of the current script matches the owner (%s) of the file to be operated on by a file function or its directory','flash-album-gallery'), $script_uid, $folder_uid );
				flagGallery::show_error($message);
				return false;
			}
		}

		return true;
	}

	/**
	 * Capability check. Check is the ID fit's to the user_ID
	 *
	 * @class flagAdmin
	 * @param int $check_ID is the user_id
	 * @return bool $result
	 */
	public static function can_manage_this_gallery($check_ID) {

		global $user_ID, $wp_roles;

		if ( !current_user_can('FlAG Manage others gallery') ) {
			// get the current user ID
            wp_get_current_user();

			if ( $user_ID != $check_ID)
				return false;
		}
		return true;
	}

	/**
	 * Move images from one folder to another
	 *
	 * @param array|int $pic_ids ID's of the images
	 * @param int $dest_gid destination gallery
	 * @return void
	 */
	public static function move_images($pic_ids, $dest_gid) {

		$errors = '';
		$count = 0;

		if (!is_array($pic_ids))
			$pic_ids = array($pic_ids);

		// Get destination gallery
		$destination  = flagdb::find_gallery( $dest_gid );
		$dest_abspath = WINABSPATH . $destination->path;

		if ( $destination == null ) {
			flagGallery::show_error(__('The destination gallery does not exist','flash-album-gallery'));
			return;
		}

		// Check for folder permission
		if ( !is_writeable( $dest_abspath ) ) {
			$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'flash-album-gallery'), $dest_abspath );
			flagGallery::show_error($message);
			return;
		}

		// Get pictures
		$images = flagdb::find_images_in_list($pic_ids);

		foreach ($images as $image) {

			$i = 0;
			$tmp_prefix = '';

			$destination_file_name = $image->filename;
			// check if the filename already exist, then we add a copy_ prefix
			while (file_exists( $dest_abspath . '/' . $destination_file_name)) {
				$tmp_prefix = 'copy_' . ($i++) . '_';
				$destination_file_name = $tmp_prefix . $image->filename;
			}

			$destination_path = $dest_abspath . '/' . $destination_file_name;
			$destination_thumbnail = $dest_abspath . '/thumbs/thumbs_' . $destination_file_name;

			// Move files
			if ( !@rename($image->imagePath, $destination_path) ) {
				$errors .= sprintf(__('Failed to move image %1$s to %2$s','flash-album-gallery'),
					'<strong>' . $image->filename . '</strong>', $destination_path) . '<br />';
				continue;
			}

			// Move the thumbnail, if possible
			@rename($image->thumbPath, $destination_thumbnail);

			// Change the gallery id in the database , maybe the filename
			if ( flagdb::update_image($image->pid, $dest_gid, $destination_file_name) )
				$count++;

		}

		if ( $errors != '' )
			flagGallery::show_error($errors);

		$link = '<a href="' . admin_url() . 'admin.php?page=flag-manage-gallery&mode=edit&gid=' . $destination->gid . '" >' . $destination->title . '</a>';
		$messages  = sprintf(__('Moved %1$s picture(s) to gallery : %2$s .','flash-album-gallery'), $count, $link);
		flagGallery::show_message($messages);

		return;
	}

	/**
	 * Copy images to another gallery
	 *
	 * @class flagAdmin
	 * @param array|int $pic_ids ID's of the images
	 * @param int $dest_gid destination gallery
	 * @return void
	 */
	public static function copy_images($pic_ids, $dest_gid) {

		$errors = $messages = '';

		if (!is_array($pic_ids))
			$pic_ids = array($pic_ids);

		// Get destination gallery
		$destination = flagdb::find_gallery( $dest_gid );
		if ( $destination == null ) {
			flagGallery::show_error(__('The destination gallery does not exist','flash-album-gallery'));
			return;
		}

		// Check for folder permission
		if (!is_writeable(WINABSPATH.$destination->path)) {
			$message = sprintf(__('Unable to write to directory %s. Is this directory writable by the server?', 'flash-album-gallery'), WINABSPATH.$destination->path);
			flagGallery::show_error($message);
			return;
		}

		// Get pictures
		$images = flagdb::find_images_in_list($pic_ids);
		$destination_path = WINABSPATH . $destination->path;

		foreach ($images as $image) {
			// WPMU action
			if ( flagAdmin::check_quota() )
				return;

			$i = 0;
			$tmp_prefix = '';
			$destination_file_name = $image->filename;
			while (file_exists($destination_path . '/' . $destination_file_name)) {
				$tmp_prefix = 'copy_' . ($i++) . '_';
				$destination_file_name = $tmp_prefix . $image->filename;
			}

			$destination_file_path = $destination_path . '/' . $destination_file_name;
			$destination_thumb_file_path = $destination_path . '/' . $image->thumbFolder . $image->thumbPrefix . $destination_file_name;

			// Copy files
			if ( !@copy($image->imagePath, $destination_file_path) ) {
				$errors .= sprintf(__('Failed to copy image %1$s to %2$s','flash-album-gallery'),
					$image->filename, $destination_file_path) . '<br />';
				continue;
			}

			// Copy the thumbnail if possible
			@copy($image->thumbPath, $destination_thumb_file_path);

			// Create new database entry for the image
			$new_pid = flagdb::insert_image( $destination->gid, $destination_file_name, $image->alttext, $image->description, $image->exclude);

			if (!isset($new_pid)) {
				$errors .= sprintf(__('Failed to copy database row for picture %s','flash-album-gallery'), $image->pid) . '<br />';
				continue;
			}

			if ( $tmp_prefix != '' ) {
				$messages .= sprintf(__('Image %1$s (%2$s) copied as image %3$s (%4$s) &raquo; The file already existed in the destination gallery.','flash-album-gallery'),
					 $image->pid, $image->filename, $new_pid, $destination_file_name) . '<br />';
			} else {
				$messages .= sprintf(__('Image %1$s (%2$s) copied as image %3$s (%4$s)','flash-album-gallery'),
					 $image->pid, $image->filename, $new_pid, $destination_file_name) . '<br />';
			}

		}

		// Finish by showing errors or success
		if ( $errors == '' ) {
			$link = '<a href="' . admin_url() . 'admin.php?page=flag-manage-gallery&mode=edit&gid=' . $destination->gid . '" >' . $destination->title . '</a>';
			$messages .= '<hr />' . sprintf(__('Copied %1$s picture(s) to gallery: %2$s .','flash-album-gallery'), count($images), $link);
		}

		if ( $messages != '' )
			flagGallery::show_message($messages);

		if ( $errors != '' )
			flagGallery::show_error($errors);

		return;
	}

	/**
	 * Initate the Ajax operation
	 *
	 * @class flagAdmin
	 * @param string $operation name of the function which should be executed
	 * @param array $image_array
	 * @param string $title name of the operation
	 * @return string the javascript output
	 */
	public static function do_ajax_operation( $operation, $image_array, $title = '' ) {

		if ( !is_array($image_array) || empty($image_array) )
			return;

		$js_array  = implode('","', $image_array);

		// send out some JavaScript, which initate the ajax operation
		?>
		<script type="text/javascript">

			Images = new Array("<?php echo $js_array; ?>");

			flagAjaxOptions = {
				operation: "<?php echo $operation; ?>",
				ids: Images,
			  	header: "<?php echo $title; ?>",
			  	maxStep: Images.length
			};

			jQuery(document).ready( function(){
				flagProgressBar.init( flagAjaxOptions );
				flagAjax.init( flagAjaxOptions );
			} );
		</script>

		<div id="progressbar_container" class="wrap"></div>

		<?php
	}

	/**
	 * flagAdmin::set_gallery_preview() - define a preview pic after the first upload, can be changed in the gallery settings
	 *
	 * @class flagAdmin
	 * @param int $galleryID
	 * @return void
	 */
	public static function set_gallery_preview( $galleryID ) {
  	global $wpdb;

		$galleryID = intval($galleryID);
		$gallery = flagdb::find_gallery( $galleryID );

		// in the case no preview image is setup, we do this now
		if ($gallery->previewpic == 0) {
			$firstImage = $wpdb->get_var($wpdb->prepare("SELECT `pid` FROM `{$wpdb->flagpictures}` WHERE `exclude` != 1 AND `galleryid` = '%d' ORDER by `pid` DESC limit 0,1", $galleryID));
			if ($firstImage) {
				$wpdb->query($wpdb->prepare("UPDATE `{$wpdb->flaggallery}` SET `previewpic` = '%s' WHERE `gid` = '%d'", $firstImage, $galleryID));
				wp_cache_delete($galleryID, 'flag_gallery');
			}
		}

		return;
	}

	/**
	 * Return a JSON coded array of Image ids for a requested gallery
	 *
	 * @param int $galleryID
	 * @return array (JSON)
	 */
	public static function get_image_ids( $galleryID ) {

		if ( !function_exists('json_encode') )
			return(-2);

		$gallery = flagdb::get_ids_from_gallery($galleryID, 'pid', 'ASC', false);

		header('Content-Type: text/plain; charset=' . get_option('blog_charset'), true);
		$output = json_encode($gallery);

		return $output;
	}

} // END class flagAdmin
}
