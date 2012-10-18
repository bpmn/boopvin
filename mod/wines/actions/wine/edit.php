<?php
/**
 * Elgg wines plugin edit action.
 *
 * @package ElggWine
 */

// Load configuration
global $CONFIG;

/**
 * wrapper for recursive array walk decoding
 */
function profile_array_decoder(&$v) {
	$v = html_entity_decode($v, ENT_COMPAT, 'UTF-8');
}

// Get wine fields
$input = array();
foreach ($CONFIG->wine as $shortname => $valuetype) {
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

$input['domaine'] = get_input('domaine');
$input['domaine'] = html_entity_decode($input['domaine'], ENT_COMPAT, 'UTF-8');

$user = elgg_get_logged_in_user_entity();

$wine_guid = (int)get_input('wine_guid');
$new_wine_flag = $wine_guid == 0;

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


// Set wine tool options
if (isset($CONFIG->group_tool_options)) {
	foreach ($CONFIG->group_tool_options as $wine_option) {
		$wine_option_toggle_name = $wine_option->name . "_enable";
		if ($wine_option->default_on) {
			$wine_option_default_value = 'yes';
		} else {
			$wine_option_default_value = 'no';
		}
		$wine->$wine_option_toggle_name = get_input($wine_option_toggle_name, $wine_option_default_value);
	}
}


$wine->membership = ACCESS_PUBLIC;
		
	

if ($new_wine_flag) {
	$wine->access_id = ACCESS_PUBLIC;
}

$wine->name=$wine->domaine." "."\"$wine->cuvee\"";

$wine->save();

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

$wine->save();

// wine creator needs to be member of new wine and river entry created
if ($new_wine_flag) {
	elgg_set_page_owner_guid($wine->guid);
	$wine->join($user);
	add_to_river('river/wine/create', 'create', $user->guid, $wine->guid, $wine->access_id);
}

// Now see if we have a file icon
/*if ((isset($_FILES['icon'])) && (substr_count($_FILES['icon']['type'],'image/'))) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "wines/" . $wine->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $wine->owner_guid;
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
		$thumb->owner_guid = $wine->owner_guid;
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

		$wine->icontime = time();
	}
}*/

system_message(elgg_echo("wine:saved"));

forward($wine->getUrl());
