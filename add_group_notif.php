<?php
require_once(dirname(__FILE__) . "/engine/start.php");
$users=elgg_get_entities(array('type'=>'user','limit'=>200));
foreach ($users as $user) {
	echo $user->name.'</br>' ;
        
        $wines = elgg_get_entities_from_relationship(array(
	'relationship' => 'member',
	'relationship_guid' => $user->getGuid(),
	'types' => 'group',
        'subtypes'=>'wine',
	'limit' => 9999,
));
	
        foreach ($wines as $wine) {
         echo $wine->name;   
         //echo add_entity_relationship($user->guid, 'notify'.'email', $wine->getGuid());
         echo remove_entity_relationship($user->guid, 'notify'.'email', $wine->getGuid());
         echo add_entity_relationship($user->guid, 'notify'.'notifier', $wine->getGuid());
         echo remove_entity_relationship($user->guid, 'notify'.'site', $wine->getGuid());   
        }
}
?>