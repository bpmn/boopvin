<?php
/**
 * Elgg index page for web-based applications
 *
 * @package Elgg
 * @subpackage Core
 */

$options = array();
$options['pagination']=FALSE;
$options['limit']=20;

$content = elgg_view_title(elgg_echo('content:latest'));
$content .= elgg_list_river($options);

$content = "<div id=\"avenue_activity\">".$content."</div>";


$params = array(
		'content' => $content,
		'sidebar' => ''
);
$body = elgg_view_layout('one_sidebar', $params);
echo elgg_view_page(null, $body);