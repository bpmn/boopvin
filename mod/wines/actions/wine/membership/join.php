<?php
/**
 * Join a group
 *
 * Three states:
 * open group so user joins
 * closed group so request sent to group owner
 * closed group with invite so user joins
 * 
 * @package Elggwines
 */

global $CONFIG;

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$wine_guid = get_input('wine_guid');

$user = get_entity($user_guid);

// access bypass for getting invisible group
$ia = elgg_set_ignore_access(true);
$wine = get_entity($wine_guid);
elgg_set_ignore_access($ia);

if (($user instanceof ElggUser) && ($wine instanceof ElggGroup)) {

	// join or request
	$join = false;
	if ($wine->isPublicMembership() || $wine->canEdit($user->guid)) {
		// anyone can join public wines and admins can join any group
		$join = true;
	} else {
		if (check_entity_relationship($wine->guid, 'invited', $user->guid)) {
			// user has invite to closed group
			$join = true;
		}
	}

	if ($join) {
		if (wines_join_wine($wine, $user)) {
			system_message(elgg_echo("wine:joined"));
			forward($wine->getURL());
		} else {
			register_error(elgg_echo("wine:cantjoin"));
		}
	} else {
		add_entity_relationship($user->guid, 'membership_request', $wine->guid);

		// Notify group owner
		$url = "{$CONFIG->url}wines/requests/$wine->guid";
		$subject = elgg_echo('wine:request:subject', array(
			$user->name,
			$wine->name,
		));
		$body = elgg_echo('wine:request:body', array(
			$wine->getOwnerEntity()->name,
			$user->name,
			$wine->name,
			$user->getURL(),
			$url,
		));
		if (notify_user($wine->owner_guid, $user->getGUID(), $subject, $body)) {
			system_message(elgg_echo("wine:joinrequestmade"));
		} else {
			register_error(elgg_echo("wine:joinrequestnotmade"));
		}
	}
} else {
	register_error(elgg_echo("wine:cantjoin"));
}

forward(REFERER);
