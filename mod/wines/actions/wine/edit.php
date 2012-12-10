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

$has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));

if ($has_uploaded_icon) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "wines/" . $wine->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $wine->owner_guid;
	$filehandler->setFilename($prefix . ".jpg");
	$filehandler->open("write");
	$filehandler->write(get_uploaded_file('icon'));
	$filehandler->close();
	$filename = $filehandler->getFilenameOnFilestore();

	$sizes = array('tiny', 'small', 'medium', 'large');

	$thumbs = array();
	foreach ($sizes as $size) {
		$thumbs[$size] = get_resized_image_from_existing_file(
			$filename,
			$icon_sizes[$size]['w'],
			$icon_sizes[$size]['h'],
			$icon_sizes[$size]['square']
		);
	}

	if ($thumbs['tiny']) { // just checking if resize successful
		$thumb = new ElggFile();
		$thumb->owner_guid = $wine->owner_guid;
		$thumb->setMimeType('image/jpeg');

		foreach ($sizes as $size) {
			$thumb->setFilename("{$prefix}{$size}.jpg");
			$thumb->open("write");
			$thumb->write($thumbs[$size]);
			$thumb->close();
		}

		$wine->icontime = time();
	}
}

system_message(elgg_echo("wine:saved"));

forward($wine->getUrl());