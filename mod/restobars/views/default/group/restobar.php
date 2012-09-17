<?php 
/**
 * Restobar entity view
 * 
 * @package ElggRestobar
 */

$restobar = $vars['entity'];

$icon = elgg_view_entity_icon($restobar, 'small');

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

	$params = array(
		'entity' => $restobar,
		'metadata' => $metadata,
		'subtitle' => $restobar->briefdescription,
	);
	$params = $params + $vars;
	$list_body = elgg_view('group/elements/summary', $params);
        $vars['image_alt']=$dist_display;
	echo elgg_view_image_block($icon, $list_body, $vars);
}
