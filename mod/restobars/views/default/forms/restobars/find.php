<?php
/**
 * Group tag-based search form body
 */



$tag_string = elgg_echo('groups:search:tags');

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

//echo elgg_view('input/submit', array('value' => elgg_echo('search:go')));



