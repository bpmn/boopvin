<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Wines Theme plugin
 *
 */

elgg_register_event_handler('init', 'system', 'winetheme_init');


/**
 * Initialize the wine plugin.
 */
function winetheme_init() {

	//extend some views
	//elgg_extend_view('css/elgg', 'winetheme/css');
    //$winetheme_jq = elgg_get_simplecache_url('css', 'vendors/jquery/ui/theme');
    
    elgg_unregister_css('hj.framework.jquitheme');
    
    //elgg_register_css('winetheme.jquitheme', $winetheme_jq);
}



?>
