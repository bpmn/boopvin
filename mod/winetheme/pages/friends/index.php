<?php
/**
 * Elgg friends page
 *
 * @package Elgg.Core
 * @subpackage Social.Friends
 */

$owner = elgg_get_page_owner_entity();
if (!$owner) {
	// unknown user so send away (@todo some sort of 404 error)
	forward();
}

$title = elgg_echo("friends:owned", array($owner->name));

$options = array(
	'relationship' => 'friend',
	'relationship_guid' => $owner->getGUID(),
	'inverse_relationship' => FALSE,
	//'type' => 'user',
	'full_view' => FALSE,
        'list_class'=>'list-style-all-resto',
        'item_class'=>'elgg-item-contact',
        'limit'=>50,
);
elgg_push_context('friends');
$content = elgg_list_entities_from_relationship($options);
if (!$content) {
	$content = elgg_echo('friends:none');
}

/*$params = array(
	'content' => $content,
	'title' => $title,
);


$body = elgg_view_layout('one_sidebar', $params);*/
        elgg_load_js('search.auto_other');

        
        $search_box= elgg_view('search/entity/find');
        elgg_pop_context();
        
        $params = array(
		'content' => $content,
                'title'=> $title,
                'search_box'=>$search_box
	);
	$body = elgg_view_layout('content_with_search', $params);
        


echo elgg_view_page($title, $body);
