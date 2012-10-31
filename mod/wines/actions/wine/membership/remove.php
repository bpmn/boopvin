<?php
/**
 * Remove a user from a group
 *
 * @package Elggwines
 */

$user_guid = get_input('user_guid');
$wine_guid = get_input('wine_guid');

$user = get_entity($user_guid);
$wine = get_entity($wine_guid);

elgg_set_page_owner_guid($wine->guid);
$loggined_user=  elgg_get_logged_in_user_entity();

if (($user instanceof ElggUser) && (elgg_instanceof($wine,'group','wine')) && $loggined_user->isAdmin()) {
	// Don't allow removing group owner
	if ($wine->getOwnerGUID() != $user->getGUID()) {
		if ($wine->leave($user)) {
			system_message(elgg_echo("wine:removed", array($user->name)));
		} else {
			register_error(elgg_echo("wine:cantremove"));
		}
	} else {
		register_error(elgg_echo("wine:cantremove"));
	}
} else {
	register_error(elgg_echo("wine:cantremove"));
}

forward(REFERER);
