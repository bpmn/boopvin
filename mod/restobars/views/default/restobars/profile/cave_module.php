<?php
/**
 * Restobars latest activity
 *
 * @todo add people joining group to activity
 * 
 * @package Groups
 */



$restobar = $vars['entity'];
if (!$restobar) {
	return true;
}

$all_link = elgg_view('output/url', array(
	'href' => "restobar/cave/{$restobar->getGUID()}",
	'text' => elgg_echo('link:cave:all'),
	'is_trusted' => true,
));


//elgg_push_context('widgets');
//$db_prefix = elgg_get_config('dbprefix');
$content = elgg_list_entities_from_relationship(array(
        'types'=>'group',
        'subtypes'=>'wine',
	'limit' => 10,
	'pagination' => false,
	'relationship' => 'incave',
        'relationship_guid' => $restobar->getGUID(),
	'inverse_relationship' => FALSE,
        'full_view'=>FALSE
));
//elgg_pop_context();

if (!$content) {
	$content = '<p>' . elgg_echo('restobar:cave:none') . '</p>';
}

echo elgg_view('restobars/profile/module', array(
	'title' => elgg_echo('restobar:cave:news'),
	'content' => $content,
	'all_link' => $all_link,
));
