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
$welcome .= "<br>";

$welcome .= "Ici, un slogan catchy et sexy, pour les amateurs de vin !";

//end of index_welcome
$welcome .= "</div>";


//$content = elgg_view_title(elgg_echo('content:latest'));


$content .= elgg_list_river($options);


$content = "<div id=\"avenue_activity\">".$content."</div>";


$content = $content."<div id=\"nivo_slider\">";



 $content = $content."<div class=\"slider-wrapper theme-default\">";
 $content = $content."           <div id=\"avenue_slider\" class=\"nivoSlider\">";
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/degust.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/degust.png', 'title'=>'Fiches de degustations'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/vin.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/vin.png', 'title'=>'Vins','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/bar.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/bar.png','title'=>'Bars a vins, Restos, Caves','data-transition'=>'slideInLeft'));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/galerie.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/galerie.png', 'title'=>'Galerie photos',));
 $content.=elgg_view('output/img', array('src'=>'mod/winetheme/views/default/css/winetheme/images/register.png','data-thumb'=>'mod/winetheme/views/default/css/winetheme/images/register.png','title'=>'Enregistrez vous!',));
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
