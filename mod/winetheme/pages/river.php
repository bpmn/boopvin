<?php
/**
 * Main activity stream list page
 */
elgg_load_js('elgg.coin');
elgg_load_css('coinslider.coinslider_css');
elgg_load_js('jquery.winetheme');

//$options = array();

/*
$page_type = preg_replace('[\W]', '', get_input('page_type', 'all'));
$type = preg_replace('[\W]', '', get_input('type', 'all'));
$subtype = preg_replace('[\W]', '', get_input('subtype', ''));
if ($subtype) {
	$selector = "type=$type&subtype=$subtype";
} else {
	$selector = "type=$type";
}

if ($type != 'all') {
	$options['type'] = $type;
	if ($subtype) {
		$options['subtype'] = $subtype;
	}
}*/

/*switch ($page_type) {
	case 'mine':
		$title = elgg_echo('river:mine');
		$page_filter = 'mine';
		$options['subject_guid'] = elgg_get_logged_in_user_guid();
		break;
	case 'friends':
		$title = elgg_echo('river:friends');
		$page_filter = 'friends';
		$options['relationship_guid'] = elgg_get_logged_in_user_guid();
		$options['relationship'] = 'friend';
		break;
	default:
		$title = elgg_echo('river:all');
		$page_filter = 'all';
		break;
}*/


/*$options['relationship_guid'] = elgg_get_logged_in_user_guid();
$options['relationship'] = 'friend';*/

//$activity = elgg_list_river($options);

//$items=array();
//$items_create=elgg_get_river(array('type_subtype_pairs'=>array('group'=>'wine','group'=>'restobar'),
                          //  'action_types'=>'create'));



$items_create=elgg_get_river(array('types'=>'group',
                                   'subtypes'=>array('wine','restobar'),
                                   'action_types'=>'create'));



$items_friend=elgg_get_river(array('relationship_guid'=>elgg_get_logged_in_user_guid(),
                            'relationship'=>'friend',
                            'action_types'=>array('degust','incave','update')));

$items=array_merge($items_create,$items_friend);
usort($items, "time_created_cmp");

//$items=$items_create;
$options['pagination']=FALSE;
$options['limit']=30;
$options['items']=array_slice($items , 0 ,30);




$activity= elgg_view('page/components/list', $options);


usort($activity, "time_created_cmp");

if (!$activity) {
	$activity = elgg_echo('river:none');
}



//$content = elgg_view('core/river/filter', array('selector' => $selector));

$content = "<div id=\"avenue_activity2\">".$activity."</div>";

//$content = $activity;

$content = $content."<div id=\"images_slider\">";

$content = $content."<div id=\"coin-slider\">";

 

 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/search.png'));
 $content.= '<span>1: Recherchez un vin</span>';

 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/degust.png'));
  $content.= '<span>2: Fiches de degustation !</span>';
  
$content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/wine2.png'));
  $content.= '<span>Gerez vos vins</span>';
  
$content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/wine1.png'));
  $content.= '<span>Visualisez vos degustations</span>';
  
$content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/resto.png'));
  $content.= '<span>Espace Pro: Bars a vins, Restos, Caves, news...</span>';
  
$content = $content."           </div>";


$content = $content."</div>";





$sidebar = elgg_view('core/river/sidebar');

$params = array(
	'content' => $content,
	'sidebar' => $sidebar,
	'filter_context' => $page_filter,
	'class' => 'elgg-river-layout',
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);




function time_created_cmp($a, $b) {
    $al = (int) $a->posted;
    $bl = (int) $b->posted;
    if ($al == $bl) {
        return 0;
    }
    return ($al < $bl) ? +1 : -1;
}