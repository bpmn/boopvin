<?php
/**
 * Fancy tooltips
 *
 * Demonstrates how to use an external javascript library
 *
 * @author Cash Costello
 * @license http://opensource.org/licenses/gpl-2.0.php GPL 2
 */

elgg_register_event_handler('init', 'system', 'overlay_init');

function overlay_init() {
	// both register the JavaScript file and tell Elgg to load it on every page
	
        
        // register the blog's JavaScript
    
        
        $url = 'mod/overlay/vendors/nyromodal/jquery.nyroModal.custom.min.js';
        elgg_register_js('jquery.nyroModal', $url);
        elgg_load_js('jquery.nyroModal');
        
        $url = 'mod/overlay/views/default/js/overlay.js';
        elgg_register_js('jquery.overlay', $url,'footer');
        elgg_load_js('jquery.overlay');
    
	

	// add our custom CSS and the JavaScript we need to initialize the tooltips
	
	elgg_extend_view('css/elgg', 'overlay/css');
}
