<?php
/**
 * Group tag-based search form body
 */




$params = array(	
	'class' => 'elgg-input-search-other mbm search-input',
	'value' => elgg_echo('restobar:search'),
        'onblur' => "if (this.value=='') { this.value='" . elgg_echo('restobar:search') . "' };",
        'onfocus' => "if (this.value=='" . elgg_echo('restobar:search') . "') { this.value='' };",
        'size' => '21',
        'name' => 'q',
        'id' => 'hj-autocomplete'
);
echo elgg_view('input/text', $params);


        echo elgg_view('input/hidden', array(
		'name' => 'entity_type',
		'value' => 'group',
	));
        echo elgg_view('input/hidden', array(
		'name' => 'entity_subtype',
		'value' => 'restobar',
	));
        echo elgg_view('input/hidden', array(
		'name' => 'search_type',
		'value' => 'entities',
	));
        
   

//echo elgg_view('input/submit', array('value' => elgg_echo('search:go')));



