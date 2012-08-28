<?php
/**
 * Add users to a restobar
 *
 * @package ElggGroups
 */
$logged_in_user_guid = elgg_get_logged_in_user_guid();

$restobar_guid = get_input('restobar_guid');
if (!is_array($restobar_guid)) {
	$restobar_guid = array($restobar_guid);
}
$user_guid = get_input('user_guid');
$user = get_entity($user_guid);

if (sizeof($restobar_guid)) {
	foreach ($restobar_guid as $r_id) {
		$restobar = get_entity($r_id);

		if ($user && $restobar && ($restobar->getOwnerGUID()== $logged_in_user_guid)) {
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
