<?php
/**
 * Group members sidebar
 *
 * @package ElggGroups
 *
 * @uses $vars['entity'] Group entity
 * @uses $vars['limit']  The number of members to display
 */


$body= '<div id="suggestion"></div>';

echo elgg_view_module('aside', elgg_echo('wine:suggestions'), $body);?>


