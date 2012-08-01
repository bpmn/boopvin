<?php
/**
 * Delete a restobar
 */
		
$guid = (int) get_input('guid');
if (!$guid) {
	// backward compatible
	elgg_deprecated_notice("Use 'guid' for group delete action", 1.8);
	$guid = (int)get_input('restobar_guid');
}
$entity = get_entity($guid);

if (!$entity->canEdit()) {
	register_error(elgg_echo('restobar:notdeleted'));
	forward(REFERER);
}

if (($entity) && ($entity instanceof ElggGroup)) {
	// delete restobar icons
	$owner_guid = $entity->owner_guid;
	$prefix = "restobars/" . $entity->guid;
	$imagenames = array('.jpg', 'tiny.jpg', 'small.jpg', 'medium.jpg', 'large.jpg');
	$img = new ElggFile();
	$img->owner_guid = $owner_guid;
	foreach ($imagenames as $name) {
		$img->setFilename($prefix . $name);
		$img->delete();
	}

	// delete group
	if ($entity->delete()) {
		system_message(elgg_echo('restobar:deleted'));
	} else {
		register_error(elgg_echo('restobar:notdeleted'));
	}
} else {
	register_error(elgg_echo('restobar:notdeleted'));
}

$url_name = elgg_get_logged_in_user_entity()->username;
forward(elgg_get_site_url() . "restobar/member/{$url_name}");
