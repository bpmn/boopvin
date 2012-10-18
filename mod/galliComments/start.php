<?php
/**
 *	Elgg Ajax Comments
 *	Author : Raez Mon | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info@webgalli.com
 *	Web	: http://webgalli.com
 *	Skype : 'team.webgalli'
 *	@package Elgg Ajax Comments
 * 	Plugin info : Post comments without a page refresh
 *	Licence : GNU2
 *	Copyright : Team Webgalli 2011-2015
 */
 
elgg_register_event_handler('init', 'system', 'galliComments_init');

function galliComments_init() {
	elgg_extend_view('js/elgg', 'galliComments/js');
	elgg_register_ajax_view('galliComments/singleriver');		
	elgg_register_action('galliComments/add', elgg_get_plugins_path()."galliComments/actions/comments/add.php");	
        elgg_register_action('galliComments/delete', elgg_get_plugins_path()."galliComments/actions/comments/delete.php");
        elgg_unregister_plugin_hook_handler('register', 'menu:annotation', 'elgg_annotation_menu_setup');
        elgg_register_plugin_hook_handler('register', 'menu:annotation', 'elgg_comment_menu_setup');
}


/**
 * Adds a delete link to "generic_comment" annotations
 * @access private
 */
function elgg_comment_menu_setup($hook, $type, $return, $params) {
	$annotation = $params['annotation'];

	if ($annotation->name == 'generic_comment' && $annotation->canEdit()) {
		$url = elgg_http_add_url_query_elements('action/galliComments/delete', array(
			'annotation_id' => $annotation->id,
		));

		$options = array(
			'name' => 'delete',
			'href' => $url,
			'text' => "<span class=\"elgg-icon elgg-icon-delete\"></span>",
			'class' => 'comment-requires-confirmation',
                        'rel'=>elgg_echo('deleteconfirm'),
			'encode_text' => false
		);
		$return[] = ElggMenuItem::factory($options);
	}

	return $return;
}

