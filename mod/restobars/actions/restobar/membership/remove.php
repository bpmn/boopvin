<?php
/**
 * Remove a user from a restobar
 *
 * @package ElggRestobars
 */

$user_guid = get_input('user_guid');
$restobar_guid = get_input('restobar_guid');

$user = get_entity($user_guid);
$restobar = get_entity($restobar_guid);

elgg_set_page_owner_guid($restobar->guid);

if (($user instanceof ElggUser) && ($restobar instanceof ElggGroup) && $restobar->canEdit()) {
	// Don't allow removing restobar owner
	if ($restobar->getOwnerGUID() != $user->getGUID()) {
		if ($restobar->leave($user)) {
			system_message(elgg_echo("restobar:removed", array($user->name)));
		} else {
			register_error(elgg_echo("restobar:cantremove"));
		}
	} else {
		register_error(elgg_echo("restobar:cantremove"));
	}
} else {
	register_error(elgg_echo("restobar:cantremove"));
}

forward(REFERER);
