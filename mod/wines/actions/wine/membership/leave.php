<?php
/**
 * Leave a group action.
 *
 * @package ElggGroups
 */

$user_guid = get_input('user_guid');
$wine_guid = get_input('wine_guid');

$user = NULL;
if (!$user_guid) {
	$user = elgg_get_logged_in_user_entity();
} else {
	$user = get_entity($user_guid);
}

$wine = get_entity($wine_guid);

elgg_set_page_owner_guid($wine->guid);

if (($user instanceof ElggUser) && ($wine instanceof ElggGroup)) {
	if ($wine->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
		if ($wine->leave($user)) {
			system_message(elgg_echo("wine:left"));
		} else {
			register_error(elgg_echo("wine:cantleave"));
		}
	} else {
		register_error(elgg_echo("wine:cantleave"));
	}
} else {
	register_error(elgg_echo("wine:cantleave"));
}

forward(REFERER);
