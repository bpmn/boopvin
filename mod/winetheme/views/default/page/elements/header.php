<?php
/**
 * Elgg page header
 * In the default theme, the header lives between the topbar and main content area.
 */

// link back to main site.
//echo elgg_view('page/elements/header_logo', $vars);

// drop-down login
echo elgg_view('core/account/login_dropdown');

$welcome = "<div id=\"index_welcome_header\" >";
$welcome .=elgg_view('output/img',array('src'=>"/mod/winetheme/views/default/css/winetheme/images/citation.png"));
//$welcome .= '<h4>'.elgg_echo('bienvenue').'</h4>';
//$welcome .= "<br>";

//$welcome .= '<h2>'.elgg_echo('citation');
//$welcome .= "<br>";
//$welcome .= elgg_echo('citation2').'</h2>';

//end of index_welcome
$welcome .= "</div>";

echo $welcome;
//
//// insert site-wide navigation
echo elgg_view_menu('site');