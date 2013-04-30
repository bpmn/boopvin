<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$users=elgg_get_entities(array('type'=>'user','limit'=>200));
foreach ($users as $user) {
	echo $user->name.':</br>' ;
        
        $entities = elgg_get_entities_from_relationship(array(
	'relationship' => 'friend',
	'relationship_guid' => $user->getGuid(),

	'limit' => 9999,
));
	
        foreach ($entities as $entitie) {
         echo $entitie->name." ,";   
         //echo add_entity_relationship($user->guid, 'notify'.'email', $entitie->getGuid());
         echo remove_entity_relationship($user->guid, 'notify'.'email', $entitie->getGuid());
         //echo add_entity_relationship($user->guid, 'notify'.'site', $entitie->getGuid());
         echo remove_entity_relationship($user->guid, 'notify'.'site', $entitie->getGuid());
         echo add_entity_relationship($user->guid, 'notify'.'notifier', $entitie->getGuid());
         //echo remove_entity_relationship($user->guid, 'notify'.'notifier', $entitie->getGuid());
         
        }
        echo '</br>';
}
?>
