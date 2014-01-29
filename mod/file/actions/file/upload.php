<?php
/**
 * Elgg file uploader/edit action
 *
 * @package ElggFile
 */

// Get variables
$title = htmlspecialchars(get_input('title', '', false), ENT_QUOTES, 'UTF-8');
//$desc = get_input("description");
//$access_id = (int) get_input("access_id");
$container_guid = (int) get_input('container_guid', 0);
$guid = (int) get_input('file_guid');
//$tags = get_input("tags");

if ($container_guid == 0) {
	$container_guid = elgg_get_logged_in_user_guid();
}

elgg_make_sticky_form('file');

// check if upload failed
if (!empty($_FILES['upload']['name']) && $_FILES['upload']['error'] != 0) {
	register_error(elgg_echo('file:cannotload'));
	forward(REFERER);
}
$new_file = true;
if ($new_file) {
	// must have a file if a new file upload
	if (empty($_FILES['upload']['name'])) {
		$error = elgg_echo('file:nofile');
		register_error($error);
		forward(REFERER);
	}
        
        $filetypes =  "/^\.(jpg|jpeg|gif|png){1}$/i";
        if(!$match = preg_match($filetypes, strrchr($_FILES['upload']['name'], '.'))) {
                register_error(elgg_echo('file:cannotload:notapic'));
                forward($_SERVER['HTTP_REFERER']);
        }
        
        if($_FILES['photo']['size'] /1024 > 4096) {
             register_error(elgg_echo('file:cannotload:toobig'));
             forward($_SERVER['HTTP_REFERER']);
        }
             
        $file = new FilePluginFile();
	
	// if no title on new upload, grab filename
	if (empty($title)) {
		$title = htmlspecialchars($_FILES['upload']['name'], ENT_QUOTES, 'UTF-8');
	}

}/* else {
	// load original file object
	$file = new FilePluginFile($guid);
	if (!$file) {
		register_error(elgg_echo('file:cannotload'));
		forward(REFERER);
	}

	// user must be able to edit file
	if (!$file->canEdit()) {
		register_error(elgg_echo('file:noaccess'));
		forward(REFERER);
	}

	if (!$title) {
		// user blanked title, but we need one
		$title = $file->title;
	}
}*/

$file->title = $title;
//$file->description = $desc;
//$file->access_id = $access_id;
$file->access_id = ACCESS_PUBLIC;
$file->container_guid = $container_guid;



// we have a file upload, so process it
if (isset($_FILES['upload']['name']) && !empty($_FILES['upload']['name'])) {

	$prefix = "file/";

/* Rotation de l'image si besoin est*/	
        
      $exif = exif_read_data($_FILES['upload']['tmp_name'], 'IFDO', true);
      $orientation = $exif['IFD0']['Orientation'];;
      if($orientation != 0) {
      ini_set('memory_limit', '128M');
      $image = imagecreatefromstring(file_get_contents($_FILES['upload']['tmp_name']));
      switch($orientation) {
          case 8:
             $image = imagerotate($image,90,0);
             break;
          case 3:
             $image = imagerotate($image,180,0);
             break;
          case 6:
             $image = imagerotate($image,-90,0);
             break;
       }
       imagejpeg($image, $_FILES['upload']['tmp_name']);
}
        
        
        
        
	$filestorename = elgg_strtolower(time().$_FILES['upload']['name']);
	

	$file->setFilename($prefix . $filestorename);
	$mime_type = ElggFile::detectMimeType($_FILES['upload']['tmp_name'], $_FILES['upload']['type']);
       
        /*en attendant Fileinfo*/
        if(($mime_type=="application/octet-stream") && ($info = getimagesize($_FILES['upload']['tmp_name']))) 
        	$mime_type= image_type_to_mime_type($info[2]);
    	
	
        
        $file->setMimeType($mime_type);
	$file->originalfilename = $_FILES['upload']['name'];
	$file->simpletype = file_get_simple_type($mime_type);

	// Open the file to guarantee the directory exists
	//$file->open("write");
	//$file->close();
	//move_uploaded_file($_FILES['upload']['tmp_name'], $file->getFilenameOnFilestore());

	$guid = $file->save();
        
        $filehandler = new ElggFile();
	$filehandler->setFilename($prefix . $filestorename);
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('upload'));
	$filehandler->close();
        
        

	// if image, we need to create thumbnails (this should be moved into a function)
if ($guid && $file->simpletype == "image") {
		$file->icontime = time();
		
		$thumbnail = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 60, 60, true);
		if ($thumbnail) {
			$thumb = new ElggFile();
			$thumb->setMimeType($_FILES['upload']['type']);

			$thumb->setFilename($prefix."thumb".$filestorename);
			$thumb->open("write");
			$thumb->write($thumbnail);
			$thumb->close();

			$file->thumbnail = $prefix."thumb".$filestorename;
			unset($thumbnail);
		}

		$thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 153, 153, true);
		if ($thumbsmall) {
			$thumb->setFilename($prefix."smallthumb".$filestorename);
			$thumb->open("write");
			$thumb->write($thumbsmall);
			$thumb->close();
			$file->smallthumb = $prefix."smallthumb".$filestorename;
			unset($thumbsmall);
		}
                $thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 300, 300, false);
		if ($thumbmedium) {
			$thumb->setFilename($prefix."mediumthumb".$filestorename);
			$thumb->open("write");
			$thumb->write($thumbmedium);
			$thumb->close();
			$file->mediumthumb = $prefix."mediumthumb".$filestorename;
			unset($thumbmedium);
		}
		$thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 600, 600, false);
		if ($thumblarge) {
			$thumb->setFilename($prefix."largethumb".$filestorename);
			$thumb->open("write");
			$thumb->write($thumblarge);
			$thumb->close();
			$file->largethumb = $prefix."largethumb".$filestorename;
			unset($thumblarge);
		}
	}
} else {
	// not saving a file but still need to save the entity to push attributes to database
	$file->save();
}
$filehandler->delete();
// file saved so clear sticky form
elgg_clear_sticky_form('file');


// handle results differently for new files and file updates
if ($new_file) {
	if ($guid) {
		$message = elgg_echo("file:saved");
		system_message($message);
		//add_to_river('river/object/file/create', 'create', elgg_get_logged_in_user_guid(), $file->guid);
	} else {
		// failed to save file object - nothing we can do about this
		$error = elgg_echo("file:uploadfailed");
		register_error($error);
	}

	$container = get_entity($container_guid);
	if (elgg_instanceof($container, 'group','wine')) {
		forward("file/wine/$container->guid?list_type=gallery");
	} else {
		forward("file/owner/$container->username");
	}

} else {
	if ($guid) {
		system_message(elgg_echo("file:saved"));
	} else {
		register_error(elgg_echo("file:uploadfailed"));
	}

	forward("file/wine/$container->guid?list_type=gallery");
}	
