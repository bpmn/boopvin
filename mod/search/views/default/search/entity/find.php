<?php
/**
 * Group search
 *
 * @package ElggGroups
 */
$url = elgg_get_site_url() .'search';
$body = elgg_view_form('search/find', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
        'class' => 'elgg-search-entity'
));

echo $body;
//echo elgg_view_module('aside', elgg_echo('restobar:searchtag'), $body);

//echo elgg_view('search/search_box', array('class' => 'elgg-search-header'));
//echo elgg_view('search/search_box', array('class' => 'elgg-search-header'));
?>

