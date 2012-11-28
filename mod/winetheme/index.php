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
$options['limit']=20;


$welcome = "<div id=\"index_welcome\">";

$welcome .= "<h4>Bienvenue a Avenue Vin !</h4>";
$welcome .= "Mais... Avenue Vin, c'est quoi?<br>";
$welcome .= "C'est un lieu de rencontre pour les amateurs avertis et debutant de vins<br>";
$welcome .= "ou l'on peut remplire ses fiches de degustations, et trouver bars, restos etc..<br>";


//end of index_welcome
$welcome .= "</div>";


$content = elgg_view_title(elgg_echo('content:latest'));


$content .= elgg_list_river($options);


$content = "<div id=\"avenue_activity\">".$content."</div>";


$content = $content."<div id=\"nivo_slider\">";



 $content = $content."<div class=\"slider-wrapper theme-default\">";
 $content = $content."           <div id=\"avenue_slider\" class=\"nivoSlider\">";
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/vigne1.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/toystory.jpg'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/vigne2.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/up.jpg','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/vigne3.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/walle.jpg','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/vigne4.jpg','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/nemo.jpg'));
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
