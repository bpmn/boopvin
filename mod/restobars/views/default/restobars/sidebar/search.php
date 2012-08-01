<?php
/**
 * Search for content in this group
 *
 * @uses vars['entity'] ElggGroup
 */

$url = elgg_get_site_url() . 'search';
$body = elgg_view_form('restobars/search', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
), $vars);

echo elgg_view_module('aside', elgg_echo('restobar:search_in_group'), $body);