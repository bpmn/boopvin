<?php
/**
 *	galliContactUs
 *	Author : Raez Mon | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info@webgalli.com
 *	Web	: http://webgalli.com
 *	Skype : 'team.webgalli'
 *	@package galliContactUs plugin
 *	Licence : GPLv2
 *	Copyright : Team Webgalli 2011-2015
 */
 
elgg_register_event_handler('init', 'system', 'galliContactUs_init');

function galliContactUs_init() {
	elgg_register_page_handler('contact-us', 'galliContactUs_page_handler');	
	elgg_register_action('galliContactUs/contact', elgg_get_plugins_path() . "galliContactUs/actions/galliContactUs/contact.php", 'public');
	
	/*$admin_email = elgg_get_plugin_setting('admin_email', 'galliContactUs');
	if($admin_email && is_email_address($admin_email)){
		$menu_locations = array('footer', 'site');
		foreach($menu_locations as $location){
			elgg_register_menu_item($location, array(
											'name' => 'contact-us',
											'text' => elgg_echo('galliContactUs:contact'),
											'href' => 'contact-us',
										));	
		}		
	}*/	
	if(!elgg_is_logged_in()){
		elgg_register_plugin_hook_handler('actionlist', 'captcha', 'galliContactUs_captcha_hook');
	}
}	

function galliContactUs_page_handler($page) {
	$title = elgg_echo('galliContactUs:contact');
	$body = elgg_view_form('galliContactUs/contact');
	$params = array(
		'content' => $body,
		'title' => $title,
	);
	$body = elgg_view_layout('one_sidebar', $params);
	echo elgg_view_page($title, $body);
	return true;
}

function galliContactUs_captcha_hook($hook, $entity_type, $returnvalue, $params)	{
	if (!is_array($returnvalue)){
		$returnvalue = array();
	}	
	$returnvalue[] = 'galliContactUs/contact';
	return $returnvalue;
}