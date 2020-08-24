<?php
function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}


// for resize image according to width
function createScaledImage($sourcePath, $destinationPath, $width) {
    $imageInfo = getimagesize($sourcePath);
    
    if ($imageInfo === false) {
        return false;
    }
    
    $imageType = $imageInfo[2];
    $image = null;
    
    if($imageType == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($sourcePath);
    } else if ($imageType == IMAGETYPE_GIF) {
        $image = imagecreatefromgif($sourcePath);
    } else if ($imageType == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($sourcePath);
    }
    
    if ($image !== null) {
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $scalingFactor = $width / $imageWidth;
        $height = $imageHeight * $scalingFactor;
        $newImage = imagecreatetruecolor($width, $height);

        imagecopyresampled($newImage, $image, 0, 0, 0, 0,
                           $width, $height, $imageWidth,
                           $imageHeight);

        if($imageType == IMAGETYPE_JPEG) {
            return imagejpeg($newImage, $destinationPath);
        } else if ($imageType == IMAGETYPE_GIF) {
            return imagegif($newImage, $destinationPath);
        } else if ($imageType == IMAGETYPE_PNG) {
            return imagepng($newImage, $destinationPath, 9);
        } else {
            return false;
        }

    }
    
    return false;
}


function create_cropped_thumbnail($image_path, $thumb_width, $thumb_height, $prefix) {

    if (!(is_integer($thumb_width) && $thumb_width > 0) && !($thumb_width === "*")) {
        echo "The width is invalid";
        exit(1);
    }

    if (!(is_integer($thumb_height) && $thumb_height > 0) && !($thumb_height === "*")) {
        echo "The height is invalid";
        exit(1);
    }

    $extension = pathinfo($image_path, PATHINFO_EXTENSION);
    switch ($extension) {
        case "jpg":
        case "jpeg":
            $source_image = imagecreatefromjpeg($image_path);
            break;
        case "gif":
            $source_image = imagecreatefromgif($image_path);
            break;
        case "png":
            $source_image = imagecreatefrompng($image_path);
            break;
        default:
            exit(1);
            break;
    }

    $source_width = imageSX($source_image);
    $source_height = imageSY($source_image);

    if (($source_width / $source_height) == ($thumb_width / $thumb_height)) {
        $source_x = 0;
        $source_y = 0;
    }

    if (($source_width / $source_height) > ($thumb_width / $thumb_height)) {
        $source_y = 0;
        $temp_width = $source_height * $thumb_width / $thumb_height;
        $source_x = ($source_width - $temp_width) / 2;
        $source_width = $temp_width;
    }

    if (($source_width / $source_height) < ($thumb_width / $thumb_height)) {
        $source_x = 0;
        $temp_height = $source_width * $thumb_height / $thumb_width;
        $source_y = ($source_height - $temp_height) / 2;
        $source_height = $temp_height;
    }

    $target_image = ImageCreateTrueColor($thumb_width, $thumb_height);

    imagecopyresampled($target_image, $source_image, 0, 0, $source_x, $source_y, $thumb_width, $thumb_height, $source_width, $source_height);

    switch ($extension) {
        case "jpg":
        case "jpeg":
            imagejpeg($target_image, $image_path);
            break;
        case "gif":
            imagegif($target_image,  $image_path);
            break;
        case "png":
            imagepng($target_image,  $image_path);
            break;
        default:
            exit(1);
            break;
    }

    imagedestroy($target_image);
    imagedestroy($source_image);
}

// Function to scale an image by scaling factor! The proportions
// of the image width and height are kept the same.
// The scaling factor should be a float number between 0 and 1
// to make the image smaller and bigger than 1 to make the image larger.
// Supports jpeg, png and gif images

function createScaledImage_crop($sourcePath, $destinationPath, $scalingFactor) {
    $imageInfo = getimagesize($sourcePath);
    
    if ($imageInfo === false) {
        return false;
    }
    
    $imageType = $imageInfo[2];
    $image = null;
    
    if($imageType == IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($sourcePath);
    } else if ($imageType == IMAGETYPE_GIF) {
        $image = imagecreatefromgif($sourcePath);
    } else if ($imageType == IMAGETYPE_PNG) {
        $image = imagecreatefrompng($sourcePath);
    }
    
    if ($image !== null) {
        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);
        $width = $imageWidth * $scalingFactor;
        $height = $imageHeight * $scalingFactor;
        $newImage = imagecreatetruecolor($width, $height);

        imagecopyresampled($newImage, $image, 0, 0, 0, 0,
                           $width, $height, $imageWidth,
                           $imageHeight);

        if($imageType == IMAGETYPE_JPEG) {
            return imagejpeg($newImage, $destinationPath);
        } else if ($imageType == IMAGETYPE_GIF) {
            return imagegif($newImage, $destinationPath);
        } else if ($imageType == IMAGETYPE_PNG) {
            return imagepng($newImage, $destinationPath, 9);
        } else {
            return false;
        }

    }
    
    return false;
}

//exact thumb
 function makeThumbnails($updir, $img,  $destDir,$thumbnail_width,$thumbnail_height)
    {    
        //$thumbnail_width = 134;
        //        $thumbnail_height = 189;
        $thumb_beforeword = "thumb";
        $arr_image_details = getimagesize($updir.$img); // pass id to thumb name
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];
        //if ($original_width > $original_height) {
            $new_width = $thumbnail_width;
            $new_height = $thumbnail_height;
            /*$new_height = intval($original_height * $new_width / $original_width);
        } else {
            $new_height = $thumbnail_height;
            $new_width = intval($original_width * $new_height / $original_height);
        }*/
        $dest_x = intval(($thumbnail_width - $new_width) / 2);
        $dest_y = intval(($thumbnail_height - $new_height) / 2);
        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }
        if ($imgt) {
            $old_image = $imgcreatefrom($updir.$img);
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
            imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
            $imgt($new_image, $destDir.$img);
        }
    }
?>