<?php
/**
 * Group module (also called a group widget)
 *
 * @uses $vars['title']    The title of the module
 * @uses $vars['content']  The module content
 * @uses $vars['all_link'] A link to list content
 * @uses $vars['add_link'] A link to create content
 */

$restobar = elgg_get_page_owner_entity();

if ($restobar->canWriteToContainer() && isset($vars['all_link'])) {
$header = "<span class=\"restobars-widget-viewall\">{$vars['all_link']}</span>";}
$header .= '<h3>' . $vars['title'] . '</h3>';


echo '<li>';
echo '<div class="restobars-news">';
echo elgg_view_module('info', '', $vars['content'], array(
	'header' => $header,
	'class' => 'elgg-module-group',
));
echo '</div>';
echo '</li>';
