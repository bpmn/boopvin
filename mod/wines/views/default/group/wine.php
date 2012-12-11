<?php 
/**
 * Wine entity view
 * 
 * @package ElggWine
 */

$wine = $vars['entity'];
$degust=$vars['degust'];
//$icon = elgg_view_entity_icon($wine, 'small');
  $icon =  elgg_view('output/img',array('src'=>"mod/wines/graphics/glass_".$wine->kind.".jpg"));

  $metadata = elgg_view_menu('entity', array(
	'entity' => $wine,
	'handler' => 'wine',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if (elgg_in_context('owner_block') || elgg_in_context('widgets')) {
	$metadata = '';
}


if ($vars['full_view']) {
	echo elgg_view("wines/profile/summary", $vars);
} else {
	// brief view
    
        $subtitle="";
        if ($wine->appellation)
            $subtitle.=$wine->appellation.", ";
        if ($wine->region)
            $subtitle.=$wine->region.", ";
        $subtitle.=$wine->country;
	$params = array(
		'entity' => $wine,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
                'degust' => $degust,
                
	);
	$params = $params + $vars;
	$list_body = elgg_view('wines/elements/summary', $params);
        
        $vars['class']='image_block_wine';
        //$vars['image_alt']= $img;
        echo elgg_view_image_block($icon, $list_body, $vars);
}
