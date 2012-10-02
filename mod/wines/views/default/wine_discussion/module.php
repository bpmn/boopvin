<?php
/**
 * Latest forum posts
 *
 * @uses $vars['entity']
 */

$wine = $vars['entity'];


$all_link = elgg_view('output/url', array(
	'href' => "wine_discussion/owner/".$wine->getGUID(),
	'text' => elgg_echo('link:view:all'),
	'is_trusted' => true,
));

elgg_push_context('widgets');
$options = array(
	'type' => 'object',
	'subtype' => 'wineforumtopic',
	'container_guid' => $wine->getGUID(),
	'limit' => 6,
	'full_view' => false,
	'pagination' => false,
);
$content = elgg_list_entities($options);
elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('discussion:none') . '</p>';
}

$new_link = elgg_view('output/url', array(
	'href' => "wine_discussion/add/" . $wine->getGUID(),
	'text' => elgg_echo('wine:addtopic'),
	'is_trusted' => true,
));

echo elgg_view('wines/profile/module', array(
	'title' => elgg_echo('discussion:wine'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));