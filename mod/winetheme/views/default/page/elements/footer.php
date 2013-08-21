<?php
/**
 * Elgg footer
 * The standard HTML footer that displays across the site
 *
 * @package Elgg
 * @subpackage Core
 *
 */

echo elgg_view_menu('footer', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));




//echo '<div class="mts clearfloat float-alt">';

//liste des partenaires


echo elgg_echo("sponsors")."<br/>";

echo '<div class="mts">';
/* wineshop-biarritz */
$wineshop_url= elgg_view('output/img', array(
        "src" => "mod/winetheme/_graphics/wineshop.jpg",
        "alt"=> "wineshop-biarritz",
        "width"=>"70",
        "height"=>"70"
    ));
echo elgg_view('output/url', array(
	'href' => 'http://www.wineshop-biarritz.fr/',
	'text' => $wineshop_url,
	'class' => '',
        'target'=>'_blank',
        'title'=>'wineshop-biarritz',
	'is_trusted' => true,
));
echo '</div>';
