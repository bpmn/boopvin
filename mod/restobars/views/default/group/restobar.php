<?php 
/**
 * Restobar entity view
 * 
 * @package ElggRestobar
 */

$restobar = $vars['entity'];
if (elgg_in_context('friends')){
 $icon = elgg_view_entity_icon($restobar, 'tiny');
}else{
 $icon = elgg_view_entity_icon($restobar, 'small');   
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $restobar,
	'handler' => 'restobar',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}


if (elgg_in_context('distance')){
    $dist_display=round($restobar->dist,1)." km";
    $restobar->__unset("dist");
}

if ($vars['full_view']) {
	echo elgg_view("restobars/profile/summary", $vars);
} else {
	// brief view

	if (elgg_in_context('friends')){
        $params = array(
		'entity' => $restobar,
		'metadata' => $metadata,);
        
        }else{
        $params = array(
		'entity' => $restobar,
		'metadata' => $metadata,
		'subtitle' => $restobar->briefdescription,);   
        }
	$params = $params + $vars;
	$list_body = elgg_view('group/elements/summary', $params);
        if($dist_display)
            $vars['image_alt']=$dist_display;
        if (elgg_in_context("ranking"))
            $vars['image_alt']= "<div id=\"score2\">$restobar->score</div>";
	echo elgg_view_image_block($icon, $list_body, $vars);
}
