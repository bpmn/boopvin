<?php
/**
 * CSS buttons
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* **************************
	BUTTONS
************************** */

/* Base */
.elgg-button {
	font-size: 14px;
	font-weight: normal;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;

	width: auto;
	padding: 2px 4px;
	cursor: pointer;
	outline: none;
	



}

a.elgg-button {
	padding: 3px 6px;
}

/* Submit: This button should convey, "you're about to take some definitive action" */
.elgg-button-submit {
	color: white;
	text-decoration: none;
	border: 1px solid #725008;
	background: #4690d6 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
        border: 1px solid #725008; background: #D8B771 url(<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/ui-bg_glass_75_d8ab4c_1x400.png) 50% 50% repeat-x; font-weight: normal; color: #003232;
    
        
        }

.elgg-button-submit:hover {
	border-color: #723A08;
	text-decoration: none;
	color: white;
	background: #0054a7 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
        border: 1px solid #723A08; background: #c05656 url(<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/ui-bg_glass_75_d88e4c_1x400.png) 50% 50% repeat-x; font-weight: normal; color: #ffffff; 

        
}

.elgg-button-submit.elgg-state-disabled {
	background: #999;
	border-color: #999;
	cursor: default;
}

/* Cancel: This button should convey a negative but easily reversible action (e.g., turning off a plugin) */
.elgg-button-cancel {
	color: #333;
	background: #ddd url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	border: 1px solid #999;
}
.elgg-button-cancel:hover {
	color: #444;
	background-color: #999;
	background-position: left 10px;
	text-decoration: none;
}

/* Action: This button should convey a normal, inconsequential action, such as clicking a link */
.elgg-button-action {
	padding: 2px 15px;
	text-align: center;
	font-weight: normal;
	text-decoration: none;
	cursor: pointer;
	
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
border: 1px solid #723A08; background: #99bb54 url(<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/ui-bg_glass_75_d8ab4c_1x400.png) 50% 50% repeat-x; font-weight: normal; color: #723A08;

}

.elgg-button-action:hover,
.elgg-button-action:focus {
	text-decoration: none;
        border: 1px solid #723A08; background: #c05656 url(<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/ui-bg_glass_75_d88e4c_1x400.png) 50% 50% repeat-x; font-weight: normal; color: #723A08; 

}

/* Delete: This button should convey "be careful before you click me" */
.elgg-button-delete {
	color: #bbb;
	text-decoration: none;
	border: 1px solid #333;
	background: #555 url(<?php echo elgg_get_site_url(); ?>_graphics/button_graduation.png) repeat-x left 10px;
	text-shadow: 1px 1px 0px black;
}
.elgg-button-delete:hover {
	color: #999;
	background-color: #333;
	background-position: left 10px;
	text-decoration: none;
}

.elgg-button-dropdown {
	padding:3px 6px;
	text-decoration:none;
	display:block;
	position:relative;
	margin-left:0;
	color: white;
	border:1px solid #ffffff;
	
	-webkit-border-radius:0px;
	-moz-border-radius:0px;
	border-radius:0px;
	
	-webkit-box-shadow: 0 0 0;
	-moz-box-shadow: 0 0 0;
	box-shadow: 0 0 0;
	
	/*background-image:url(<?php echo elgg_get_site_url(); ?>_graphics/elgg_sprites.png);
	background-position:-150px -51px;
	background-repeat:no-repeat;*/
}

.elgg-button-dropdown:after {
	content: " \25BC ";
	font-size:smaller;
}

.elgg-button-dropdown:hover {
	background-color:#D8B771;
	text-decoration:none;
        border: 1px solid #723A08; background: #D8B771 url(<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/ui-bg_glass_75_d88e4c_1x400.png) 50% 50% repeat-x; font-weight: normal; color: #ffffff; 

}

.elgg-button-dropdown.elgg-state-active {
	background: #ccc;
	outline: none;
	color: #333;
	border:1px solid #723A08;
	
	-webkit-border-radius:0px 0px 0 0;
	-moz-border-radius:0px 0px 0 0;
	border-radius:0px 0px 0 0;
        border: 1px solid #723A08; background: #D8B771 url(<?php echo $vars['url']; ?>/mod/winetheme/views/default/css/winetheme/images/ui-bg_glass_75_d88e4c_1x400.png) 50% 50% repeat-x; font-weight: normal; color: #ffffff; 

}
