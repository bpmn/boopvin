<?php
/**
 * Elgg index page for web-based applications
 *
 * @package Elgg
 * @subpackage Core
 */
elgg_load_js('elgg.nivo');
elgg_load_css('nivoslider.nivoslider_css');
elgg_load_js('jquery.winetheme');

//elgg_unregister_menu_item('river', 'comment');

$options = array();
$options['pagination']=FALSE;
$options['limit']=40;


$welcome = "<div id=\"index_welcome\">";

$welcome .= '<h4>'.elgg_echo('bienvenue').'</h4>';
$welcome .= "<br>";

$welcome .= elgg_echo('citation');

//end of index_welcome
$welcome .= "</div>";


//$content = elgg_view_title(elgg_echo('content:latest'));


$content .= elgg_list_river($options);


$content = "<div id=\"avenue_activity\">".$content."</div>";
//$content = $content;


$content = $content."<div id=\"nivo_slider\">";



 $content = $content."<div class=\"slider-wrapper theme-default\">";
 $content = $content."           <div id=\"avenue_slider\" class=\"nivoSlider\">";
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/search.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/search.png', 'title'=>'1: Recherchez un vin'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/degust.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/degust.png', 'title'=>'2: Fiches de degustation !'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/wine2.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/wine2.png', 'title'=>'Gerez vos vins'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/wine1.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/wine1.png', 'title'=>'Visualisez vos degustations','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/resto.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/resto.png','title'=>'Espace Pro: Bars a vins, Restos, Caves, news...'));
 $content = $content."           </div>";
 $content = $content."           <div id=\"htmlcaption\" class=\"nivo-html-caption\">";
 $content = $content."               <strong>This</strong> is an example of a <em>HTML</em> caption with <a href=\"#\">a link</a>."; 
 $content = $content."           </div>";
 $content = $content."       </div>";
 
$content = $content."</div>";


$content_final = $welcome.$content;


$params = array(
		'content' => $content_final,
		'sidebar' => ''
);
$body = elgg_view_layout('one_sidebar', $params);
echo elgg_view_page(null, $body);
