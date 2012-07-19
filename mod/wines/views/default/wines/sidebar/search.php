<?php
/**
 * Search for content in this group
 *
 * @uses vars['entity'] ElggGroup
 */

$url = elgg_get_site_url() . 'search';
$body = elgg_view_form('wines/search', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
), $vars);

echo elgg_view_module('aside', elgg_echo('wine:search_in_group'), $body);