<?php
/**
 * Latest forum posts
 *
 * @uses $vars['entity']
 */



$restobar = $vars['entity'];

$options=array('type_subtype_pairs'=>array('object'=>'restobarnews'),'container_guids'=>$restobar->getGUID());
$restobarnews_list= elgg_get_entities($options);
$restobarnews=$restobarnews_list[0];


$edit_link = elgg_view('output/url', array(
	'href' => "restobar_news/edit/",
	'text' => elgg_echo('news:restobar:edit'),
	'is_trusted' => true,
));

$content = $restobarnews->description;


echo elgg_view('restobars/profile/module', array(
	'title' => elgg_echo('news:restobar'),
	'content' => $content,
	'all_link' => $edit_link,
	
));