<?php

function contact_init() 
		{
		global $CONFIG;
		//add_menu(elgg_echo('Contact Us!'), $CONFIG->wwwroot . "mod/contact");
		
                /*$menu_url=  elgg_normalize_url("mod/contact");
                elgg_register_menu_item('topbar', array('name' => 'contact', 'text' => elgg_echo('contact'),
		'href' => $menu_url,'priority' => 1000,));*/
                
                // Register a page handler, so we can have nice URLs
                elgg_register_page_handler('contact', 'contact_page_handler');
                
                $validate_contact_js = elgg_get_simplecache_url('js', 'validator_contact');
                elgg_register_simplecache_view('js/validator_contact');
                elgg_register_js('elgg.validate_contact', $validate_contact_js, 'footer');
                
                
                }
                
  
function contact_page_handler($page) {

	$file_dir = elgg_get_plugins_path() . 'contact';
        include "$file_dir/index.php";
        
	
	return true;
}
		
        elgg_register_event_handler('init','system','contact_init');
