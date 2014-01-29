<?php
/**
 * Elgg wines plugin edit action.
 *
 * @package ElggWine
 */

//elgg_make_sticky_form('groups');

/**
 * wrapper for recursive array walk decoding
 */

elgg_push_context('create_wine');
function profile_array_decoder(&$v) {
	$v = _elgg_html_decode($v);
}

// Get wine fields
$input = array();
foreach (elgg_get_config('wine') as $shortname => $valuetype) {
	// another work around for Elgg's encoding problems: #561, #1963
	$input[$shortname] = get_input($shortname);
	if (is_array($input[$shortname])) {
		array_walk_recursive($input[$shortname], 'profile_array_decoder');
	} else {
                $input[$shortname] = _elgg_html_decode($input[$shortname]);
	}

	if ($valuetype == 'tags') {
		$input[$shortname] = string_to_tag_array($input[$shortname]);
	}
}

$input['domaine'] = get_input('domaine');
$input['domaine'] = _elgg_html_decode($input['domaine']);


$user = elgg_get_logged_in_user_entity();

$wine_guid = (int)get_input('wine_guid');


$is_new_wine = $wine_guid == 0;

if ($is_new_wine
		&& (elgg_get_plugin_setting('limited_groups', 'wine') == 'yes')
		&& !$user->isAdmin()) {
	register_error(elgg_echo("groups:cantcreate"));
	forward(REFERER);
}



/*$new_wine_flag = $wine_guid == 0;*/

$wine = new ElggWine($wine_guid); // load if present, if not create a new wine
if (($wine_guid) && (!$wine->canEdit())) {
	register_error(elgg_echo("wine:cantedit"));

	forward(REFERER);
}

// Assume we can edit or this is a new wine
if (sizeof($input) > 0) {
	foreach($input as $shortname => $value) {
		$wine->$shortname = $value;
	}
}





// Validate create
if (!$wine->domaine) {
	register_error(elgg_echo("wine:notitle"));

	forward(REFERER);
}







// Set group tool options
$tool_options = elgg_get_config('group_tool_options');
if ($tool_options) {
	foreach ($tool_options as $wine_option) {
		$option_toggle_name = $wine_option->name . "_enable";
		$option_default = $wine_option->default_on ? 'yes' : 'no';
		$wine->$option_toggle_name = get_input($option_toggle_name, $option_default);
	}
}



if ($is_new_wine) {
	$wine->access_id = ACCESS_PUBLIC;
}


$wine->membership = ACCESS_PUBLIC;
		
	
$wine->name=$wine->domaine;
if ($wine->cuvee){
    $wine->name.=" "."\"$wine->cuvee\"";
}
$wine->description=$wine->appellation." ".$wine->region." ".$wine->maker." ".$wine->country;

$wine->save();


$error_auto=get_input('error_autocomplete');
if ($error_auto=="-1") {
    $admins=elgg_get_admins();
    foreach($admins as $admin) {
        notify_user($admin->getGUID(),
				elgg_get_logged_in_user_guid(),
				elgg_echo('error_auto:email:subject'),
				elgg_echo('error_auto:email:body', array($wine->getURL()))
			);
    }
    
}


elgg_pop_context();

// Invisible wine support
// @todo this requires save to be called to create the acl for the wine. This
// is an odd requirement and should be removed. Either the acl creation happens
// in the action or the visibility moves to a plugin hook
if (elgg_get_plugin_setting('hidden_groups', 'wine') == 'yes') {
	$visibility = (int)get_input('vis', '', false);
	if ($visibility != ACCESS_PUBLIC && $visibility != ACCESS_LOGGED_IN) {
		$visibility = $wine->group_acl;
	}

	if ($wine->access_id != $visibility) {
		$wine->access_id = $visibility;
	}
}
/*if ($is_new_wine) { 
 $admins=  elgg_get_admins();
 $admin=$admins[0];
 $wine->owner_guid=$admin->getGUID();
 $wine->container_guid=$admin->getGUID();
 
}*/
$wine->save();
// group saved so clear sticky form
//elgg_clear_sticky_form('groups');

// wine creator needs to be member of new wine and river entry created
if ($is_new_wine) {
	elgg_set_page_owner_guid($wine->guid);
	$wine->join($user);
	add_to_river('river/wine/create', 'create', $user->guid, $wine->guid);
}

// Now see if we have a file icon
if ((isset($_FILES['photo'])) && (substr_count($_FILES['photo']['type'],'image/'))) {
        
        if($_FILES['photo']['size'] /1024 > 4096) {
             register_error(elgg_echo('file:cannotload:toobig'));
             forward($_SERVER['HTTP_REFERER']);
        }

        
      $exif = exif_read_data($_FILES['photo']['tmp_name'], 'IFDO', true);
      $orientation = $exif['IFD0']['Orientation'];;
      if($orientation != 0) {
      ini_set('memory_limit', '128M');
      $image = imagecreatefromstring(file_get_contents($_FILES['photo']['tmp_name']));
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
       imagejpeg($image, $_FILES['photo']['tmp_name']);
}
        
        
	$file = new FilePluginFile();
	
	$file->access_id = ACCESS_PUBLIC;
        $file->container_guid = $wine->guid;

        $prefix = "file/";
        
        $filestorename = elgg_strtolower(time().$_FILES['photo']['name']);
        
	$file->setFilename($prefix . $filestorename);
	$mime_type = ElggFile::detectMimeType($_FILES['photo']['tmp_name'], $_FILES['photo']['type']);



	$file->setMimeType($mime_type);
	$file->originalfilename = $_FILES['photo']['name'];
	$file->simpletype = file_get_simple_type($mime_type);

	// Open the file to guarantee the directory exists
	/*$file->open("write");
	$file->close();
	move_uploaded_file($_FILES['photo']['tmp_name'], $file->getFilenameOnFilestore());*/

	$guid = $file->save();
        
        $filehandler = new ElggFile();
	$filehandler->setFilename($prefix . $filestorename);
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('photo'));
	$filehandler->close();

	// if image, we need to create thumbnails (this should be moved into a function)
	if ($guid && $file->simpletype == "image") {
		$file->icontime = time();

		$thumbnail = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), 60, 60, true);
		if ($thumbnail) {
			$thumb = new ElggFile();
			$thumb->setMimeType($_FILES['photo']['type']);

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
        $filehandler->delete();
    }






system_message(elgg_echo("wine:saved"));

forward($wine->getUrl());