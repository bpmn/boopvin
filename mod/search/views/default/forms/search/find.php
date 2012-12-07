<?php
/**
 * Group tag-based search form body
 */

if (elgg_get_context()== 'restobar'){
    $entity_type='group';
    $entity_subtype='restobar';
    $search='restobar';
}
if (elgg_get_context()== 'friends'){
    $entity_type='user';
    $entity_subtype='';
    $search='user';
}


$params = array(	
	'class' => 'elgg-input-search-other mbm search-input',
	'value' => elgg_echo('search:'.$search),
        'onblur' => "if (this.value=='') { this.value='" . elgg_echo('search:'.$search) . "' };",
        'onfocus' => "if (this.value=='" . elgg_echo('search:'.$search) . "') { this.value='' };",
        'size' => '21',
        'name' => 'q',
        'id' => 'hj-autocomplete',
        'data-entity_type' =>$entity_type,
        'data-entity_subtype'=>$entity_subtype
);
echo elgg_view('input/text', $params);


        echo elgg_view('input/hidden', array(
		'name' => 'entity_type',
		'value' => $entity_type,
	));
        echo elgg_view('input/hidden', array(
		'name' => 'entity_subtype',
		'value' => $entity_subtype,
	));
        echo elgg_view('input/hidden', array(
		'name' => 'search_type',
		'value' => 'entities',
	));
        
   

//echo elgg_view('input/submit', array('value' => elgg_echo('search:go')));



