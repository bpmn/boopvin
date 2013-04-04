<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$restobars=elgg_get_entities_from_metadata(array('types' => 'group', 
'subtypes'=>'restobar',
'limit'=>5,                                            
'metadata_names' => 'score',
'order_by_metadata' => array('name' => 'score',                            
'direction' => 'DESC', 
'as' => integer) ));

foreach ($restobars as $resto) {
    if ($resto->score == 0)
        array_pop($restobars);
}  

echo elgg_view_entity_list($restobars,array('full_view'=>false,'item_class'=>'item-ranking'));