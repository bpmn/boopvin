<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$users=elgg_get_entities_from_metadata(array('types' => 'user', 
'limit'=>5,                                            
'metadata_names' => 'score',
'order_by_metadata' => array('name' => 'score',                            
'direction' => 'DESC', 
'as' => integer) ));

echo elgg_view_entity_list($users,array('size'=>'small','item_class'=>'item-ranking'));