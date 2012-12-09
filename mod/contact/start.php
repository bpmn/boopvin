<?php

function contact_init() 
		{
		global $CONFIG;
		//add_menu(elgg_echo('Contact Us!'), $CONFIG->wwwroot . "mod/contact");
		
                $menu_url=  elgg_normalize_url("mod/contact");
                elgg_register_menu_item('topbar', array('name' => 'contact', 'text' => elgg_echo('contact'),
		'href' => $menu_url));
                
                $validate_contact_js = elgg_get_simplecache_url('js', 'validator_contact');
                elgg_register_simplecache_view('js/validator_contact');
                elgg_register_js('elgg.validate_contact', $validate_contact_js, 'footer');
                
                
                }
		
        elgg_register_event_handler('init','system','contact_init');
?>