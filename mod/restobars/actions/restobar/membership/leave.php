<?php
/**
 * Leave a restobar action.
 *
 * @package Elggrestobars
 */

$user_guid = get_input('user_guid');
$restobar_guid = get_input('restobar_guid');

$user = NULL;
if (!$user_guid) {
	$user = elgg_get_logged_in_user_entity();
} else {
	$user = get_entity($user_guid);
}

$restobar = get_entity($restobar_guid);

elgg_set_page_owner_guid($restobar->guid);

if (($user instanceof ElggUser) && ($restobar instanceof ElggGroup)) {
	if ($restobar->getOwnerGUID() != elgg_get_logged_in_user_guid()) {
		if ($restobar->leave($user)) {
			system_message(elgg_echo("restobar:left"));
		} else {
			register_error(elgg_echo("restobar:cantleave"));
		}
	} else {
		register_error(elgg_echo("restobar:cantleave"));
	}
} else {
	register_error(elgg_echo("restobar:cantleave"));
}

forward(REFERER);
