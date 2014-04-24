<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(dirname(__FILE__) . "/engine/start.php");

$options= array (
    'metadata_name_value_pairs' => array('name'=>'country',     
                                          'value' =>'New-Zealand',
                                          'operand' => '=',
                                          'case_sensitive' => False),
                                     
                                        
    'types'=>'group',
    'subtypes'=>'wine',
    'metadata_case_sensitive'=> False,
    'limit'=>0
    
);
$wines= elgg_get_entities_from_metadata($options);
foreach($wines as $wine){    
    $wine->country='New Zealand';
    $wine->description=$wine->appellation." ".$wine->region." ".$wine->maker." ".$wine->country;
    $wine->save();
    print_r ($wine);
}





?>
