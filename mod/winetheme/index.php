<?php
/**
 * Elgg index page for web-based applications
 *
 * @package Elgg
 * @subpackage Core
 */
elgg_load_js('elgg.coin');
elgg_load_css('coinslider.coinslider_css');
elgg_load_js('jquery.winetheme');
elgg_load_js('elgg.modal');
elgg_load_js('elgg.popup');

//elgg_unregister_menu_item('river', 'comment');



$slider = "<div id=\"images_slider\" style=\"display:none;\">";

$slider = $slider."<div id=\"coin-slider\">";

 

 $slider.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/search_wide.png'));
 $slider.= '<span>'.elgg_echo('post1').'</span>';
 

 $slider.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/degust_wide.png'));
  $slider.= '<span>'.elgg_echo('post2').'</span>';
  
$slider.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/wine2_wide.png'));
  $slider.= '<span>'.elgg_echo('post3').'</span>';
    
$slider.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/resto_wide.png'));
  $slider.= '<span>'.elgg_echo('post5').'</span>';
  
$slider = $slider."           </div>";


$slider = $slider."</div>";


/* Module classement */
elgg_push_context("ranking");
$rank = "<div id=\"ranking\" class=\"clearfix\">";
$rank .= "<div id=\"ranking_list\" >";

$user_list = elgg_view('ranking/users', array());
if ($user_list)
    $rank.="<h3>" . elgg_echo("ranking:users") . "</h3>" . $user_list;
$restobar_list = elgg_view('ranking/restobars', array());
if ($restobar_list)
    $rank.="<h3>" . elgg_echo("ranking:restobars") . "</h3>" . $restobar_list;
$rank.="</div></div>"; //fermeture div id ranking

elgg_pop_context();


$welcome = "<div id=\"index_welcome\" >";

$welcome .= '<h4>'.elgg_echo('bienvenue').'</h4>';
$welcome .= "<br>";

$welcome .= elgg_echo('citation');

//end of index_welcome
$welcome .= "</div>";


//$content = elgg_view_title(elgg_echo('content:latest'));

$ia=elgg_set_ignore_access(true);
$options['action_types']=array("create");

$options = array();
$options['pagination']=FALSE;
$options['limit']=20;
$options['type_subtype_pairs']=array('group'=>array('wine','restobar'),'object'=>'degust');
$list_river = elgg_list_river($options);
elgg_set_ignore_access($ia);
$content = '<h3>'.elgg_echo("content:latest").'</h3>';

$content .= "<div id=\"avenue_activity\" >".$list_river."</div>";
//$content = $content;




//$content_final = $slider.$rank.$welcome.$content;
//$content_final = $welcome.$rank.$content;
//$content_final = $slider.$rank.$content;
$content_final = $rank.$content;
$params = array(
		'content' => $content_final,
		'sidebar' => ''
);
$body = elgg_view_layout('one_sidebar', $params);
echo elgg_view_page(null, $body);
