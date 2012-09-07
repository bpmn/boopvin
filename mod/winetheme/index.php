<?php
/**
 * Elgg custom index page
 * 
 */

$content = elgg_view_title(elgg_echo('content:latest'));
$content .= elgg_list_river();



$params = array(
		'content' => $content,
		'sidebar' => ''
);
$body = elgg_view_layout('one_sidebar', $params);
echo elgg_view_page(null, $body);