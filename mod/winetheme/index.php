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

$options = array();
$options['pagination']=FALSE;
$options['limit']=20;

$content = elgg_view_title(elgg_echo('content:latest'));
$content .= elgg_list_river($options);

$content = "<div id=\"avenue_activity\">".$content."</div>";



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



$params = array(
		'content' => $content,
		'sidebar' => ''
);
$body = elgg_view_layout('one_sidebar', $params);
echo elgg_view_page(null, $body);
