<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




$wine_guid = get_input('wine_guid');
$restobar_guid = get_input('restobar_guid');

$wine = get_entity($wine_guid);
$restobar = get_entity($restobar_guid);

//elgg_set_page_owner_guid($group->guid);

if (elgg_instanceof($wine, 'group', 'wine','ElggWine') && elgg_instanceof($restobar, 'group','restobar','ElggRestobar') && $restobar->canEdit()) {
	// Don't allow removing group owner
	
		if (remove_entity_relationship($restobar->guid, 'incave', $wine->guid)) {
			system_message(elgg_echo("cave:removed"));
		} else {
			register_error(elgg_echo("cave:cantremove"));
		}
	
} else {
	register_error(elgg_echo("cave:cantremove"));
}

forward(REFERER);


?>
