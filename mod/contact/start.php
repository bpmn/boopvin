<?php

function contact_init() 
		{
		global $CONFIG;
		//add_menu(elgg_echo('Contact Us!'), $CONFIG->wwwroot . "mod/contact");
		
                $menu_url=  elgg_normalize_url("mod/contact");
                elgg_register_menu_item('topbar', array('name' => 'contact', 'text' => elgg_echo('contact'),
		'href' => $menu_url));
                
                }
		
        elgg_register_event_handler('init','system','contact_init');
?>