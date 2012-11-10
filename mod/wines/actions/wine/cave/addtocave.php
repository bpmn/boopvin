<?php
/**
 * Add users to a restobar
 *
 * @package Elggwines
 */
$wine_guid = get_input('wine_guid');
$restobar_guid = get_input('restobar_guid');

if (!is_array($restobar_guid)) {
	$restobar_guid = array($restobar_guid);
}

$wine = get_entity($wine_guid);

if (sizeof($restobar_guid)) {
	foreach ($restobar_guid as $restobar_id) {
		$restobar = get_entity($restobar_id);

		if ($wine && $restobar && $restobar->canEdit()) {
			if (!$restobar->isIncave($wine)) {
				if (add_entity_relationship($restobar->getGUID(), 'incave', $wine->getGUID())){
					// send welcome email to user
					/*notify_user($user->getGUID(), $restobar->owner_guid,
							elgg_echo('restobar:incave:subject', array($restobar->name)),
							elgg_echo('restobar:incave:body', array(
								$user->name,
								$restobar->name,
								$restobar->getURL())
							));*/
                                        /*todo peut être add to river s'inspirer de la fonction join*/
                                        add_to_river('river/wine/incave','incave', $restobar->getGUID(), $wine->guid);
					system_message(elgg_echo('restobar:addedtocave'));
				}else{
					// huh
				}
			}
                }
        }
}

forward(REFERER);

