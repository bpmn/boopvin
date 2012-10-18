<?php
/**
* Profile widgets/tools
* 
* @package Elggwines
*/ 
	
// tools widget area
echo '<ul id="wines-tools" class="elgg-gallery elgg-gallery-fluid mtl clearfix">';

// enable tools to extend this area
echo elgg_view("wines/tool_latest", $vars);



echo "</ul>";

