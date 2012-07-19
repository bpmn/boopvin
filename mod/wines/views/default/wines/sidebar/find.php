<?php
/**
 * Group search
 *
 * @package ElggGroups
 */
$url = elgg_get_site_url() . 'wines/search';
$body = elgg_view_form('wines/find', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
));

echo elgg_view_module('aside', elgg_echo('wine:searchtag'), $body);


