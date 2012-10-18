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
$restobarnews_guid=$restobarnews->getGUID();

$edit_link = elgg_view('output/url', array(
	'href' => "restobar_news/edit/$restobarnews_guid",
	'text' => elgg_echo('news:restobar:edit'),
        'class'=> "elgg-overlay",
       // 'target'=>"_blank",
	'is_trusted' => true,
));

$content = elgg_view('output/longtext',array('value'=>$restobarnews->description,'id'=>'elgg-text-restobarnews'));


echo elgg_view('restobars/profile/module_news', array(
	'title' => elgg_echo('news:restobar'),
	'content' => $content,
	'all_link' => $edit_link,
	
));