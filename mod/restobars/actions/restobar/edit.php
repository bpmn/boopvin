<?php
/**
 * Elgg restobars plugin edit action.
 *
 * @package ElggRestobar
 */

// Load configuration
//global $CONFIG;

//elgg_make_sticky_form('groups');

/**
 * wrapper for recursive array walk decoding
 */
function profile_array_decoder(&$v) {
	$v = _elgg_html_decode($v);
}

// Get restobar fields
$input = array();
foreach (elgg_get_config('restobar') as $shortname => $valuetype) {
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

$input['name'] = htmlspecialchars(get_input('name', '', false), ENT_QUOTES, 'UTF-8');

$input['geo:lat']=get_input('latitude');
$input['geo:lat'] = (float)_elgg_html_decode($input['geo:lat']);
$input['geo:long']=get_input('longitude');
$input['geo:long'] = (float)_elgg_html_decode($input['geo:long']);

$user = elgg_get_logged_in_user_entity();

$restobar_guid = (int)get_input('restobar_guid');
$is_new_restobar = $restobar_guid == 0;

if ($is_new_restobar
		&& (elgg_get_plugin_setting('limited_groups', 'groups') == 'yes')
		&& !$user->isAdmin()) {
	register_error(elgg_echo("groups:cantcreate"));
	forward(REFERER);
}




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



$restobar->membership = ACCESS_PUBLIC;


if ($is_new_restobar) {
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

// group saved so clear sticky form
//elgg_clear_sticky_form('groups');

// restobar creator needs to be member of new restobar and river entry created
if ($is_new_restobar) {
	elgg_set_page_owner_guid($restobar->guid);
	$restobar->join($user);
	add_to_river('river/restobar/create', 'create', $user->guid, $restobar->guid);

// création de l'Objet restobarnews rattaché au restobar.
        $restobarnews=new ElggRestobarnews();
        $restobarnews->setContainerGUID($restobar->getGUID());
        $restobarnews->access_id=$restobar->access_id;
        $restobarnews->save();
        
}

$has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));

if ($has_uploaded_icon) {

	$icon_sizes = elgg_get_config('icon_sizes');

	$prefix = "restobars/" . $restobar->guid;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $restobar->owner_guid;
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
		$thumb->owner_guid = $restobar->owner_guid;
		$thumb->setMimeType('image/jpeg');

		foreach ($sizes as $size) {
			$thumb->setFilename("{$prefix}{$size}.jpg");
			$thumb->open("write");
			$thumb->write($thumbs[$size]);
			$thumb->close();
		}

		$restobar->icontime = time();
	}
   $filehandler->delete();
}

system_message(elgg_echo("restobar:saved"));

forward($restobar->getUrl());
