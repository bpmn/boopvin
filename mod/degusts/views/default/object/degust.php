<?php
/**
 * Forum topic entity view
 *
 * @package ElggGroups
*/

$full = elgg_extract('full_view', $vars, FALSE);
$degust = elgg_extract('entity', $vars, FALSE);

if (!$degust) {
	return true;
}

$poster = $degust->getOwnerEntity();
$wine = $degust->getContainerEntity();

if (isset($degust->comment)){
    $excerpt = ($degust->comment).'</br>';
    
    
    }elseif (isset($degust->arome)) {
    $excerpt = ($degust->arome).'</br>';
    
    }elseif (isset($degust->accord)) {
    $excerpt = ($degust->arome).'</br>';    
    }
    
    
    

$poster_icon = elgg_view_entity_icon($poster, 'tiny');
$poster_link = elgg_view('output/url', array(
	'href' => $poster->getURL(),
	'text' => $poster->name,
	'is_trusted' => true,
));



$title_link=$wine->name;
if (isset($wine->cuvee))
    $title_link.= "  \"{$wine->cuvee}\"";
if (isset($degust->annee))
    $title_link.= "  {$degust->annee}";

$degust_link = elgg_view('output/url', array(
	'href' => $degust->getURL(),
	'text' => elgg_echo('degust:link'),
        'class'=>'elgg-overlay',
        'title'=> $title_link,
	'is_trusted' => true,
));

$degust_link .='</br>'.elgg_view('output/notedropdown',array('value'=>$degust->note));

$date = elgg_view_friendly_time($degust->time_updated);

if ($wine->vintage=='v'){
    $title = elgg_echo('degust:module:title', array($degust->annee)) ;  
} 
$poster_text = elgg_echo('degust:post', array($date,$poster_link)) ;     




//$tags = elgg_view('output/tags', array('tags' => $topic->tags));
//$date = elgg_view('output/date',array('value'=>$degust->time_updated));



$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'degust',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full) {
	$subtitle = "$poster_text $poster_link $date ";

	$params = array(
		'entity' => $degust,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	$info = elgg_view_image_block($poster_icon, $list_body);

	$body = elgg_view('output/longtext', array('value' => $wine->name));

	echo <<<HTML
$info
$body
HTML;

} else {
	// brief view
	$subtitle = "$poster_text";

	$params = array(
		'entity' => $degust,
		'metadata' => $metadata,
                'title'=>$title,
		'subtitle' => $subtitle,
		'tags' => $tags,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);
	echo elgg_view_image_block($poster_icon, $list_body,array('image_alt'=>$degust_link));
}
