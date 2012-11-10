<?php

/*
 * Add a restobar as Friend ("Follow un restobar")
 * 
 */
        $user=  elgg_get_logged_in_user_entity();
	$user_guid = $user->getGUID();
	$friend_guid = (int)get_input('friend');
        $friend=get_entity($friend_guid);
	
	if (($user instanceof ElggUser) || ((elgg_instanceof ($friend,'group','restobar','ElggUser')))) {
            if (add_entity_relationship($user_guid, "friend", $friend_guid)){	
            system_message(elgg_echo("friends:add:successful", array($friend->name)));
            //add_to_river('river/relationship/friend/create', 'friend', elgg_get_logged_in_user_guid(), $friend_guid);
            }else{
                register_error(elgg_echo("friends:add:failure", array($friend->name)));
            }
        }else{
                register_error(elgg_echo("friends:add:failure", array($friend->name)));
        }
        
        forward(REFERER);
?>
