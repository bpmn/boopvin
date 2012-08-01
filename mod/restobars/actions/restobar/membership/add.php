<?php
/**
 * Add users to a restobar
 *
 * @package ElggGroups
 */
$logged_in_user = elgg_get_logged_in_user_entity();

$user_guid = get_input('user_guid');
if (!is_array($user_guid)) {
	$user_guid = array($user_guid);
}
$restobar_guid = get_input('restobar_guid');
$restobar = get_entity($restobar_guid);

if (sizeof($user_guid)) {
	foreach ($user_guid as $u_id) {
		$user = get_user($u_id);

		if ($user && $restobar && $restobar->canEdit()) {
			if (!$restobar->isMember($user)) {
				if (restobars_join_restobar($restobar, $user)) {

					// send welcome email to user
					notify_user($user->getGUID(), $restobar->owner_guid,
							elgg_echo('restobar:welcome:subject', array($restobar->name)),
							elgg_echo('restobar:welcome:body', array(
								$user->name,
								$restobar->name,
								$restobar->getURL())
							));

					system_message(elgg_echo('restobar:addedtorestobar'));
				} else {
					// huh
				}
			}
		}
	}
}

forward(REFERER);
