<?php
/**
 * Main activity stream list page
 */
elgg_load_js('elgg.nivo');
elgg_load_css('nivoslider.nivoslider_css');
elgg_load_js('jquery.winetheme');

/*$options = array();

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
$options['limit']=20;
$options['items']=$items;




$activity= elgg_view('page/components/list', $options);
usort($activity, "time_created_cmp");

if (!$activity) {
	$activity = elgg_echo('river:none');
}

$content = elgg_view('core/river/filter', array('selector' => $selector));

$activity="<div id=\"avenue_activity\">".$activity."</div>";

$content = $content."<div id=\"nivo_slider\">";

 $content = $content."<div class=\"slider-wrapper theme-default\">";
 $content = $content."           <div id=\"avenue_slider\" class=\"nivoSlider\">";
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/toystory.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/toystory.jpg'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/up.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/up.jpg','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/walle.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/walle.jpg','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/nemo.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/nemo.jpg'));
 $content = $content."           </div>";
 $content = $content."           <div id=\"htmlcaption\" class=\"nivo-html-caption\">";
 $content = $content."               <strong>This</strong> is an example of a <em>HTML</em> caption with <a href=\"#\">a link</a>."; 
 $content = $content."           </div>";
 $content = $content."       </div>";
 
$content = $content."</div>";

$activity=$activity.$content;

$sidebar = elgg_view('core/river/sidebar');

$params = array(
	'content' =>  $activity,
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