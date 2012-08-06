<?php
/**
 * Elgg restobars plugin edit action.
 *
 * @package ElggRestobar
 */

// Load configuration
global $CONFIG;

/**
 * wrapper for recursive array walk decoding
 */
function profile_array_decoder(&$v) {
	$v = html_entity_decode($v, ENT_COMPAT, 'UTF-8');
}

// Get restobar fields
$input = array();
foreach ($CONFIG->restobar as $shortname => $valuetype) {
	// another work around for Elgg's encoding problems: #561, #1963
	$input[$shortname] = get_input($shortname);
	if (is_array($input[$shortname])) {
		array_walk_recursive($input[$shortname], 'profile_array_decoder');
	} else {
		$input[$shortname] = html_entity_decode($input[$shortname], ENT_COMPAT, 'UTF-8');
	}

	if ($valuetype == 'tags') {
		$input[$shortname] = string_to_tag_array($input[$shortname]);
	}
}

$input['name'] = get_input('name');
$input['name'] = html_entity_decode($input['name'], ENT_COMPAT, 'UTF-8');

$user = elgg_get_logged_in_user_entity();

$restobar_guid = (int)get_input('restobar_guid');
$new_restobar_flag = $restobar_guid == 0;

$restobar = new ElggRestobar($restobar_guid); // load if present, if not create a new restobar
if (($restobar_guid) && (!$restobar->canEdit())) {
	register_error(elgg_echo("restobar:cantedit"));

	forward(REFERER);
}

// Assume we can edit or this is a new restobar
if (sizeof($input) > 0) {
	foreach($input as $shortname => $value) {
		$restobar->$shortname = $value;
	}
}

// Validate create
if (!$restobar->name) {
	register_error(elgg_echo("restobar:notitle"));

	forward(REFERER);
}


// Set restobar tool options
if (isset($CONFIG->group_tool_options)) {
	foreach ($CONFIG->group_tool_options as $restobar_option) {
		$restobar_option_toggle_name = $restobar_option->name . "_enable";
		if ($restobar_option->default_on) {
			$restobar_option_default_value = 'yes';
		} else {
			$restobar_option_default_value = 'no';
		}
		$restobar->$restobar_option_toggle_name = get_input($restobar_option_toggle_name, $restobar_option_default_value);
	}
}

// restobar membership - should these be treated with same constants as access permissions?
switch (get_input('membership')) {
	case ACCESS_PUBLIC:
		$restobar->membership = ACCESS_PUBLIC;
		break;
	default:
		$restobar->membership = ACCESS_PRIVATE;
}

if ($new_restobar_flag) {
	$restobar->access_id = ACCESS_PUBLIC;
}

$restobar->save();

// Invisible restobar support
// @todo this requires save to be called to create the acl for the restobar. This
// is an odd requirement and should be removed. Either the acl creation happens
// in the action or the visibility moves to a plugin hook
if (elgg_get_plugin_setting('hidden_groups', 'restobar') == 'yes') {
	$visibility = (int)get_input('vis', '', false);
	if ($visibility != ACCESS_PUBLIC && $visibility != ACCESS_LOGGED_IN) {
		$visibility = $restobar->group_acl;
	}

	if ($restobar->access_id != $visibility) {
		$restobar->access_id = $visibility;
	}
}

$restobar->save();

// restobar creator needs to be member of new restobar and river entry created
if ($new_restobar_flag) {
	elgg_set_page_owner_guid($restobar->guid);
	$restobar->join($user);
	add_to_river('river/restobar/create', 'create', $user->guid, $restobar->guid, $restobar->access_id);

// création de l'Objet restobarnews rattaché au restobar.
        $restobarnews=new ElggRestobarnews();
        $restobarnews->setContainerGUID($restobar->getGUID());
        $restobarnews->access_id=$restobar->access_id;
        $restobarnews->save();
        
}

// Now see if we have a file icon
if ((isset($_FILES['icon'])) && (substr_count($_FILES['icon']['type'],'image/'))) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "restobars/" . $restobar->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $restobar->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('icon'));
	$filehandler->close();

	$thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['tiny']['w'], $icon_sizes['tiny']['h'], $icon_sizes['tiny']['square']);
	$thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['small']['w'], $icon_sizes['small']['h'], $icon_sizes['small']['square']);
	$thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['medium']['w'], $icon_sizes['medium']['h'], $icon_sizes['medium']['square']);
	$thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(), $icon_sizes['large']['w'], $icon_sizes['large']['h'], $icon_sizes['large']['square']);
	if ($thumbtiny) {

		$thumb = new ElggFile();
		$thumb->owner_guid = $restobar->owner_guid;
		$thumb->setMimeType('image/jpeg');

		$thumb->setFilename($prefix."tiny.jpg");
		$thumb->open("write");
		$thumb->write($thumbtiny);
		$thumb->close();

		$thumb->setFilename($prefix."small.jpg");
		$thumb->open("write");
		$thumb->write($thumbsmall);
		$thumb->close();

		$thumb->setFilename($prefix."medium.jpg");
		$thumb->open("write");
		$thumb->write($thumbmedium);
		$thumb->close();

		$thumb->setFilename($prefix."large.jpg");
		$thumb->open("write");
		$thumb->write($thumblarge);
		$thumb->close();

		$restobar->icontime = time();
	}
}

system_message(elgg_echo("restobar:saved"));

forward($restobar->getUrl());
